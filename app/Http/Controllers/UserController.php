<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Storage;

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

        if(count($user->roles) > 0){
            $userExistingRole = Role::findOrFail($user->roles->first()->id);
            $user->removeRole($userExistingRole); 
            $user->assignRole($role);
        }else{
            $user->assignRole($role);
        }
        // dd($role);
        
        session()->flash('message', 'Nice! '.$user->name.' has a new role of '.$role->name.' now.');
        return redirect()->route('users.index');
    }

    public function showProfile($id)
    {
        $user = User::findOrFail($id);
        return view('users.profile', compact('user'));
    }

    public function uploadUserImage(Request $request)
    {
        if($request->hasFile('usr_image')){
            $fileName = $request->usr_image->getClientOriginalName();
            if(auth()->user()->usr_image){
                Storage::delete('/public/usr_images/'.auth()->user()->usr_image);
            }
            $user = User::findOrFail(auth()->user()->id);
            $user->usr_image = $fileName;
            $user->update();
            $request->usr_image->storeAs('usr_images', $fileName, 'public');
            return redirect()->back();
        }
        
    }
}
