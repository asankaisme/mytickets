<?php

namespace App;

use App\Ticket;
use App\TicketAssignment;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
        'email', 
        'password', 
        'usr_image'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function ticket()
    {
        return $this->hasMany(Ticket::class, 'created_by');
    }

    public function ticketsAssignedByMe()
    {
        return $this->hasMany(TicketAssignment::class, 'assigned_by');
    }

    public function TicketsAssignedTo()
    {
        return $this->hasMany(TicketAssignment::class, 'assigned_to');
    }
}
