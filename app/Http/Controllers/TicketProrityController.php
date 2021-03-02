<?php

namespace App\Http\Controllers;

use App\TicketPrority;
use Illuminate\Http\Request;

class TicketProrityController extends Controller
{
    public function _construct()
    {
        return $this->middleware('auth');
    }
    
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TicketPrority  $ticketPrority
     * @return \Illuminate\Http\Response
     */
    public function show(TicketPrority $ticketPrority)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TicketPrority  $ticketPrority
     * @return \Illuminate\Http\Response
     */
    public function edit(TicketPrority $ticketPrority)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TicketPrority  $ticketPrority
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TicketPrority $ticketPrority)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TicketPrority  $ticketPrority
     * @return \Illuminate\Http\Response
     */
    public function destroy(TicketPrority $ticketPrority)
    {
        //
    }
}
