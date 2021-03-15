<?php

namespace App\Http\Controllers;

use App\Todo;
use App\Ticket;
use App\TicketAssignment;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function _construct()
    {
        return $this->middleware('auth');
    }

    public function index()
    {
        $jobsToDo = auth()->user()->TicketsAssignedTo;
        // dd($jobsToDo);
        return view('ToDos.index', compact('jobsToDo'));
    }
    
    public function show($id)
    {
        $ticketToDo = Ticket::findOrFail($id);
        // dd($ticketToDo);
        return view('ToDos.show', compact('ticketToDo'));
    }

    
    public function edit(Todo $todo)
    {
        //
    }

    
    public function update(Request $request, Todo $todo)
    {
        //
    }

    public function acceptTicket($id)
    {
        $getTicket = Ticket::findOrFail($id);
        $getTicket->status = "ACCEPTED";
        $getTicket->update();
        session()->flash('message', 'You accepted this ticket.');
        return redirect()->route('Todos.show', $id);
    }
    public function raiseToL2($id)
    {
        return $id.' OK';
    }
}
