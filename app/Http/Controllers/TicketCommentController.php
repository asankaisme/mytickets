<?php

namespace App\Http\Controllers;

use App\Ticket;
use App\TicketComment;
use Illuminate\Http\Request;

class TicketCommentController extends Controller
{
    public function _construct()
    {
        return $this->middleware('auth');
    }

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }
   
    public function store(Request $request)
    {
        $request->validate([
            'ticketId' => 'required',
            'diagnosis' => 'required|min:2|max:2000',
            'solution' => 'required|min:2|max:2000',
        ]);

        $tc = new TicketComment();
        $tc->ticket_id = $request->ticketId;
        $tc->diagnosis = $request->diagnosis;
        $tc->solution = $request->solution;
        $tc->user_id = auth()->user()->id;
        $tc->isActive = 1;
        $tc->save();
        $originalTicket = Ticket::findOrFail($request->ticketId);
        $originalTicket->status = "COMPLETED";
        $originalTicket->update();
        $originalTicket->ticketAssignment->status = 'COMPLETED';
        $originalTicket->ticketAssignment->update();
        session()->flash('message', 'This ticket is completed and closed.');
        return redirect()->route('Todos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TicketComment  $ticketComment
     * @return \Illuminate\Http\Response
     */
    public function show(TicketComment $ticketComment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TicketComment  $ticketComment
     * @return \Illuminate\Http\Response
     */
    public function edit(TicketComment $ticketComment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TicketComment  $ticketComment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TicketComment $ticketComment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TicketComment  $ticketComment
     * @return \Illuminate\Http\Response
     */
    public function destroy(TicketComment $ticketComment)
    {
        //
    }
}
