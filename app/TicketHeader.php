<?php

namespace App;

use App\TicketAssignment;
use Illuminate\Database\Eloquent\Model;

class TicketHeader extends Model
{
    protected $fillable = [
        'hTitle',
        'hDescription',
        'isActive'
    ];

    public function ticketAssignment()
    {
        return $this->hasMany(TicketAssignment::class);
    }
}
