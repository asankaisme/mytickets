<?php

namespace App\Http\Controllers;

use App\User;
use App\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    
    public function _construct()
    {
        return $this->middleware('auth');
    }

    public function index()
    {
        $tickets = Ticket::where('isActive', 1)->with('createdBy')->get();
        return view('tickets.index', compact('tickets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('tickets.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',  
            'body' => 'required|max:1000'
        ]);

        $newTicket = new Ticket();
        $newTicket->title = $request->title;
        $newTicket->body = $request->body;
        $newTicket->created_by = auth()->user()->id;
        $newTicket->status = 'NEW';
        $newTicket->isActive = 1;
        $newTicket->save();
        session()->flash('message', 'New ticket successfully added.');
        return redirect()->route('tickets.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function show(Ticket $ticket)
    {
        $supEngs = User::role(['Support Engineer'])->get();
        return view('tickets.show', compact('ticket', 'supEngs'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function edit(Ticket $ticket)
    {
        // dd($ticket->id);
        // $ticket = Ticket::findOrFail($id)->get();
        return view('tickets.edit', compact('ticket'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ticket $ticket)
    {
        $data = $request->validate([
            'title' => 'required|max:255',
            'body' => 'required|max:1000'
        ]);

        $ticket->update($data);
        session()->flash('message', 'Ticket details updated successfully.');
        return redirect()->route('tickets.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticket $ticket)
    {
        //record will not be actually deleted.
        //isActive property will be changed to 0
        //index method only shows isActive = 1

        $ticket->isActive = 0;
        $ticket->update();
        session()->flash('message', 'Ticket deleted successfully.');
        return redirect()->route('tickets.index');
    }
}
