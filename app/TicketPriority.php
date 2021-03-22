<?php

namespace App;

use App\TicketAssignment;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class TicketPriority extends Model
{
    use LogsActivity;
    
    protected $fillable = [
        'priority_level',
        'priority_description',
        'isActive'
    ];

    protected static $logAttributes = ['priority_level', 'priority_description'];
    protected static $logName = 'Ticket Priority';
    protected static $recordEvents = ['created', 'updated','deleted'];
    protected static $logOnlyDirty = true;

    public function ticketAssignment()
    {
        return $this->hasMany(TicketAssignment::class, 'ticket_priority_id');
    }
}
