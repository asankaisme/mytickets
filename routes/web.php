<?php

use App\Ticket;
use Illuminate\Support\Facades\Route;
use Illuminate\Auth\Middleware\Authenticate;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.loginNew');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resources([
    'tickets' => 'TicketController',
    'users' => 'UserController',
    'roles' => 'RolesController',
]);

Route::post('/assignRole', 'UserController@assignRole')->name('assignRole');

Route::get('/knowledgeBase', function(){
    $dataset = Ticket::where('status', 'COMPLETED')->with('user');
    return view('knowledgebase.index', compact('dataset'));
})->name('knowledgebase');