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

    public function store_compensation(Request $request){

        dd($request->all());
        
        $compensation = Compensation::create($request->all());

        //engagement gerant
        if ($request['engagement_store'] !== null) {
            foreach($request->code_gerant as $key=>$code_gerant){

                $engagement                         = new Engagement_gerant();
                $engagement->code_gerant            = $code_gerant;
                $engagement->nom_gerant             = $request->nom_gerant[$key];
                $engagement->client                 = $request->client[$key];
                if(isset($request->classementEng[$key])){
                    $engagement->classement             = $request->classementEng[$key];
                }

                if(isset($request->engagement[$key])){
                    $engagement->engagement             = $request->engagement[$key];
                    $engagement->type_eng_gerant        = $request->type_eng_gerant[$key];
                    $engagement->date_eng_gerant        = $request->date_eng_gerant[$key];
                    $engagement->montant_eng_gerant     = $request->montant_eng_gerant[$key];
                    $engagement->devise                 = $request->devise[$key];
                    $engagement->encours_tnd            = $request->encours_tnd[$key];
                }
                $engagement->id_compensation        = $compensation->id;

                $engagement->save();

            }
        }else{

            $engagement                             = new Engagement_gerant();
            $engagement->code_gerant                = $request->code_gerant;
            $engagement->nom_gerant                 = $request->nom_gerant;
            $engagement->client                     = $request->client;
            $engagement->classement                 = $request->classementEng;
            $engagement->engagement                 = $request->engagement;
            $engagement->type_eng_gerant            = $request->type_eng_gerant;
            $engagement->date_eng_gerant            = $request->date_eng_gerant;
            $engagement->montant_eng_gerant         = $request->montant_eng_gerant;
            $engagement->devise                     = $request->devise;
            $engagement->encours_tnd                = $request->encours_tnd;
            $engagement->id_compensation            = $compensation->id;

            $engagement->save();
        }

        //Placement

        if ($request['placement_compensation'] !== null) {

            foreach($request->referenceP as $key=>$referenceP){

            $placement                  = new PlacementCompensation();
            $placement->reference       = $referenceP;
            $placement->nature          = $request->natureP[$key];
            $placement->montant         = $request->montantP[$key];
            $placement->devise          = $request->deviseP[$key];
            $placement->du              = $request->du[$key];
            $placement->au              = $request->au[$key];
            $placement->taux            = $request->taux[$key];

            if(isset($request->basetmm[$key])){
                $placement->basetmm         = $request->basetmm[$key];
                $placement->marge           = $request->marge[$key];
            }
            $placement->id_compensation = $compensation->id;

            $placement->save();

            }

        }else{

            $placement                      = new PlacementCompensation();
            $placement->reference           = $request->referenceP;
            $placement->nature              = $request->natureP;
            $placement->montant             = $request->montantP;
            $placement->devise              = $request->deviseP;
            $placement->du                  = $request->du;
            $placement->au                  = $request->au;
            $placement->taux                = $request->taux;
            $placement->basetmm             = $request->basetmm;
            $placement->marge               = $request->marge;
            $placement->id_compensation     = $compensation->id;

            $placement->save();
        }

        //credit

        if ($request['credit_compensation'] !== null) {

            foreach($request->referenceCred as $key=>$referenceCred){

                $credit                     = new CreditCompensation();
                $credit->reference          = $referenceCred;
                $credit->libelle            = $request->libelleCred[$key];
                $credit->category           = $request->categoryCred[$key];
                $credit->encours            = $request->encoursCred[$key];
                $credit->date               = $request->dateCred[$key];
                $credit->id_compensation    = $compensation->id;

                $credit->save();

            }

        }else{

            $credit                      = new CreditCompensation();
            $credit->reference           = $request->referenceCred;
            $credit->libelle             = $request->libelleCred;
            $credit->category            = $request->categoryCred;
            $credit->encours             = $request->encoursCred;
            $credit->date                = $request->dateCred;
            $credit->id_compensation     = $compensation->id;

            $credit->save();

        }

        //impaye
        if ($request['impaye_compensation'] !== null) {

            foreach($request->refImp as $key=>$refImp){

                $impaye                     = new Impaye_besoin();
                $impaye->ref                = $refImp;
                $impaye->nature_besoin      = $request->nature_besoinImp[$key];
                $impaye->valeur_besoin      = $request->valeur_besoinImp[$key];
                $impaye->devise             = $request->deviseImp[$key];
                $impaye->mantant_tnd        = $request->mantant_tndImp[$key];
                $impaye->echeance_besoin    = $request->echeance_besoinImp[$key];
                $impaye->id_compensation    = $compensation->id;

                $impaye->save();

            }

        }else{

            $impaye                         = new Impaye_besoin();
            $impaye->ref                    = $request->refImp;
            $impaye->nature_besoin          = $request->nature_besoinImp;
            $impaye->valeur_besoin          = $request->valeur_besoinImp;
            $impaye->devise                 = $request->deviseImp;
            $impaye->mantant_tnd            = $request->mantant_tndImp;
            $impaye->echeance_besoin        = $request->echeance_besoinImp;
            $impaye->id_compensation        = $compensation->id;

            $impaye->save();

        }

        //encours chèque

        if ($request['encours_compensation'] !== null) {

            foreach($request->referenceEnc as $key=>$referenceEnc){

                $encours                     = new EncoursCompensation();
                $encours->reference          = $referenceEnc;
                $encours->montant            = $request->montantEnc[$key];
                $encours->devise             = $request->deviseEnc[$key];
                $encours->numbord            = $request->numbord[$key];
                $encours->date               = $request->dateEnc[$key];
                $encours->id_compensation    = $compensation->id;

                $encours->save();

            }

        }else{

            $encours                      = new EncoursCompensation();
            $encours->reference           = $request->referenceEnc;
            $encours->montant             = $request->montantEnc;
            $encours->devise              = $request->deviseEnc;
            $encours->numbord             = $request->numbord;
            $encours->date                = $request->dateEnc;
            $encours->id_compensation     = $compensation->id;

            $encours->save();

        }

        //tombe d'echeance

        if ($request['tombe_compensation'] !== null) {

            foreach($request->referenceTombe as $key=>$referenceTombe){

                $tombe                        = new TombeProcheCompensation();
                $tombe->reference             = $referenceTombe;
                $tombe->nature                = $request->natureTombe[$key];
                $tombe->montant               = $request->montantTombe[$key];
                $tombe->devise                = $request->deviseTombe[$key];
                $tombe->date_ech              = $request->date_echTombe[$key];
                $tombe->date_proche           = $request->date_procheTombe[$key];
                $tombe->category              = $request->categoryTombe[$key];
                $tombe->id_compensation       = $compensation->id;

                $tombe->save();

            }

        }else{

            $tombe                        = new TombeProcheCompensation();
            $tombe->reference             = $request->referenceTombe;
            $tombe->nature                = $request->natureTombe;
            $tombe->montant               = $request->montantTombe;
            $tombe->devise                = $request->deviseTombe;
            $tombe->date_ech              = $request->date_echTombe;
            $tombe->date_proche           = $request->date_procheTombe;
            $tombe->category              = $request->categoryTombe;
            $tombe->id_compensation       = $compensation->id;

            $tombe->save();

        }

        //compte client
        if ($request['autreCompte'] !== null) {

            foreach($request->numCompteACC as $key=>$numCompteACC){

                $compte                        = new AutreCompte();
                $compte->num_compte             = $numCompteACC;
                $compte->montant                = $request->montantACC[$key];
                $compte->category               = $request->categoryACC[$key];
                $compte->id_compensation       = $compensation->id;

                $compte->save();

            }

        }else{

            $compte                        = new AutreCompte();
            $compte->num_compte             = $request->numCompteACC;
            $compte->montant                = $request->montantACC;
            $compte->category               = $request->categoryACC;
            $compte->id_compensation       = $compensation->id;

            $compte->save();

        }

        //derniere compensation
        if ($request['input_justif'] !== null) {

            foreach($request->promesse_new as $key=>$promesse_new){

                $derniere                           = new DerniereCompensation();
                $derniere->promesse_new             = $promesse_new;
                $derniere->valeur                   = $request->valeur[$key];
                $derniere->id_compensation            = $compensation->id;

                $derniere->save();

            }

        }else{
            $derniere                           = new DerniereCompensation();
            $derniere->promesse_new             = $request->promesse_new;
            $derniere->valeur                   = $request->valeur;
            $derniere->id_compensation            = $compensation->id;

            $derniere->save();
        }

        //impaye sur leasing 3017
        if ($request['impaye_compensation_leasing'] !== null) {

            foreach($request->num_compte_ImpLeasing as $key=>$num_compte_ImpLeasing){

                $leasing                        = new ImpayeLeasingCompensation();
                $leasing->num_compte            = $num_compte_ImpLeasing;
                $leasing->solde                 = $request->solde_leasing[$key];
                $leasing->currency              = $request->devise_leasing[$key];
                $leasing->opening_date          = $request->date_ouverture_leasing[$key];
                $leasing->id_compensation       = $compensation->id;

                $leasing->save();

            }

        }else{

            $leasing                            = new ImpayeLeasingCompensation();
            $leasing->num_compte                = $request->num_compte_ImpLeasing;
            $leasing->solde                     = $request->solde_leasing;
            $leasing->currency                  = $request->devise_leasing;
            $leasing->opening_date              = $request->date_ouverture_leasing;
            $leasing->id_compensation           = $compensation->id;

            $leasing->save();

        }

        //INCIDENT PAIEMENT
        if ($request['incident_paiement'] !== null) {

            foreach($request->refIncident as $key=>$refIncident){

                $incident                               = new IncidentPaiementComp();
                $incident->ref                          = $refIncident;
                $incident->num_chq                      = $request->numChqIncident[$key];
                $incident->code_presentation            = $request->codeIncident[$key];
                $incident->montant                      = $request->montantIncident[$key];
                $incident->currency                     = $request->currencyIncident[$key];
                $incident->date_emission                = $request->dateIncident[$key];
                $incident->rib_benef                    = $request->ribIncident[$key];
                $incident->nom_benef                    = $request->nomBenefIncident[$key];
                $incident->motif_rejet                  = $request->motifIncident[$key];
                $incident->date_regule                  = $request->DATEREGULEIncident[$key];
                $incident->stade                  		= $request->STADEIncident[$key];
                $incident->id_compensation              = $compensation->id;

                $incident->save();

            }

        }else{

            $incident                                 = new IncidentPaiementComp();
            $incident->ref                            = $request->refIncident;
            $incident->num_chq                        = $request->numChqIncident;
            $incident->code_presentation              = $request->codeIncident;
            $incident->montant                        = $request->montantIncident;
            $incident->currency                       = $request->currencyIncident;
            $incident->date_emission                  = $request->dateIncident;
            $incident->rib_benef                      = $request->ribIncident;
            $incident->nom_benef                      = $request->nomBenefIncident;
            $incident->motif_rejet                    = $request->motifIncident;
            $incident->date_regule                    = $request->DATEREGULEIncident;
            $incident->stade                  		  = $request->STADEIncident;
            $incident->id_compensation                = $compensation->id;

            $incident->save();

        }

        //ENCOURS EFFET ENCAISSEMENT
        if ($request['encours_effet'] !== null) {

            foreach($request->cfuEncours as $key=>$cfuEncours){

            $encours_effet                  = new EncoursEffet();
            $encours_effet->cfu       		= $cfuEncours;
            $encours_effet->num_effet       = $request->numEffetEncours[$key];
            $encours_effet->nom_tire        = $request->nomTireEffet[$key];
            $encours_effet->rib_tire        = $request->ribTireEffet[$key];
            $encours_effet->montant         = $request->montantEffet[$key];
            $encours_effet->date_echenace              = $request->dateEcheanceEffet[$key];
            $encours_effet->date_remise            = $request->dateRemiseEffet[$key];
            $encours_effet->id_compensation = $compensation->id;

            $encours_effet->save();

            }

        }else{

            $encours_effet                      = new EncoursEffet();
            $encours_effet->cfu           		= $request->cfuEncours;
            $encours_effet->num_effet           = $request->numEffetEncours;
            $encours_effet->nom_tire            = $request->nomTireEffet;
            $encours_effet->rib_tire            = $request->ribTireEffet;
            $encours_effet->montant                  = $request->montantEffet;
            $encours_effet->date_echenace                  = $request->dateEcheanceEffet;
            $encours_effet->date_remise                = $request->dateRemiseEffet;
            $encours_effet->id_compensation     = $compensation->id;

            $encours_effet->save();

        }

        if ($request['type_compensation'] !== null) {
            foreach ($request['type_compensation'] as $type_compensation) {
                $cd = new Compensation_details();
                $cd->value= $type_compensation['value'];
                $cd->beneficiare= $type_compensation['beneficiare'];
                $cd->name= $type_compensation['name'];
                $cd->code_compensation = $compensation->id;
                $cd->save();
            }
        }

        if ($request['justification_comp'] !== null) {
            foreach ($request['justification_comp'] as $justification_comp) {
                $cj = new Compensation_justification();
                $cj->value= $justification_comp['value'];
                $cj->name_justification_update= $justification_comp['name_justification_update'];
                $cj->id_compensation = $compensation->id;
                $cj->save();
            }
        }

        if ($request['impaye_client'] !== null) {
            foreach ($request['impaye_client'] as $impaye_client) {
                $im = new Impaye_client();
                $im->nature_impaye= $impaye_client['nature_impaye'];
                $im->montant_impaye= $impaye_client['montant_impaye'];
                $im->devise_impaye= $impaye_client['devise_impaye'];
                $im->id_compensation = $compensation->id;
                $im->save();
            }
        }

        if ($request->hasFile('engagement_client')) {
            $request->file('engagement_client')->move(public_path('upload/engagement'), $compensation->id . "_engagement_" . $compensation->nom_client . "." . $request->file('engagement_client')->getClientOriginalExtension());
        }

        if ($request->hasFile('risque_client')) {
            $request->file('risque_client')->move(public_path('upload/risque'), $compensation->id . "_risque_client_" . $compensation->nom_client . "." . $request->file('risque_client')->getClientOriginalExtension());
        }

        if ($request->hasFile('garantie')) {
            $request->file('garantie')->move(public_path('upload/garantie'), $compensation->id . "_garantie_client_" . $compensation->nom_client . "." . $request->file('garantie')->getClientOriginalExtension());
        }

        //gérant
        if ($request->hasFile('engagement_sed_gerant')) {
            $request->file('engagement_sed_gerant')->move(public_path('upload/engagementSEDGerant'), $compensation->id . "_engagement_gerant_sed_" . $compensation->agent_societe . "." . $request->file('engagement_sed_gerant')->getClientOriginalExtension());
        }

        if ($request->hasFile('credit_particulier_gerant')) {
            $request->file('credit_particulier_gerant')->move(public_path('upload/creditParticulierGerant'), $compensation->id . "_engagement_credit_particulier_gerant_" . $compensation->agent_societe . "." . $request->file('credit_particulier_gerant')->getClientOriginalExtension());
        }

        if ($request->hasFile('classement_gerant')) {
            $request->file('classement_gerant')->move(public_path('upload/creditClassementGerant'), $compensation->id . "_engagement_classement_gerant_" . $compensation->agent_societe . "." . $request->file('classement_gerant')->getClientOriginalExtension());
        }

        if ($request->hasFile('cheque_impaye_gerant')) {
            $request->file('cheque_impaye_gerant')->move(public_path('upload/ChqImpayeGerant'), $compensation->id . "_engagement_chq_impaye_gerant_" . $compensation->agent_societe . "." . $request->file('cheque_impaye_gerant')->getClientOriginalExtension());
        }

        //société béneficiare
        if ($request->hasFile('engagement_sed_ben')) {
            $request->file('engagement_sed_ben')->move(public_path('upload/engagementSEDBeneficiare'), $compensation->id . "_engagement_sed_beneficiaire_" . $compensation->nom_autre_sc . "." . $request->file('engagement_sed_ben')->getClientOriginalExtension());
        }

        if ($request->hasFile('classement_ben')) {
            $request->file('classement_ben')->move(public_path('upload/ClassementBeneficiare'), $compensation->id . "_classement_beneficiaire_" . $compensation->nom_autre_sc . "." . $request->file('classement_ben')->getClientOriginalExtension());
        }
    }
}
