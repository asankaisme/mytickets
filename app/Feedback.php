<?php

namespace App;

use App\Ticket;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $fillable = [
        'ticket_id',
        'level',
        'feedback',
        'given_by',
        'given_to'
    ];

    protected static $logAttributes = ['ticket_id', 'level', 'feedback', 'given_by', 'given_to'];
    protected static $recordEvents = ['created'];
    protected static $logName = 'Feedback';
    protected static $logOnlyDirty = true;

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }

    public function givenBy()
    {
        return $this->belongsTo(User::class, 'given_by');
    }

    public function givenTo()
    {
        return $this->belongsTo(User::class, 'given_to');
    }
}
