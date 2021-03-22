<?php

namespace App;

use App\User;
use App\Ticket;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class TicketComment extends Model
{
    use LogsActivity;

    protected $fillable = [
        'ticket_id',
        'diagnosis',
        'solution',
        'user_id',
        'isActive'
    ];

    protected static $logAttributes = ['ticket_id', 'diagnosis', 'solution', 'user_id', 'isActive'];
    protected static $recordEvents = ['created', 'updated','deleted'];
    protected static $logName = 'Comment';
    protected static $logOnlyDirty = true;

    public function ticket()
    {
        return $this->belongsTo(Ticket::class, 'ticket_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
