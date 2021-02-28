<?php

use App\Ticket;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Auth\Middleware\Authenticate;


Route::get('/', function () {
    return view('auth.loginNew');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resources([
    'tickets' => 'TicketController',
    'users' => 'UserController',
    'roles' => 'RolesController',
    'headers' => 'TicketHeaderController',
]);

Route::post('/assignRole', 'UserController@assignRole')->name('assignRole');

Route::get('/knowledgeBase', function(){
    $dataset = Ticket::where('status', 'COMPLETED')->with('user');
    return view('knowledgebase.index', compact('dataset'));
})->name('knowledgebase');