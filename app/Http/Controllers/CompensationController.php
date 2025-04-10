<?php

namespace App\Http\Controllers;

use App\Models\Compensation\Compensation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CompensationController extends Controller
{
    public function list()
    {

        $today = date('Y-m-d');
        $user = Auth::user();

        $hasAgency = !empty($user->agence_id);

        $baseQuery = Compensation::whereDate('date_compensation', $today)
            ->whereNull('test');

        if ($hasAgency) {
            $baseQuery->where('code_agence', $user->agence_id);
        }

        $compensations = $baseQuery
            ->select('code_client', 'nom_client', 'date_compensation', 'status', 'code_agence')
            ->orderByDesc('created_at')
            ->paginate(25);

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
            'compensations' => $compensations,
            'counts' => $counts,
            'hasAgency' => $hasAgency,
        ]);

    }

    public function historique()
    {
        $today = date('Y-m-d');
        $user = Auth::user();
        $hasAgency = !empty($user->agence_id);

        $baseQuery = Compensation::whereDate('date_compensation', '!=', $today)
            ->whereNull('test');

        if ($hasAgency) {
            $baseQuery->where('code_agence', $user->agence_id);
        }

        $compensations = $baseQuery
            ->select('code_client', 'nom_client', 'date_compensation', 'status', 'code_agence')
            ->orderByDesc('created_at')
            ->paginate(100);

        $counts = Compensation::whereDate('date_compensation', '!=', $today)
            ->whereNull('test')
            ->selectRaw("
                COUNT(*) as total,
                SUM(CASE WHEN status_final = 1 THEN 1 ELSE 0 END) as attent,
                SUM(CASE WHEN status_final = 2 THEN 1 ELSE 0 END) as accept,
                SUM(CASE WHEN status_final = 3 THEN 1 ELSE 0 END) as refuse
            ")
            ->first();

        $counts_agency = $hasAgency ? Compensation::whereDate('date_compensation', '!=', $today)
            ->where('code_agence', $user->agence_id)
            ->whereNull('test')
            ->selectRaw("
                COUNT(*) as total,
                SUM(CASE WHEN status_final = 1 THEN 1 ELSE 0 END) as attent,
                SUM(CASE WHEN status_final = 2 THEN 1 ELSE 0 END) as accept,
                SUM(CASE WHEN status_final = 3 THEN 1 ELSE 0 END) as refuse
            ")
            ->first() : null;

        return view('compensation.historique', [
            'compensations' => $compensations,
            'counts' => $counts,
            'counts_agency' => $counts_agency,
            'hasAgency' => $hasAgency,
        ]);
    }

    public function etatJournalier()
    {
        $today = date('Y-m-d');

        $compensations = Compensation::with('avis_comp')
        ->whereDate('created_at', $today)
        ->where('status', 15)
        ->select('id', 'code_client', 'account_number', 'nom_client', 'name_secteur', 'classement_client', 'solde_compensation', 'date_compensation', 'updated_at', 'val_compensation', 'status', 'code_agence')
        ->orderBy('created_at', 'DESC')
        // ->paginate(25);
        ->get();

        return view('compensation.etat_journalier', compact('compensations'));
    }

    public function extrait(){
        $compensations = Compensation::select('code_client', 'nom_client', 'date_compensation', 'code_agence', 'status')
        ->orderBy('created_at', 'DESC')
        ->paginate(20);
        // ->get();

        return view('compensation.extrait', compact('compensations'));
    }
}
