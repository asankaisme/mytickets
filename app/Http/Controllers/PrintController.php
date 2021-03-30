<?php

namespace App\Http\Controllers;

use App\Ticket;
use App\TicketAssignment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class PrintController extends Controller
{
    public function getStatusRep()
    {
        return view('reports.repControl');
    }

    public function printStatusRpt()
    {
        $tickets = Ticket::where('isActive', 1)->get();
        
        $pdf = App::make('snappy.pdf.wrapper');
        $title = 'Status Report';
        
        $pdf->loadView('reports.statusRp', [
            'title' => $title,
            'tickets' => $tickets
        ]);
        $pdf->setOptions([
            'footer-right' => '[page]'
        ]);
        return $pdf->inline('Status.pdf');
    }

    public function printSumRpt()
    {
        $allSysTickets = Ticket::where('isActive', 1)->get()->count();
        $allNewSysTickets = Ticket::select('*')->where('status', '=', 'NEW')->where('isActive', '=', 1)->get()->count();
        $allAssignedSysTickets = Ticket::select('*')->where('status', '=', 'ASSIGNED')->where('isActive', '=', 1)->get()->count();
        $allAcceptedSysTickets = Ticket::select('*')->where('status', '=', 'ACCEPTED')->where('isActive', '=', 1)->get()->count();
        $allCompletedSysTickets = Ticket::select('*')->where('status', '=', 'COMPLETED')->where('isActive', '=', 1)->get()->count();
        //get priority level-wise counts
        //Notice level count
        $allNoticableTickets = TicketAssignment::where('ticket_priority_id', 1)->get()->count();
        $allNewNoticableTkts = TicketAssignment::select('*')->where('ticket_priority_id', '=', 1)->where('status', '=', 'NEW')->get()->count();
        $allNoticableAssignedTickets = TicketAssignment::select('*')->where('ticket_priority_id', '=', 1)->where('status', '=', 'ASSIGNED')->get()->count();
        $allNoticeAccptedTickets = TicketAssignment::select('*')->where('ticket_priority_id', '=', 1)->where('status', '=', 'ACCEPTED')->get()->count();
        $allNoticeCompletedTickets = TicketAssignment::select('*')->where('ticket_priority_id', '=', 1)->where('status', '=', 'COMPLETED')->get()->count();
        //Minor level count
        $allMinorTickets = TicketAssignment::where('ticket_priority_id', 2)->get()->count();
        $allNewMinorTkts = TicketAssignment::select('*')->where('ticket_priority_id', '=', 2)->where('status', '=', 'NEW')->get()->count();
        $allMinorAssignedTickets = TicketAssignment::select('*')->where('ticket_priority_id', '=', 2)->where('status', '=', 'ASSIGNED')->get()->count();
        $allMinorAccptedTickets = TicketAssignment::select('*')->where('ticket_priority_id', '=', 2)->where('status', '=', 'ACCEPTED')->get()->count();
        $allMinorCompletedTickets = TicketAssignment::select('*')->where('ticket_priority_id', '=', 2)->where('status', '=', 'COMPLETED')->get()->count();
        //Major level counts
        $allMajorTickets = TicketAssignment::where('ticket_priority_id', 3)->get()->count();
        $allNewMajorTkts = TicketAssignment::select('*')->where('ticket_priority_id', '=', 3)->where('status', '=', 'NEW')->get()->count();
        $allMajorAssignedTickets = TicketAssignment::select('*')->where('ticket_priority_id', '=', 3)->where('status', '=', 'ASSIGNED')->get()->count();
        $allMajorAccptedTickets = TicketAssignment::select('*')->where('ticket_priority_id', '=', 3)->where('status', '=', 'ACCEPTED')->get()->count();
        $allMajorCompletedTickets = TicketAssignment::select('*')->where('ticket_priority_id', '=', 3)->where('status', '=', 'COMPLETED')->get()->count();
        //Critical level counts
        $allCriticalTickets = TicketAssignment::where('ticket_priority_id', 4)->get()->count();
        $allNewCriticalTkts = TicketAssignment::select('*')->where('ticket_priority_id', '=', 4)->where('status', '=', 'NEW')->get()->count();
        $allCriticalAssignedTickets = TicketAssignment::select('*')->where('ticket_priority_id', '=', 4)->where('status', '=', 'ASSIGNED')->get()->count();
        $allCriticalAccptedTickets = TicketAssignment::select('*')->where('ticket_priority_id', '=', 4)->where('status', '=', 'ACCEPTED')->get()->count();
        $allCriticalCompletedTickets = TicketAssignment::select('*')->where('ticket_priority_id', '=', 4)->where('status', '=', 'COMPLETED')->get()->count();

        $pdf = App::make('snappy.pdf.wrapper');
        $title = 'Summary Report';

        $pdf->loadView('reports.sumRp', compact(
            'allSysTickets',
            'allNewSysTickets',
            'allAssignedSysTickets',
            'allAcceptedSysTickets',
            'allCompletedSysTickets',
            //----------------------
            'allNoticableTickets',
            'allNewNoticableTkts',
            'allNoticableAssignedTickets',
            'allNoticeAccptedTickets',
            'allNoticeCompletedTickets',
            //-------------------------
            'allMinorTickets',
            'allNewMinorTkts',
            'allMinorAssignedTickets',
            'allMinorAccptedTickets',
            'allMinorCompletedTickets',
            //-----------------------
            'allMajorTickets',
            'allNewMajorTkts',
            'allMajorAssignedTickets',
            'allMajorAccptedTickets',
            'allMajorCompletedTickets',
            //-----------------------
            'allCriticalTickets',
            'allNewCriticalTkts',
            'allCriticalAssignedTickets',
            'allCriticalAccptedTickets',
            'allCriticalCompletedTickets',
        ));

        $pdf->setOptions([
            'footer-right' => '[page]'
        ]);
        return $pdf->inline('Summary.pdf');
    }
}
