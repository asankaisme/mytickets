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
        $headers = TicketHeader::where('isActive', 1)->get();
        return view('headers.index', compact('headers'));
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

    
    public function edit($id)
    {
        $header = TicketHeader::findOrFail($id);
        return view('headers.edit', compact('header'));
    }

    
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'hTitle' => 'required|max:255|min:2',
            'hDescription' => 'required|min:2|max:1000'
        ]);

        $header = TicketHeader::findOrFail($id);
        $header->update($data);

        session()->flash('message', 'Ticket header is successfully updated.');
        return redirect()->route('headers.index');

    }

    
    public function destroy($id)
    {
        $header = TicketHeader::findOrFail($id);
        $header->isActive = 0;
        $header->update();
        session()->flash('message', 'Ticket header is successfully deleted.');
        return redirect()->route('headers.index');

    }
}
