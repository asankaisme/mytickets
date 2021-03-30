<?php

use App\Ticket;
use App\Mail\SendLevelTwoEmail;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
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
    'Todos' => 'TodoController',
    'ticketComments' => 'TicketCommentController'
]);

Route::post('/assignRole', 'UserController@assignRole')->name('assignRole');

Route::get('/detachTicket/{id}', 'TicketAssignmentController@detachTicket')->name('detachTicket')->middleware('auth');

Route::get('/users/profile/{id}', 'UserController@showProfile')->middleware('auth')->name('showProfile');
Route::post('/uploadUsrImage', 'UserController@uploadUserImage')->middleware('auth')->name('uploadUsrImage');

Route::get('/acceptTicket/{id}', 'TodoController@acceptTicket')->middleware('auth')->name('acceptTicket');
Route::get('/raiseToL2/{id}', 'TodoController@raiseToL2')->middleware('auth')->name('raiseToL2');

Route::get('/knowledgeBase', function(){
    $datasets = Ticket::where('status', 'COMPLETED')->get();
    // dd($datasets);
    return view('knowledgebase.index', compact('datasets'));
})->name('knowledgebase');

//this route will logs all activities
Route::get('/activityLog', function(){
    $activities = Activity::all();
    return view('activitylogs.index', compact('activities'));
})->middleware('auth')->name('activityLog');

Route::get('/sendEmail', function(){
    Mail::to('email@email.com')->send(new SendLevelTwoEmail);
    // return new SendLevelTwoEmail();
});

Route::get('/faqs', function(){
    return view('faq.index');
})->name('faqs');

Route::get('/laodView', 'PrintController@getStatusRep')->name('laodView');
Route::get('/printStatus', 'PrintController@printStatusRpt')->name('printStatus');
Route::get('/printSummary', 'PrintController@printSumRpt')->name('printSummary');

Route::post('/addFeedback', 'FeedbackController@addFeedback')->name('addFeedback');