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


    public function checkClient($accountNumber)
    {
        $service = 'WSWORKFLOWCHQ';

        $specificParams = [
            'enquiryInputCollection' => [
                'columnName'    => 'NUM.COMPTE',
                'criteriaValue' => $accountNumber,
                'operand'       => 'EQ',
            ],
        ];

        $params = $this->soapService->buildParams($service, $specificParams);
        $response = $this->soapService->request($service, $params);

        $client = data_get($response, 'CUSTOMER');

        if ($client) {
            return response()->json([
                'CUSTOMER' => $client,
            ]);
        }

        return response()->json(false);
    }

    public function fetchWsData(Request $request, $type){
        $id_client = $request->input('id_client');
        $account = $request->input('account');

        $derniereCompensation = Compensation::where('code_client', $id_client)->orderBy('created_at', 'DESC')->first();


        $fetchSoapData = function ($service, $specificParams) {
            $params = $this->soapService->buildParams($service, $specificParams);
            return $this->soapService->request($service, $params);
        };

        $data = [];

        switch ($type) {
            case 'informations_generales':
                $data['infosGlobales'] = $fetchSoapData('WSINFORMATIONGLOB', [
                    'enquiryInputCollection' => [
                        ["columnName" => "CODE.CLIENT", "criteriaValue" => $id_client, "operand" => "EQ"],
                        ["columnName" => "NUM.COMPTE", "criteriaValue" => $account, "operand" => "EQ"]
                    ]
                ]) ?? [];

                $data['engagementsGerant'] = $fetchSoapData('WSENGAGEMENTGERANT', [
                            'enquiryInputCollection' => [
                                ["columnName" => "CODE.CLIENT", "criteriaValue" => $id_client, "operand" => "EQ"]
                            ]
                        ]) ?? [];
                return view('compensation.partials.informations_generales', $data);
            
            case 'compensation':

                $data['placements'] = $fetchSoapData('WSPLACEMENT', [
                            'enquiryInputCollection' => [
                                ["columnName" => "CUSTOMER.ID", "criteriaValue" => $id_client, "operand" => "EQ"]
                            ]
                        ]) ?? [];

                $data['engagementsCredit'] = $fetchSoapData('WSENGAGEMENTCLIENT', [
                            'enquiryInputCollection' => [
                                ["columnName" => "CODE.CLIENT", "criteriaValue" => $id_client, "operand" => "EQ"]
                            ]
                        ]) ?? [];
                
                $listArrayLimit = $fetchSoapData('WSLIMIT', [
                            'enquiryInputCollection' => [
                                ["columnName" => "LINE.ID", "criteriaValue" => $id_client . '.0010000.01', "operand" => "EQ"]
                            ]
                        ]) ?? [];

                $data['impayes'] = $fetchSoapData('WSWORKFLOWCHQIMPAYE', [
                            'enquiryInputCollection' => [
                                ["columnName" => "CLIENT", "criteriaValue" => $id_client, "operand" => "EQ"]
                            ]
                        ]) ?? [];

                $data['leasing'] = $fetchSoapData('WSCOMPTELEASINGCHQ', [
                            'enquiryInputCollection' => [
                                ["columnName" => "CODE.CLIENT", "criteriaValue" => $id_client, "operand" => "EQ"]
                            ]
                        ]) ?? [];
                
                $data['incidentsPaiment'] = $fetchSoapData('WSINCIDENTPAIEMENT', [
                            'enquiryInputCollection' => [
                                ["columnName" => "NUM.COMPTE", "criteriaValue" => $account, "operand" => "EQ"]
                            ]
                        ]) ?? [];
                $data['firstLine'] = $listArrayLimit[0] ?? [];
                $data['secondLine'] = $listArrayLimit[1] ?? [];

                return view('compensation.partials.compensation', $data);
        
            case 'client':

                $data['infosGlobales'] = $fetchSoapData('WSINFORMATIONGLOB', [
                    'enquiryInputCollection' => [
                        ["columnName" => "CODE.CLIENT", "criteriaValue" => $id_client, "operand" => "EQ"],
                        ["columnName" => "NUM.COMPTE", "criteriaValue" => $account, "operand" => "EQ"]
                    ]
                ]) ?? [];

                $data['tombees'] = $fetchSoapData('WSTOMBEECHEANCE', [
                            'enquiryInputCollection' => [
                                ["columnName" => "CODE.CLIENT", "criteriaValue" => $id_client, "operand" => "EQ"]
                            ]
                        ]) ?? [];

                $data['encours'] = $fetchSoapData('WSENCOURSCHEQUE', [
                            'enquiryInputCollection' => [
                                ["columnName" => "CODE.CLIENT", "criteriaValue" => $id_client, "operand" => "EQ"]
                            ]
                        ]) ?? [];

                // Web Service Inexsistant

                // $data['effet'] = $fetchSoapData('WSEFFETENCOURS', [
                //     'enquiryInputCollection' => [
                //         ["columnName" => "COMPTE.CEDANT", "criteriaValue" => $account, "operand" => "EQ"]
                //     ]
                // ]) ?? [];
                return view('compensation.partials.client', $data);
            
            case 'derniere_compensation':

                $data['derniereCompensation'] = $derniereCompensation;

                return view('compensation.partials.derniere_compensation', $data);
            
            case 'beneficiaire':
                return view('compensation.partials.beneficiaire', $data);
            
            case 'commentaires':
                return view('compensation.partials.commentaires');
            
            // commented since it is non-working for now

            case 'comptes_client':
                // list Autre comptes is infos globales ._.
                // $data['infosGlobales'] = $fetchSoapData('WSINFORMATIONGLOB', [
                //     'enquiryInputCollection' => [
                //         ["columnName" => "CODE.CLIENT", "criteriaValue" => $id_client, "operand" => "EQ"],
                //         ["columnName" => "NUM.COMPTE", "criteriaValue" => $account, "operand" => "EQ"]
                //     ]
                // ]) ?? [];
                return view('compensation.partials.comptes_client');
        }
    }

    public function addRequest(Request $request){
        $id_client = $request->input('client_code');
        $account = $request->input('account_number');

        return view('compensation.add_request', compact(
                    'id_client', 'account'
                ));
    }

    public function store_compensation(Request $request)
    {
        DB::beginTransaction();

        try {
            // Create main Compensation
            $compensation = Compensation::create([
                'client_code'             => $request->input('client_code'),
                'account_number'          => $request->input('account_number'),
                'classement_client'       => $request->input('classement_client'),
                'valeur_decision'         => $request->input('valeur_decision'),
                'date_expiration'         => Carbon::parse($request->input('date_exp_decision_new'))->toDateString(), // Oracle-safe
                'note_couverture'         => $request->input('note_couverture'),
                'resultat_brut'           => $request->input('resultat_brut'),
                'chiffre_n'               => $request->input('chiffre_n'),
                'resultat_n'              => $request->input('resultat_n'),
                'val_compensation'        => $request->input('val_compensation'),
                'solde_actuel'            => $request->input('solde_actuel'),
                'solde_post_comp'         => $request->input('solde_post_comp'),
                'respect_promet'          => $request->input('respect_promet'),
                'note_der_comp_update'    => $request->input('note_der_comp_update'),
                'date_decision'           => now()->toDateString(), // Oracle-safe
            ]);

            // Store compensation details
            foreach ($request->input('type_compensation', []) as $detail) {
                $compensation->details()->create([
                    'name'        => $detail['name'] ?? null,
                    'beneficiare' => $detail['beneficiare'] ?? null,
                    'value'       => $detail['value'] ?? null,
                ]);
            }

            // Store justification entries
            foreach ($request->input('justification_comp', []) as $justification) {
                $compensation->justifications()->create([
                    'name'  => $justification['name_justification_update'] ?? null,
                    'value' => $justification['value'] ?? null,
                ]);
            }

            // Store impayé client details
            foreach ($request->input('impaye_client', []) as $impaye) {
                $compensation->impayeClients()->create([
                    'nature' => $impaye['nature_impaye'] ?? null,
                    'montant' => $impaye['montant_impaye'] ?? null,
                    'devise' => $impaye['devise_impaye'] ?? null,
                ]);
            }

            // Save initial status (optional default)
            $compensation->status()->create([
                'status'      => 'new', // default
                'updated_by'  => auth()->id(),
            ]);

            // Handle uploads
            $this->handleUploads($request, $compensation);

            DB::commit();
            return response()->json(['message' => 'Compensation stored successfully.']);
        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    private function handleUploads(Request $request, Compensation $compensation)
    {
        $uploadFields = [
            'credit_particulier_gerant',
            'classement_gerant',
            'cheque_impaye_gerant',
            'engagement_client',
            'risque_client',
            'garantie',
            'engagement_sed_ben',
            'classement_ben',
        ];

        foreach ($uploadFields as $field) {
            if ($request->hasFile($field)) {
                $file = $request->file($field);
                $path = $file->store("compensations/{$compensation->id}", 'public');

                $compensation->files()->create([
                    'type' => $field,
                    'path' => $path,
                ]);
            }
        }
    }

}
