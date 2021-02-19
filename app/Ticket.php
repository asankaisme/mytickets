<?php

namespace App;

use App\User;
use App\TicketAssignment;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = [
        'title',
        'body',
        'img_name',
        'created_by',
        'status',
        'isActive'
    ];

    public function ticketAssignment()
    {
        return $this->hasOne(TicketAssignment::class);
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
