<?php

namespace App\Http\Controllers;

use App\TicketHeader;
use Illuminate\Http\Request;

class TicketHeaderController extends Controller
{
    public function _construct()
    {
        return $this->middleware('auth');
    }

    public function index()
    {
        return view('headers.index');
    }

    
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'hTitle' => 'required|max:255|min:2',
            'hDescription' => 'required|min:2|max:1000'
        ]);

        TicketHeader::create($data);

        session()->flash('message', 'Ticket header is successfully added.');
        return redirect()->route('headers.index');
    }

    
    public function show(TicketHeader $ticketHeader)
    {
        //
    }

    
    public function edit(TicketHeader $ticketHeader)
    {
        //
    }

    
    public function update(Request $request, TicketHeader $ticketHeader)
    {
        //
    }

    
    public function destroy(TicketHeader $ticketHeader)
    {
        //
    }
}
