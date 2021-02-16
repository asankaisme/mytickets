<?php

namespace App\Http\Livewire;

use App\Ticket;
use Livewire\Component;

class Tickets extends Component
{
    // public $tickets = Ticket::where('status', 1)->with('user')->get();

    public $tickets;

    public function mount()
    {
        $allTickets = Ticket::all();
        $this->tickets = $allTickets;
    }

    public function render()
    {
        return view('livewire.tickets');
    }
}
