<?php

namespace App;

use App\TicketAssignment;
use Illuminate\Database\Eloquent\Model;

class TicketPriority extends Model
{
    protected $fillable = [
        'priority_level',
        'priority_description',
        'isActive'
    ];

    public function ticketAssignment()
    {
        return $this->hasMany(TicketAssignment::class);
    }
}
