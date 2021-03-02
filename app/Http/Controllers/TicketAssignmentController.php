<?php

namespace App\Http\Controllers;

use App\User;
use App\Ticket;
use App\TicketAssignment;
use App\TicketHeader;
use App\TicketPriority;
use Illuminate\Http\Request;

class TicketAssignmentController extends Controller
{
    public function _construct()
    {
        return $this->middleware('auth');
    }

    public function index()
    {
        $ticketAssignments = Ticket::all();
        return view('ticketAssignments.index', compact('ticketAssignments'));
    }

    
    public function create()
    {
        //
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'selectSupEng' => ['required'],
            'selectHeader' => ['required'],
            'selectPriority' => ['required'],
        ]);

        $ta = new TicketAssignment();
        $ta->ticket_id = $request->ticketId;
        $ta->ticket_header_id = $request->selectHeader;
        $ta->ticket_priority_id = $request->selectPriority;
        $ta->assigned_by = auth()->user()->id;
        $ta->assigned_to = $request->selectSupEng;
        $ta->status = "ASSIGNED";
        $ta->isActive = 1;
        $ta->save();
        $actualTicket = Ticket::findOrFail($request->ticketId);
        $actualTicket->status = "ASSIGNED";
        $actualTicket->update();
        session()->flash('message', 'The ticket #'.$request->ticketId.' has been succefully assigned to SE - '.$request->selectSupEng.'.');
        return redirect()->route('ticketAssignments.index');
    }

    
    public function show($id)
    {
        $ticket = Ticket::findOrFail($id);
        $supEngs = User::role(['Support Engineer'])->get();
        $priorityLevels = TicketPriority::where('isActive', 1)->get();
        $headers = TicketHeader::where('isActive', 1)->get();
        return view('ticketAssignments.show', compact('ticket', 'supEngs', 'priorityLevels', 'headers'));
    }

    
    public function edit(TicketAssignment $ticketAssignment)
    {
        //
    }

    
    public function update(Request $request, TicketAssignment $ticketAssignment)
    {
        //
    }

    
    public function destroy(TicketAssignment $ticketAssignment)
    {
        //
    }
}
