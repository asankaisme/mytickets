<?php

namespace App;

use App\User;
use App\Ticket;
use App\TicketHeader;
use App\TicketPriority;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class TicketAssignment extends Model
{
    use LogsActivity;
    
    protected $fillable = [
        'ticket_id',
        'ticket_header_id',
        'ticket_priority_id',
        'assigned_by',
        'assigned_to',
        'status',
        'isActive'
    ];

    protected static $logAttributes = ['ticket_header_id', 'ticket_priority_id', 'assigned_to'];
    protected static $logName = 'Ticket Assignment';
    protected static $recordEvents = ['created', 'updated','deleted'];
    protected static $logOnlyDirty = true;

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }

    public function ticketHeader()
    {
        return $this->belongsTo(TicketHeader::class);
    }

    public function ticketPriority()
    {
        return $this->belongsTo(TicketPriority::class, 'ticket_priority_id');
    }

    public function assignedBy()
    {
        return $this->belongsTo(User::class, 'assigned_by');
    }

    public function assignedTo()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }
}
