<?php

namespace App\Http\Controllers;

use App\Models\Compensation;
use Illuminate\Http\Request;

class CompensationController extends Controller
{
    public function list()
    {

        $today = date('Y-m-d');
        // $user = Auth::user();
        // $hasAgency = !empty($user->agence_id);
        $hasAgency = false;

        $baseQuery = Compensation::whereDate('date_compensation', $today)
            ->whereNull('test');

        // if($hasAgency){
        //     $baseQuery->where('code_agence', $user->agence_id);
        // }
        
            
        $compensations = $baseQuery
            ->with('Agence_function')
            ->select('code_client', 'nom_client', 'date_compensation', 'status_final')
            ->orderByDesc('created_at')
            ->paginate(25);

        $counts = Compensation::whereDate('date_compensation', $today)
            ->whereNull('test')
            ->selectRaw("
                COUNT(*) as total, 
                SUM(CASE WHEN status_final = 1 THEN 1 ELSE 0 END) as attent, 
                SUM(CASE WHEN status_final = 2 THEN 1 ELSE 0 END) as accept, 
                SUM(CASE WHEN status_final = 3 THEN 1 ELSE 0 END) as refuse
            ")->first();

        return view('compensation.list', [
            'compensations' => $compensations,
            'counts' => $counts,
            'hasAgency' => $hasAgency
        ]);
    }
}
