<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TicketAssignment;
use Carbon\Carbon;

class KpiController extends Controller
{
    //this method initializes authenticating module
    public function _construct()
    {
        return $this->middleware('auth');
    }

    //displays durations for tickets to be completed by suppport engineers
    public function index()
    {
        $ticketsAssigned = TicketAssignment::where('status', 'COMPLETED')->get();
        // foreach($ticketsAssigned as $ticketAssigned){
        //     $supEng = $ticketAssigned->assignedTo->name;
        //     $startTime = Carbon::parse($ticketAssigned->created_at);
        //     $endTime = Carbon::parse($ticketAssigned->updated_at);
        //     $totalDuration = $endTime->diffForHumans($startTime);
        //     echo $supEng, $totalDuration;
        // }

        return view('kpis.index', compact('ticketsAssigned'));
        
        
    }
}
