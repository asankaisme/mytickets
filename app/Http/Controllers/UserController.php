<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;

class UserController extends Controller
{
    public function _construct()
    {
        return $this->middleware('auth');
    }

    public function index()
    {
        $users = User::with('roles')->get();
        $roletypes = Role::all();
        $sysPermissions = Permission::all();
        return view('users.index', compact('users', 'roletypes', 'sysPermissions'));
    }

    
    public function create()
    {
        //
    }

    
    public function store(Request $request)
    {
        $validatedUserData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        // User::create($validatedUserData);

        $newUser = new User();
        $newUser->name = $request->name;
        $newUser->email = $request->email;
        $newUser->password = Hash::make($request->password);

        $newUser->save();
        session()->flash('message', 'User created successfully');
        return redirect()->route('users.index');
    }

    
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    
    public function edit($id)
    {
        //
    }

    
    public function update(Request $request, $id)
    {
        //
    }

    
    public function destroy(User $user)
    {
        $user->isActive = 0;
        $user->update();
        session()->flash('message', 'User deleted successfully.');
        return redirect()->route('users.index');
    }

    public function assignRole(Request $request)
    {
        //$user->assignRole($role1);
        $user = User::findOrFail($request->userId);
        $role = Role::findOrFail($request->roleId);
        // dd($role);
        $user->assignRole($role);
    }
}
