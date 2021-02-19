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
        $allTickets = Ticket::where('status', 1)->with('user')->get();
        // dd($allTickets);
        $this->tickets = $allTickets;
    }

    public function render()
    {
        return view('livewire.tickets');
    }
}
