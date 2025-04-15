<?php

namespace App\Http\Controllers;

use Exception;
use SoapClient;
use App\Services\SoapService;
use App\Helpers\AgencyHelper;
use App\Models\Agence;
use App\Models\Compensation\Compensation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Log;

class CompensationController extends Controller
{

    private $soapService;

    public function __construct(SoapService $soapService)
    {
        $this->soapService = $soapService;
    }

    public function list()
    {
        $today = date('Y-m-d');
        $user = Auth::user();
        $hasPermission = $user->hasRole('admin') || $user->hasRole('Charge');

        $hasAgency = !empty($user->agence_id);

        $baseQuery = Compensation::whereDate('date_compensation', $today)
            ->whereNull('test');

        if ($hasAgency) {
            $baseQuery->where('code_agence', $user->agence_id);
        }

        $compensations = $baseQuery
            ->select('id', 'code_client', 'nom_client', 'date_compensation', 'status', 'code_agence')
            ->orderByDesc('created_at')
            ->paginate(25);

        $agencyHelper = new AgencyHelper();

        foreach ($compensations as $compensation) {
            $compensation->agency_name = $agencyHelper->getAgencyName($compensation->code_agence);
        }

        $counts = Compensation::whereDate('date_compensation', $today)
            ->whereNull('test')
            ->selectRaw("
                COUNT(*) as total, 
                SUM(CASE WHEN status_final = 1 THEN 1 ELSE 0 END) as attent, 
                SUM(CASE WHEN status_final = 2 THEN 1 ELSE 0 END) as accept, 
                SUM(CASE WHEN status_final = 3 THEN 1 ELSE 0 END) as refuse
            ")
            ->first();

        return view('compensation.list', [
            'hasPermission' => $hasPermission,
            'compensations' => $compensations,
            'counts' => $counts,
            'hasAgency' => $hasAgency,
        ]);

    }

    public function historique(Request $request, AgencyHelper $agencyHelper)
    {
        $today = date('Y-m-d');
        $user = Auth::user();
        $hasAgency = !empty($user->agence_id);

        if ($request->ajax()) {
            try {
                $query = Compensation::whereDate('date_compensation', '!=', $today)
                    ->whereNull('test');

                if ($hasAgency) {
                    $query->where('code_agence', $user->agence_id);
                }

                $searchValue = $request->input('search.value');

                if (!empty($searchValue)) {
                    $query->where(function ($q) use ($searchValue) {
                        $q->where('code_client', 'like', "%{$searchValue}%")
                        ->orWhere('nom_client', 'like', "%{$searchValue}%")
                        ->orWhere('code_agence', 'like', "%{$searchValue}%");
                    });
                }

                $totalRecords = $query->count();
                $start = $request->get('start', 0);
                $length = $request->get('length', 25);
                $currentPage = ($start / $length) + 1;

                $compensations = $query
                    ->select('id', 'code_client', 'nom_client', 'date_compensation', 'status', 'code_agence')
                    ->orderByDesc('created_at')
                    ->paginate($length, ['*'], 'page', $currentPage);

                $data = $compensations->getCollection()->transform(function ($compensation) use ($agencyHelper, $user) {
                    $status = \App\Helpers\StatusHelper::getStatusLabel($compensation->status);

                    $viewUrl = route('compensationview', ['id' => $compensation->id]);
                    $editUrl = route('compensationedit', ['id' => $compensation->id]);
                    $deleteModalId = "compensation_delete_{$compensation->id}";
                    $viewButton = "<a class='btn btn-info btn-sm' href='{$viewUrl}' title='Voir'><i class='fa fa-eye'></i></a>";
                    $editButton = "<a class='btn btn-warning btn-sm' href='{$editUrl}' title='Modifier'><i class='fa fa-pen'></i></a>";
                    $deleteButton = '';

                    if ($user->hasRole('Chef_agence') || $user->hasRole('admin')) {
                        $deleteButton = "<button class='btn btn-danger btn-sm' data-toggle='modal' data-target='#{$deleteModalId}' title='Supprimer'>
                                            <i class='fa fa-trash'></i>
                                        </button>";
                    }

                    $moreOptionsButton = "<div class='btn-group'>
                                            <button class='btn btn-default btn-sm dropdown-toggle' data-bs-toggle='dropdown'>
                                                <span>Plus d'options</span>
                                            </button>
                                            <ul class='dropdown-menu'>
                                                <li><a class='btn btn-default btn-sm' href='#'>Vision Global</a></li>
                                                <li><a class='btn btn-default btn-sm' href='#'>Fiche détaillée</a></li>
                                            </ul>
                                        </div>";

                    return [
                        'code_client' => $compensation->code_client,
                        'nom_client' => $compensation->nom_client,
                        'date_compensation' => $compensation->date_compensation 
                            ? $compensation->date_compensation->format('Y-m-d') 
                            : '**-**-****',
                        'agency_name' => $agencyHelper->getAgencyName($compensation->code_agence),
                        'status' => $status 
                            ? '<span class="badge bg-' . $status['badge'] . '">' . $status['label'] . '</span>' 
                            : '',
                        'actions' => $viewButton . ' ' . $editButton . ' ' . $deleteButton . ' ' . $moreOptionsButton,
                    ];
                })->toArray();

                return response()->json([
                    'draw' => intval($request->get('draw')),
                    'recordsTotal' => $totalRecords,
                    'recordsFiltered' => $totalRecords,
                    'data' => $data,
                ]);

            } catch (\Exception $e) {
                return response()->json([
                    'error' => 'An error occurred while fetching the data.',
                    'message' => $e->getMessage(),
                ], 500);
            }
        } else {
            $counts = $this->getCounts($today);
            $counts_agency = $hasAgency ? $this->getCounts($today, $user->agence_id) : null;

            return view('compensation.historique', [
                'counts' => $counts,
                'counts_agency' => $counts_agency,
                'hasAgency' => $hasAgency,
            ]);
        }
    }

    public function getCounts($date, $agencyId = null)
    {
        $query = Compensation::whereDate('date_compensation', '!=', $date)
            ->whereNull('test');

        if ($agencyId) {
            $query->where('code_agence', $agencyId);
        }

        return $query->selectRaw("
            COUNT(*) as total,
            SUM(CASE WHEN status_final = 1 THEN 1 ELSE 0 END) as attent,
            SUM(CASE WHEN status_final = 2 THEN 1 ELSE 0 END) as accept,
            SUM(CASE WHEN status_final = 3 THEN 1 ELSE 0 END) as refuse
        ")->first();
    }

    public function etatJournalier(Request $request, AgencyHelper $agencyHelper)
    {
        try {
            if ($request->ajax()) {
                $today = date('Y-m-d');

                $query = Compensation::with(['avis_comp', 'impaye_client'])
                    ->whereDate('created_at', $today)
                    ->where('status', 15)
                    ->select(
                        'id',
                        'code_client',
                        'account_number',
                        'nom_client',
                        'name_secteur',
                        'classement_client',
                        'solde_compensation',
                        'date_compensation',
                        'updated_at',
                        'val_compensation',
                        'status',
                        'code_agence'
                    );

                return DataTables::of($query)
                    ->addIndexColumn()
                    ->editColumn('date_compensation', function($comp) {
                        return optional($comp->date_compensation)->format('d-m-Y');
                    })
                    ->editColumn('updated_at', function($comp) {
                        return optional($comp->updated_at)->format('d-m-Y');
                    })
                    ->editColumn('code_agence', function($comp) use ($agencyHelper) {
                        return $agencyHelper->getAgencyName($comp->code_agence);
                    })
                    ->addColumn('total_debit', function($comp) {
                        $val_compensation = $comp->val_compensation ?? 0;
                        $impaye_client = $comp->impaye_client->sum('montant_impaye') ?? 0;
                        return $val_compensation + $impaye_client;
                    })
                    ->editColumn('status', function($comp) {
                        $status = \App\Helpers\StatusHelper::getStatusLabel($comp->status);
                        return $status ? '<span class="badge bg-' . $status['badge'] . '">' . $status['label'] . '</span>' : '';
                    })
                    ->addColumn('dernier_avis', function($comp) {
                        $lastAvis = $comp->avis_comp
                            ->where('created_at', '<=', $comp->updated_at)
                            ->last();
                        return $lastAvis ? $lastAvis->text_avis : '';
                    })
                    ->rawColumns(['status'])
                    ->make(true);
            }
            
            return view('compensation.etat_journalier');
        } catch (\Exception $e) {
            Log::error('EtatJournalier Error: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function extrait(Request $request, AgencyHelper $agencyHelper){
        if($request->ajax()){
    
            $query = Compensation::select('code_client', 'nom_client', 'date_compensation', 'code_agence', 'status')
                ->orderBy('created_at', 'DESC');
    
            if ($request->filled('start_date') && $request->filled('end_date')) {
                $query->whereBetween('date_compensation', [
                    $request->start_date, $request->end_date
                ]);
            }
    
            return DataTables::of($query)
                ->editColumn('date_compensation', function($comp) {
                    return $comp->date_compensation->format('Y-m-d');
                })
                ->editColumn('status', function($comp) {
                    $status = \App\Helpers\StatusHelper::getStatusLabel($comp->status);
                    return $status 
                        ? '<span class="badge bg-' . $status['badge'] . '">' . $status['label'] . '</span>' 
                        : '';
                })
                ->editColumn('code_agence', function($comp) use ($agencyHelper) {
                    return $agencyHelper->getAgencyName($comp->code_agence);
                })
                ->rawColumns(['status'])
                ->toJson();
        }
    
        return view('compensation.extrait');
    }

    public function getClient(){
        return view('compensation.get_client');
    }


    // TODO : Improve this and the view related 3000+ lines is a mess
    public function checkClient($accountNumber)
    {
        $params = [
            'WebRequestCommon' => [
                'userName' => env('SOAP_USERNAME'),
                'password' => env('SOAP_PASSWORD'),
                'company'  => env('SOAP_COMPANY'),
            ],
            'WSWORKFLOWCHQType' => [
                'enquiryInputCollection' => [
                    'columnName'    => 'NUM.COMPTE',
                    'criteriaValue' => $accountNumber,
                    'operand'       => 'EQ',
                ],
            ],
        ];

        $response = $this->soapService->request('WSWORKFLOWCHQ', $params);

        $client = data_get($response, 'CUSTOMER');

        if ($client) {
            return response()->json([
                'CUSTOMER' => $client,
            ]);
        }

        return response()->json(false);
    }

    public function addRequest(Request $request)
    {
        $agences = Agence::distinct()->get();
        $id_client = $request['client_code'];
        $account = $request['account_number'];
        $derniere_compensation = Compensation::where('code_client', $id_client)->orderBy('created_at', 'DESC')->first();

        $soap = new \SoapClient(env('SOAP_WSDL_URL'));
        $functions = $soap->__getFunctions();

        //INFORMATIONS GLOBALES
        try{
            $params = array(
                "WebRequestCommon" => array(
                    "userName" => env('SOAP_USERNAME'),
                    "password" => env('SOAP_PASSWORD'),
                    "company" => env('SOAP_COMPANY'),
                ),

                "WSINFORMATIONSGLOBType" => array(
                    "enquiryInputCollection" => array(
                        ["columnName" => "CODE.CLIENT",
                        "criteriaValue" => $id_client,
                        "operand" => "EQ",],

                        ["columnName" => "NUM.COMPTE",
                        "criteriaValue" => $account,
                        "operand" => "EQ",]
                    )
                )
            );
            $InfGlob = $soap->WSINFORMATIONGLOB($params);
            $outterArrayInfGlob = ((array)$InfGlob);
            $innerArrayInfGlob = ((array)$outterArrayInfGlob['WSINFORMATIONSGLOBType']);
            $dataArrayInfGlob = ((array)$innerArrayInfGlob['gWSINFORMATIONSGLOBDetailType']);
            $listArrayInfGlob = ((array)$dataArrayInfGlob['mWSINFORMATIONSGLOBDetailType']);

            $listAutreCompte = $listArrayInfGlob;


        } catch (Exception $e) {
            $listArrayInfGlob = [];
            $listAutreCompte = [];
        }

        //ENGAGEMENT GERANT
        try{
            $paramsG = array(
                "WebRequestCommon" => array(
                    "userName" => env('SOAP_USERNAME'),
                    "password" => env('SOAP_PASSWORD'),
                    "company" => env('SOAP_COMPANY'),
                ),
                "WSENGAGEMENTGERANTType" => array(
                    "enquiryInputCollection" => array(
                        "columnName" => "CODE.CLIENT",
                        "criteriaValue" => $id_client,
                        "operand" => "EQ",
                    )
                )
            );
            $InfEngGer = $soap->WSENGAGEMENTGERANT($paramsG);

            $outterArrayEngGer = ((array)$InfEngGer);
            $innerArrayEngGer = ((array)$outterArrayEngGer['WSENGAGEMENTGERANTType']);
            $dataArrayEngGer = ((array)$innerArrayEngGer['gWSENGAGEMENTGERANTDetailType']);
            $listArrayEngGer = ((array)$dataArrayEngGer['mWSENGAGEMENTGERANTDetailType']);

        } catch (Exception $e) {
            $listArrayEngGer = [];
        }

        //ENGAGEMENT CLIENT
        try{
            $paramsC = array(
                "WebRequestCommon" => array(
                    "userName" => env('SOAP_USERNAME'),
                    "password" => env('SOAP_PASSWORD'),
                    "company" => env('SOAP_COMPANY'),
                ),
                "WSENGAGEMENTCLIENTType" => array(
                    "enquiryInputCollection" => array(
                        "columnName" => "CODE.CLIENT",
                        "criteriaValue" => $id_client,
                        "operand" => "EQ",
                    )
                )
            );
            $InfEngCred = $soap->WSENGAGEMENTCLIENT($paramsC);

            $outterArrayEngCred = ((array)$InfEngCred);
            $innerArrayEngCred = ((array)$outterArrayEngCred['WSENGAGEMENTCLIENTType']);
            $dataArrayEngCred = ((array)$innerArrayEngCred['gWSENGAGEMENTCLIENTDetailType']);
            $listArrayEngCred = ((array)$dataArrayEngCred['mWSENGAGEMENTCLIENTDetailType']);

        } catch (Exception $e) {
            $listArrayEngCred = [];
        }

        //PLACEMENT
        try{
            $paramsP = array(
                "WebRequestCommon" => array(
                    "userName" => env('SOAP_USERNAME'),
                    "password" => env('SOAP_PASSWORD'),
                    "company" => env('SOAP_COMPANY'),
                ),
                "WSPLACEMENTType" => array(
                    "enquiryInputCollection" => array(
                        "columnName" => "CUSTOMER.ID",
                        "criteriaValue" => $id_client,
                        "operand" => "EQ",
                    )
                )
            );
            $InfPlacement = $soap->WSPLACEMENT($paramsP);

            $outterArrayPlacement = ((array)$InfPlacement);
            $innerArrayPlacement = ((array)$outterArrayPlacement['WSPLACEMENTType']);
            $dataArrayPlacement = ((array)$innerArrayPlacement['gWSPLACEMENTDetailType']);
            $listArrayPlacement = ((array)$dataArrayPlacement['mWSPLACEMENTDetailType']);

        } catch (Exception $e) {
            $listArrayPlacement = [];
        }

        //LIMIT
        try{
            $paramsL = array(
                "WebRequestCommon" => array(
                    "userName" => env('SOAP_USERNAME'),
                    "password" => env('SOAP_PASSWORD'),
                    "company" => env('SOAP_COMPANY'),
                ),
                "LIMITEWSType" => array(
                    "enquiryInputCollection" => array(
                        "columnName" => "LINE.ID",
                        "criteriaValue" => $id_client.'.0010000.01',
                        "operand" => "EQ",
                    )
                )
            );
            $InfLimit = $soap->WSLIMIT($paramsL);

            $outterArrayLimit  = ((array)$InfLimit);
            $innerArrayLimit  = ((array)$outterArrayLimit['LIMITEWSType']);
            $dataArrayLimit  = ((array)$innerArrayLimit['gLIMITEWSDetailType']);
            $listArrayLimit  = ((array)$dataArrayLimit['mLIMITEWSDetailType']);

        } catch (Exception $e) {
            $listArrayLimit  = [];
        }

        if ($listArrayLimit != null){
            $first_line = $listArrayLimit[0];
            $second_line = $listArrayLimit[1];
        }else{
            $first_line = [];
            $second_line = [];
        }

        //IMPAYE
        try{
            $params1 = array(
                "WebRequestCommon" => array(
                    "userName" => env('SOAP_USERNAME'),
                    "password" => env('SOAP_PASSWORD'),
                    "company" => env('SOAP_COMPANY'),
                ),
                "WSWORKFLOWCHQIMPAYEType" => array(
                    "enquiryInputCollection" => array(
                        "columnName" => "CLIENT",
                        "criteriaValue" => $id_client,
                        "operand" => "EQ",
                    )
                )
            );
            $imp = $soap->WSWORKFLOWCHQIMPAYE($params1);

            $outterArrayImp = ((array)$imp);
            $innerArrayImp = ((array)$outterArrayImp['WSWORKFLOWCHQIMPAYEType']);
            $dataArrayImp = ((array)$innerArrayImp['gWSWORKFLOWCHQIMPAYEDetailType']);
            $listArrayImp = ((array)$dataArrayImp['mWSWORKFLOWCHQIMPAYEDetailType']);
        } catch (Exception $e) {
            $listArrayImp = [];
        }

        //TOMBEE ECHEANCE
        try{
            $paramsTE = array(
                "WebRequestCommon" => array(
                    "userName" => env('SOAP_USERNAME'),
                    "password" => env('SOAP_PASSWORD'),
                    "company" => env('SOAP_COMPANY'),
                ),
                "WSTOMBEECHEANCEType" => array(
                    "enquiryInputCollection" => array(
                        "columnName" => "CODE.CLIENT",
                        "criteriaValue" => $id_client,
                        "operand" => "EQ",
                    )
                )
            );
            $TMBE = $soap->WSTOMBEECHEANCE($paramsTE);

            $outterArrayTMBE = ((array)$TMBE);
            $innerArrayTMBE= ((array)$outterArrayTMBE['WSTOMBEECHEANCEType']);
            $dataArrayTMBE = ((array)$innerArrayTMBE['gWSTOMBEECHEANCEDetailType']);
            $listArrayTMBE = ((array)$dataArrayTMBE['mWSTOMBEECHEANCEDetailType']);

        } catch (Exception $e) {
            $listArrayTMBE = [];
        }

        //ENCOURS CHEQUE
        try{
            $paramsENCR = array(
                "WebRequestCommon" => array(
                    "userName" => env('SOAP_USERNAME'),
                    "password" => env('SOAP_PASSWORD'),
                    "company" => env('SOAP_COMPANY'),
                ),
                "WSENCOURSCHEQUEType" => array(
                    "enquiryInputCollection" => array(
                        "columnName" => "CODE.CLIENT",
                        "criteriaValue" => $id_client,
                        "operand" => "EQ",
                    )
                )
            );
            $ENCR = $soap->WSENCOURSCHEQUE($paramsENCR);

            $outterArrayENCR = ((array)$ENCR);
            $innerArrayENCR= ((array)$outterArrayENCR['WSENCOURSCHEQUEType']);
            $dataArrayENCR = ((array)$innerArrayENCR['gWSENCOURSCHEQUEDetailType']);
            $listArrayENCR = ((array)$dataArrayENCR['mWSENCOURSCHEQUEDetailType']);

        } catch (Exception $e) {
            $listArrayENCR = [];
        }

        //ACCOUNT LEASING
        try{
            $params2 = array(
                "WebRequestCommon" => array(
                    "userName" => env('SOAP_USERNAME'),
                    "password" => env('SOAP_PASSWORD'),
                    "company" => env('SOAP_COMPANY'),
                ),
                "WSCOMPTELEASINGCHQType" => array(
                    "enquiryInputCollection" => array(
                        "columnName" => "CODE.CLIENT",
                        "criteriaValue" => $id_client,
                        "operand" => "EQ",
                    )
                )
            );
            $Leas = $soap->WSCOMPTELEASINGCHQ($params2);
            $outterArrayLeas = ((array)$Leas);
            $innerArrayLeas = ((array)$outterArrayLeas['WSCOMPTELEASINGCHQType']);
            $dataArrayLeas = ((array)$innerArrayLeas['gWSCOMPTELEASINGCHQDetailType']);
            $listArrayLeas = ((array)$dataArrayLeas['mWSCOMPTELEASINGCHQDetailType']);
        }catch (Exception $e) {
            $listArrayLeas = [];
        }

        //INCIDENT DE PAIEMENT
        try{
            $paramsIP = array(
                "WebRequestCommon" => array(
                    "userName" => env('SOAP_USERNAME'),
                    "password" => env('SOAP_PASSWORD'),
                    "company" => env('SOAP_COMPANY'),
                ),
                "WSINCIDENTPAIEMENTType" => array(
                    "enquiryInputCollection" => array(
                        "columnName" => "NUM.COMPTE",
                        "criteriaValue" => $account,
                        "operand" => "EQ",
                    )
                )
            );
            $IP = $soap->WSINCIDENTPAIEMENT($paramsIP);

            $outterArrayIP = ((array)$IP);
            $innerArrayIP= ((array)$outterArrayIP['WSINCIDENTPAIEMENTType']);
            $dataArrayIP = ((array)$innerArrayIP['gWSINCIDENTPAIEMENTDetailType']);
            $listArrayIP = ((array)$dataArrayIP['mWSINCIDENTPAIEMENTDetailType']);


        } catch (Exception $e) {
            $listArrayIP = [];
        }

        //ENCOURS EFFET A ENCAISSEMENT
        try{
            $paramsEFFET = array(
                "WebRequestCommon" => array(
                    "userName" => env('SOAP_USERNAME'),
                    "password" => env('SOAP_PASSWORD'),
                    "company" => env('SOAP_COMPANY'),
                ),
                "WSEFFETENCOURSType" => array(
                    "enquiryInputCollection" => array(
                        "columnName" => "COMPTE.CEDANT",
                        "criteriaValue" => $account,
                        "operand" => "EQ",
                    )
                )
            );
            $EFFET = $soap->WSEFFETENCOURS($paramsEFFET);

            $outterArrayEFFET = ((array)$EFFET);
            $innerArrayEFFET= ((array)$outterArrayEFFET['WSEFFETENCOURSType']);
            $dataArrayEFFET = ((array)$innerArrayEFFET['gWSEFFETENCOURSDetailType']);
            $listArrayEFFET = ((array)$dataArrayEFFET['mWSEFFETENCOURSDetailType']);


        } catch (Exception $e) {
            $listArrayEFFET = [];
        }

        return view('compensation.add_request', compact('agences','derniere_compensation',
                                                    'listArrayInfGlob','listAutreCompte','listArrayEngGer','listArrayPlacement','listArrayEngCred',
                                                    'first_line','second_line','listArrayImp','listArrayTMBE','listArrayENCR','listArrayLeas','listArrayIP','listArrayEFFET'));
    }
}
