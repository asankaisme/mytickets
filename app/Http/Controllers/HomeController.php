<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Role::create(['name' => 'cordinator']);
        // Permission::create(['name' => 'edit tickets']);
        //  $role = Role::findById(2);
        //  $perm = Permission::findById(3);
        //  $role->givePermissionTo($perm);

        // auth()->user()->givePermissionTo('edit tickets');
        // auth()->user()->assignRole('cordinator');

        // dd(auth()->user()->getAllPermissions());
        // return User::role('cordinator')->get();
        return view('home');
    }
}
