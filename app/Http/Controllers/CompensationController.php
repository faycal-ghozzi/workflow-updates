<?php

namespace App\Http\Controllers;

use Exception;
use SoapClient;
use App\Services\SoapService;
use App\Helpers\AgencyHelper;
use App\Models\Agence;
use App\Models\Compensation\AutreCompte;
use App\Models\Compensation\Compensation;
use App\Models\Compensation\CompensationDetails;
use App\Models\Compensation\CompensationJustification;
use App\Models\Compensation\ImpayeClient;
use App\Models\Compensation\CreditCompensation;
use App\Models\Compensation\DerniereCompensation;
use App\Models\Compensation\EncoursCompensation;
use App\Models\Compensation\EncoursEffet;
use App\Models\Compensation\EngagementGerant;
use App\Models\Compensation\ImpayeBesoin;
use App\Models\Compensation\ImpayeLeasingCompensation;
use App\Models\Compensation\IncidentPaiementComp;
use App\Models\Compensation\PlacementCompensation;
use App\Models\Compensation\TombeProcheCompensation;
use Illuminate\Http\Request;
use Carbon\Carbon;
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

                    $viewUrl = route('compensation.display', ['id' => $compensation->id]);
                    $editUrl = route('compensation.edit', ['id' => $compensation->id]);
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
                return view('compensation.insertion_partials.informations_generales', $data);
            
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

                return view('compensation.insertion_partials.compensation', $data);
        
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
                return view('compensation.insertion_partials.client', $data);
            
            case 'derniere_compensation':

                $data['derniereCompensation'] = $derniereCompensation;

                return view('compensation.insertion_partials.derniere_compensation', $data);
            
            case 'beneficiaire':
                return view('compensation.insertion_partials.beneficiaire', $data);
            
            case 'commentaires':
                return view('compensation.insertion_partials.commentaires');
            
            // commented since it is non-working for now

            case 'comptes_client':
                // list Autre comptes is infos globales ._.
                // $data['infosGlobales'] = $fetchSoapData('WSINFORMATIONGLOB', [
                //     'enquiryInputCollection' => [
                //         ["columnName" => "CODE.CLIENT", "criteriaValue" => $id_client, "operand" => "EQ"],
                //         ["columnName" => "NUM.COMPTE", "criteriaValue" => $account, "operand" => "EQ"]
                //     ]
                // ]) ?? [];
                return view('compensation.insertion_partials.comptes_client');
        }
    }

    public function addRequest(Request $request){
        $id_client = $request->input('client_code');
        $account = $request->input('account_number');

        return view('compensation.add_request', compact(
                    'id_client', 'account'
                ));
    }

    private function storeMultipleOrSingle(Request $request, string $checkKey, string $modelClass, array $fields, $compensationId)
    {
        $isMultiple = $request[$checkKey] !== null;
        $source = $isMultiple ? $request[array_values($fields)[0]] : [0];

        foreach ($source as $key => $_) {
            $data = ['id_compensation' => $compensationId];
            foreach ($fields as $field => $inputKey) {
                $data[$field] = $isMultiple ? $request[$inputKey][$key] ?? null : $request[$inputKey] ?? null;
            }
            $modelClass::create($data);
        }
    }

    private function handleUpload(Request $request, string $field, string $folder, $id, $label)
    {
        if ($request->hasFile($field)) {
            $file = $request->file($field);
            $filename = "{$id}_{$field}_{$label}." . $file->getClientOriginalExtension();
            $file->move(public_path($folder), $filename);
        }
    }

    public function store_compensation(Request $request)
    {

        $data = $request->all();

        if (!empty($data['date_compensation'])) {
            $data['date_compensation'] = \Carbon\Carbon::createFromFormat('d/m/Y', $data['date_compensation'])->startOfDay();
        }

        $compensation = Compensation::create($data);
        

        $this->storeMultipleOrSingle($request, 'engagement_store', EngagementGerant::class, [
            'code_gerant'           => 'code_gerant',
            'nom_gerant'            => 'nom_gerant',
            'client'                => 'client',
            'classement'            => 'classementEng',
            'engagement'            => 'engagement',
            'type_eng_gerant'       => 'type_eng_gerant',
            'date_eng_gerant'       => 'date_eng_gerant',
            'montant_eng_gerant'    => 'montant_eng_gerant',
            'devise'                => 'devise',
            'encours_tnd'           => 'encours_tnd',
        ], $compensation->id);

        // Store all child collections
        $this->storeMultipleOrSingle($request, 'placement_compensation', PlacementCompensation::class, [
            'reference' => 'referenceP',
            'nature'    => 'natureP',
            'montant'   => 'montantP',
            'devise'    => 'deviseP',
            'du'        => 'du',
            'au'        => 'au',
            'taux'      => 'taux',
            'basetmm'   => 'basetmm',
            'marge'     => 'marge',
        ], $compensation->id);

        $this->storeMultipleOrSingle($request, 'credit_compensation', CreditCompensation::class, [
            'reference' => 'referenceCred',
            'libelle'   => 'libelleCred',
            'category'  => 'categoryCred',
            'encours'   => 'encoursCred',
            'date'      => 'dateCred',
        ], $compensation->id);

        $this->storeMultipleOrSingle($request, 'impaye_compensation', ImpayeBesoin::class, [
            'ref'             => 'refImp',
            'nature_besoin'   => 'nature_besoinImp',
            'valeur_besoin'   => 'valeur_besoinImp',
            'devise'          => 'deviseImp',
            'mantant_tnd'     => 'mantant_tndImp',
            'echeance_besoin' => 'echeance_besoinImp',
        ], $compensation->id);

        $this->storeMultipleOrSingle($request, 'encours_compensation', EncoursCompensation::class, [
            'reference' => 'referenceEnc',
            'montant'   => 'montantEnc',
            'devise'    => 'deviseEnc',
            'numbord'   => 'numbord',
            'date'      => 'dateEnc',
        ], $compensation->id);

        $this->storeMultipleOrSingle($request, 'tombe_compensation', TombeProcheCompensation::class, [
            'reference'     => 'referenceTombe',
            'nature'        => 'natureTombe',
            'montant'       => 'montantTombe',
            'devise'        => 'deviseTombe',
            'date_ech'      => 'date_echTombe',
            'date_proche'   => 'date_procheTombe',
            'category'      => 'categoryTombe',
        ], $compensation->id);

        $this->storeMultipleOrSingle($request, 'autreCompte', AutreCompte::class, [
            'num_compte' => 'numCompteACC',
            'montant'    => 'montantACC',
            'category'   => 'categoryACC',
        ], $compensation->id);

        $this->storeMultipleOrSingle($request, 'input_justif', DerniereCompensation::class, [
            'promesse_new' => 'promesse_new',
            'valeur'       => 'valeur',
        ], $compensation->id);

        $this->storeMultipleOrSingle($request, 'impaye_compensation_leasing', ImpayeLeasingCompensation::class, [
            'num_compte'    => 'num_compte_ImpLeasing',
            'solde'         => 'solde_leasing',
            'currency'      => 'devise_leasing',
            'opening_date'  => 'date_ouverture_leasing',
        ], $compensation->id);

        $this->storeMultipleOrSingle($request, 'incident_paiement', IncidentPaiementComp::class, [
            'ref'               => 'refIncident',
            'num_chq'           => 'numChqIncident',
            'code_presentation' => 'codeIncident',
            'montant'           => 'montantIncident',
            'currency'          => 'currencyIncident',
            'date_emission'     => 'dateIncident',
            'rib_benef'         => 'ribIncident',
            'nom_benef'         => 'nomBenefIncident',
            'motif_rejet'       => 'motifIncident',
            'date_regule'       => 'DATEREGULEIncident',
            'stade'             => 'STADEIncident',
        ], $compensation->id);

        $this->storeMultipleOrSingle($request, 'encours_effet', EncoursEffet::class, [
            'cfu'           => 'cfuEncours',
            'num_effet'     => 'numEffetEncours',
            'nom_tire'      => 'nomTireEffet',
            'rib_tire'      => 'ribTireEffet',
            'montant'       => 'montantEffet',
            'date_echenace' => 'dateEcheanceEffet',
            'date_remise'   => 'dateRemiseEffet',
        ], $compensation->id);

        // Compensation Details
        if ($request->type_compensation !== null) {
            foreach ($request->type_compensation as $item) {
                CompensationDetails::create([
                    'value'             => $item['value'],
                    'beneficiare'       => $item['beneficiare'],
                    'name'              => $item['name'],
                    'code_compensation' => $compensation->id,
                ]);
            }
        }

        // Justifications
        if ($request->justification_comp !== null) {
            foreach ($request->justification_comp as $item) {
                CompensationJustification::create([
                    'value'                     => $item['value'],
                    'name_justification_update' => $item['name_justification_update'],
                    'id_compensation'           => $compensation->id,
                ]);
            }
        }

        // Impayé Client
        if ($request->impaye_client !== null) {
            foreach ($request->impaye_client as $item) {
                ImpayeClient::create([
                    'nature_impaye'    => $item['nature_impaye'],
                    'montant_impaye'   => $item['montant_impaye'],
                    'devise_impaye'    => $item['devise_impaye'],
                    'id_compensation'  => $compensation->id,
                ]);
            }
        }

        $this->handleUpload($request, 'engagement_client', 'upload/engagement', $compensation->id, $compensation->nom_client);
        $this->handleUpload($request, 'risque_client', 'upload/risque', $compensation->id, $compensation->nom_client);
        $this->handleUpload($request, 'garantie', 'upload/garantie', $compensation->id, $compensation->nom_client);
        $this->handleUpload($request, 'engagement_sed_gerant', 'upload/engagementSEDGerant', $compensation->id, $compensation->agent_societe);
        $this->handleUpload($request, 'credit_particulier_gerant', 'upload/creditParticulierGerant', $compensation->id, $compensation->agent_societe);
        $this->handleUpload($request, 'classement_gerant', 'upload/creditClassementGerant', $compensation->id, $compensation->agent_societe);
        $this->handleUpload($request, 'cheque_impaye_gerant', 'upload/ChqImpayeGerant', $compensation->id, $compensation->agent_societe);
        $this->handleUpload($request, 'engagement_sed_ben', 'upload/engagementSEDBeneficiare', $compensation->id, $compensation->nom_autre_sc);
        $this->handleUpload($request, 'classement_ben', 'upload/ClassementBeneficiare', $compensation->id, $compensation->nom_autre_sc);

        return response()->json(['message' => 'Compensation enregistrée avec succès']);
    }

    public function display($id)
    {

        // Main compensation record
        $view_comp = Compensation::findOrFail($id);

        // Aggregate sums for Impaye tables
        $impaye_client = ImpayeClient::where('id_compensation', $id)->sum('montant_impaye');
        $impaye_client_besoin = ImpayeBesoin::where('id_compensation', $id)->sum('mantant_tnd');

        // Fetch all TombeProcheCompensation rows and group by category
        $tombe_data = TombeProcheCompensation::where('id_compensation', $id)->get()->groupBy('category');

        $tombe = $tombe_data->get(21050)?->sum('montant') ?? 0;
        $tombe_view = $tombe_data->get(21050) ?? collect();

        $decouvert = $tombe_data->get(21059)?->sum('montant') ?? 0;
        $decouvert_view = $tombe_data->get(21059) ?? collect();

        // Fetch all CreditCompensation rows and group by category
        $credit_data = CreditCompensation::where('id_compensation', $id)->get()->groupBy('category');

        $escompte_credit = $credit_data->get(21050)?->sum('encours') ?? 0;
        $escompte_credit_view = $credit_data->get(21050) ?? collect();

        $decouvert_credit = $credit_data->get(21059)?->sum('encours') ?? 0;
        $decouvert_credit_view = $credit_data->get(21059) ?? collect();

        $financement_credit = $credit_data->get(21066)?->sum('encours') ?? 0;
        $financement_credit_view = $credit_data->get(21066) ?? collect();

        // Return all to the view
        return view('compensation.display', compact(
            'view_comp',
            'impaye_client',
            'impaye_client_besoin',
            'tombe',
            'tombe_view',
            'decouvert',
            'decouvert_view',
            'escompte_credit',
            'escompte_credit_view',
            'decouvert_credit',
            'decouvert_credit_view',
            'financement_credit',
            'financement_credit_view'
        ));
    }

}
