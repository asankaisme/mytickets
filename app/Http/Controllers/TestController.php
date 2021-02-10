<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function _construct()
    {
        $this->middlware('auth');
    }

    public function index()
    {
        Role::create(['name' => 'client']);
        return view('home');
    }
}
