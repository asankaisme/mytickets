<?php

namespace App;

use App\TicketAssignment;
use Illuminate\Database\Eloquent\Model;

class TicketPrority extends Model
{
    protected $fillable = [
        'priority_level',
        'priority_descripton',
        'isActive'
    ];

    public function ticketAssignment()
    {
        return $this->hasMany(TicketAssignment::class);
    }
}
