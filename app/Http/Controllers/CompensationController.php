<?php

namespace App\Http\Controllers;

use Exception;
use SoapClient;
use App\Helpers\AgencyHelper;
use App\Models\Compensation\Compensation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Log;

class CompensationController extends Controller
{
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
        if ($request->ajax()) {

            $today = date('Y-m-d');

            $query = Compensation::with('avis_comp')
                ->whereDate('created_at', $today)
                ->where('status', 15)
                ->select('id', 'code_client', 'account_number', 'nom_client', 'name_secteur', 'classement_client', 'solde_compensation', 'date_compensation', 'updated_at', 'val_compensation', 'status', 'code_agence')
                ->orderBy('created_at', 'DESC');

            return DataTables::of($query)
                ->editColumn('date_compensation', function($comp) {
                    return $comp->date_compensation->format('Y-m-d');
                })
                ->editColumn('status', function($comp) {
                    $status = \App\Helpers\StatusHelper::getStatusLabel($comp->status);
                    if ($status) {
                        return '<span class="badge bg-' . $status['badge'] . '">' . $status['label'] . '</span>';
                    }
                    return '';
                })
                ->editColumn('code_agence', function($comp) use ($agencyHelper) {
                    return $agencyHelper->getAgencyName($comp->code_agence);
                })
                ->rawColumns(['status'])
                ->make(true);
        }
        return view('compensation.etat_journalier');
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
        try {
            $soap = new \SoapClient(env('SOAP_WSDL_URL'));

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

            $response = $soap->WSWORKFLOWCHQ($params);

            $client = data_get(
                (array) $response,
                'WSWORKFLOWCHQType.gWSWORKFLOWCHQDetailType.mWSWORKFLOWCHQDetailType.CUSTOMER'
            );

            if ($client) {
                return response()->json([
                    'compte' => 1,
                    'client' => $client,
                ]);
            }
        } catch (\Exception $e) {
            Log::error('SOAP Error: ' . $e->getMessage());
        }

        return response()->json(false);
    }    
}
