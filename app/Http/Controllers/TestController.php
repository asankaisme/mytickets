<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Spatie\Permission\Models\Role;

class TestController extends Controller
{
    public function _construct()
    {
        $this->middlware('auth');
    }

    public function index()
    {
        return 'test ok';
    }

    public function getbackup()
    {
        Artisan::call('backup:run');
        return 'done';
    }
}
