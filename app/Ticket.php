<?php

namespace App;

use App\User;
use App\Feedback;
use App\TicketComment;
use App\TicketAssignment;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Ticket extends Model
{
    use LogsActivity;
    
    protected $fillable = [
        'title',
        'body',
        'img_name',
        'created_by',
        'status',
        'isActive'
    ];

    protected static $logAttributes = ['title', 'body', 'img_name'];
    protected static $recordEvents = ['created', 'updated','deleted'];
    protected static $logName = 'Ticket';
    protected static $logOnlyDirty = true;

    public function ticketAssignment()
    {
        return $this->hasOne(TicketAssignment::class);
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function comments()
    {
        return $this->hasOne(TicketComment::class, 'ticket_id');
    }

    public function feedback()
    {
        return $this->hasOne(Feedback::class, 'ticket_id');
    }
}
