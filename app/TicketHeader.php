<?php

namespace App;

use App\TicketAssignment;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class TicketHeader extends Model
{
    use LogsActivity;
    
    protected $fillable = [
        'hTitle',
        'hDescription',
        'isActive'
    ];

    protected static $logAttributes = ['hTitle', 'hDescription'];
    protected static $logName = 'Ticket Header';
    protected static $recordEvents = ['created', 'updated','deleted'];
    protected static $logOnlyDirty = true;

    public function ticketAssignment()
    {
        return $this->hasMany(TicketAssignment::class);
    }
}
