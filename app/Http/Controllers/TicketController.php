<?php

namespace App\Http\Controllers;

use App\User;
use App\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TicketController extends Controller
{
    
    public function _construct()
    {
        return $this->middleware('auth');
    }

    public function index()
    {
        $tickets = auth()->user()->ticket->where('isActive', 1);
        return view('tickets.index', compact('tickets'));
    }

    
    public function create()
    {
        return view('tickets.create');
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',  
            'body' => 'required|max:1000'
        ]);
        
        $newTicket = new Ticket();
        $newTicket->title = $request->title;
        $newTicket->body = $request->body;

        if($request->hasFile('img_name')){
            $fileName = $request->img_name->getClientOriginalName();
            $request->img_name->storeAs('screenshots', $fileName, 'public');
            $newTicket->img_name = $fileName;
        }

        $newTicket->created_by = auth()->user()->id;
        $newTicket->status = 'NEW';
        $newTicket->isActive = 1;
        $newTicket->save();
        session()->flash('message', 'New ticket successfully added.');
        return redirect()->route('tickets.index');
    }

    
    public function show(Ticket $ticket)
    {
        $users = User::all();
        return view('tickets.show', compact('ticket', 'users'));
    }

    
    public function edit(Ticket $ticket)
    {
        // dd($ticket->id);
        // $ticket = Ticket::findOrFail($id)->get();
        return view('tickets.edit', compact('ticket'));
    }

    
    public function update(Request $request, Ticket $ticket)
    {
        $data = $request->validate([
            'title' => 'required|max:255',
            'body' => 'required|max:1000'
        ]);

        if($request->hasFile('img_name')){
            $fileName = $request->img_name->getClientOriginalName();
            if($ticket->img_name){
                Storage::delete('/public/screenshots/'.$ticket->img_name);
            }
            $request->img_name->storeAs('screenshots', $fileName, 'public');
            $ticket->img_name = $fileName;
            $ticket->update();
        }
        $ticket->update($data);
        session()->flash('message', 'Ticket details updated successfully.');
        return redirect()->route('tickets.index');
    }

    
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
