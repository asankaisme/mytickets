<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $allTickets = auth()->user()->ticket()->count();
        $allCompletedTickets = auth()->user()->ticket()->where('status', 'COMPLETED')->count();
        $allAssignedTickets = auth()->user()->ticket()->where('status', 'ASSIGNED')->count();
        $allNewTickets = auth()->user()->ticket()->where('status', 'NEW')->count();
        // dd($allCompletedTickets);
        return view('home', compact('allTickets', 'allCompletedTickets', 'allAssignedTickets', 'allNewTickets'));
    }
}
