<?php

namespace App\Http\Controllers;

use App\User;
use App\Ticket;
use App\TicketAssignment;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        //user specific datasets
        $allTickets = auth()->user()->ticket()->where('isActive', '=', 1)->get()->count();
        $allCompletedTickets = auth()->user()->ticket()->select('*')->where('status', '=', 'COMPLETED')->where('isActive', '=', 1)->get()->count();
        $allAssignedTickets = auth()->user()->ticket()->select('*')->where('status', '=', 'ASSIGNED')->where('isActive', '=', 1)->get()->count();
        $allNewTickets = auth()->user()->ticket()->select('*')->where('status', '=', 'NEW')->where('isActive', '=', 1)->get()->count();
        $allAcceptedTickets = auth()->user()->ticket()->select('*')->where('status', '=', 'ACCEPTED')->where('isActive', '=', 1)->get()->count();
        // dd($allCompletedTickets);
        //system specific dataset
        $allSysTickets = Ticket::where('isActive', 1)->get()->count();
        $allNewSysTickets = Ticket::select('*')->where('status', '=', 'NEW')->where('isActive', '=', 1)->get()->count();
        $allAssignedSysTickets = Ticket::select('*')->where('status', '=', 'ASSIGNED')->where('isActive', '=', 1)->get()->count();
        $allAcceptedSysTickets = Ticket::select('*')->where('status', '=', 'ACCEPTED')->where('isActive', '=', 1)->get()->count();
        $allCompletedSysTickets = Ticket::select('*')->where('status', '=', 'COMPLETED')->where('isActive', '=', 1)->get()->count();
        //get priority level-wise counts
        //Notice level count
        $allNoticableTickets = TicketAssignment::where('ticket_priority_id', 1)->get()->count();
        $allNoticableAssignedTickets = TicketAssignment::select('*')->where('ticket_priority_id', '=', 1)->where('status', '=', 'ASSIGNED')->get()->count();
        $allNoticeAccptedTickets = TicketAssignment::select('*')->where('ticket_priority_id', '=', 1)->where('status', '=', 'ACCEPTED')->get()->count();
        $allNoticeCompletedTickets = TicketAssignment::select('*')->where('ticket_priority_id', '=', 1)->where('status', '=', 'COMPLETED')->get()->count();
        //Minor level count
        $allMinorTickets = TicketAssignment::where('ticket_priority_id', 2)->get()->count();
        $allMinorAssignedTickets = TicketAssignment::select('*')->where('ticket_priority_id', '=', 2)->where('status', '=', 'ASSIGNED')->get()->count();
        $allMinorAccptedTickets = TicketAssignment::select('*')->where('ticket_priority_id', '=', 2)->where('status', '=', 'ACCEPTED')->get()->count();
        $allMinorCompletedTickets = TicketAssignment::select('*')->where('ticket_priority_id', '=', 2)->where('status', '=', 'COMPLETED')->get()->count();
        //Major level counts
        $allMajorTickets = TicketAssignment::where('ticket_priority_id', 3)->get()->count();
        $allMajorAssignedTickets = TicketAssignment::select('*')->where('ticket_priority_id', '=', 3)->where('status', '=', 'ASSIGNED')->get()->count();
        $allMajorAccptedTickets = TicketAssignment::select('*')->where('ticket_priority_id', '=', 3)->where('status', '=', 'ACCEPTED')->get()->count();
        $allMajorCompletedTickets = TicketAssignment::select('*')->where('ticket_priority_id', '=', 3)->where('status', '=', 'COMPLETED')->get()->count();
        //Critical level counts
        $allCriticalTickets = TicketAssignment::where('ticket_priority_id', 4)->get()->count();
        $allCriticalAssignedTickets = TicketAssignment::select('*')->where('ticket_priority_id', '=', 4)->where('status', '=', 'ASSIGNED')->get()->count();
        $allCriticalAccptedTickets = TicketAssignment::select('*')->where('ticket_priority_id', '=', 4)->where('status', '=', 'ACCEPTED')->get()->count();
        $allCriticalCompletedTickets = TicketAssignment::select('*')->where('ticket_priority_id', '=', 4)->where('status', '=', 'COMPLETED')->get()->count();

        return view('home', compact(
            'allTickets',
            'allCompletedTickets',
            'allAssignedTickets',
            'allNewTickets',
            'allAcceptedTickets',
            'allSysTickets',
            'allNewSysTickets',
            'allAssignedSysTickets',
            'allAcceptedSysTickets',
            'allCompletedSysTickets',
            'allNoticableTickets',
            'allNoticableAssignedTickets',
            'allNoticeAccptedTickets',
            'allNoticeCompletedTickets',
            'allMinorTickets',
            'allMinorAssignedTickets',
            'allMinorAccptedTickets',
            'allMinorCompletedTickets',
            'allMajorTickets',
            'allMajorAssignedTickets',
            'allMajorAccptedTickets',
            'allMajorCompletedTickets',
            'allCriticalTickets',
            'allCriticalAssignedTickets',
            'allCriticalAccptedTickets',
            'allCriticalCompletedTickets'
        ));
    }
}
