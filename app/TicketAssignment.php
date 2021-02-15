<?php

namespace App;

use App\User;
use App\Ticket;
use App\TicketHeader;
use App\TicketPriority;
use Illuminate\Database\Eloquent\Model;

class TicketAssignment extends Model
{
    protected $fillable = [
        'ticket_id',
        'ticket_header_id',
        'ticket_priority_id',
        'assigned_by',
        'assigned_to',
        'status',
        'isActive'

    ];

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }

    public function ticketHeader()
    {
        return $this->belongsTo(TicketHeader::class)
    }

    public function ticketPriority()
    {
        return $this->belongsTo(TicketPriority::class);
    }

    public function assignedBy()
    {
        return $this->belongsTo(User::class);
    }

    public function assignedTo()
    {
        return $this->belongsTo(User::class);
    }
}
