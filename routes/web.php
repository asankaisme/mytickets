<?php

use App\Ticket;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Spatie\Activitylog\Models\Activity;
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
    'ticketAssignments' => 'ticketAssignmentController',
    'priorities' => 'PriorityController',
]);

Route::post('/assignRole', 'UserController@assignRole')->name('assignRole');

Route::get('/detachTicket/{id}', 'TicketAssignmentController@detachTicket')->name('detachTicket')->middleware('auth');

Route::get('/users/profile/{id}', 'UserController@showProfile')->middleware('auth')->name('showProfile');
Route::post('/uploadUsrImage', 'UserController@uploadUserImage')->middleware('auth')->name('uploadUsrImage');

Route::get('/knowledgeBase', function(){
    $dataset = Ticket::where('status', 'COMPLETED')->with('user');
    return view('knowledgebase.index', compact('dataset'));
})->name('knowledgebase');

//this route will logs all activities
Route::get('/activityLog', function(){
    $activities = Activity::all();
    return view('activitylogs.index', compact('activities'));
})->middleware('auth')->name('activityLog');