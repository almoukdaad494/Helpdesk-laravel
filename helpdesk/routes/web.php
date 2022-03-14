<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApplicantController;
use App\Http\Controllers\TicketController;


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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';


Route::get('/applicant/index', [ApplicantController::class, 'index'])
->name('applicant.index')
->middleware('can:list, App\Models\Applicant');

            
Route::put('/applicant/{applicant}/employ', [ApplicantController::class, 'employ'])
->middleware('auth')
->middleware('can:employ,applicant')
->name('applicant.employ');


Route::delete('/applicant/{applicant}/reject', [ApplicantController::class, 'reject'])
->middleware('auth')
->middleware('can:reject,applicant')
->name('applicant.reject');


Route::put('/applicant/{applicant}/queue', [ApplicantController::class, 'queue'])
->middleware('auth')
->middleware('can:queue,applicant')
->name('applicant.queue');


Route::get('/ticket/create', [TicketController::class, 'create'])
->middleware('auth')
->middleware('can:create, App\Models\Ticket')
->name('ticket.create');


Route::post('/ticket', [TicketController::class, 'store'])
->middleware('auth')
->middleware('can:create, App\Models\Ticket')
->name('ticket.store');


Route::get('/ticket/index/{status}', [TicketController::class, 'index'] )
->where('status', 'open|closed|processed|waiting')
->middleware('auth')
->middleware('can:list, App\Models\Ticket')
->name('ticket.index');


Route::get('/ticket/{ticket}', [TicketController::class, 'show'])
->middleware('auth')
->middleware('can:read,ticket')
->name('ticket.show');


Route::get('/ticket/{any_ticket}', [TicketController::class, 'show'])
->middleware('auth')
->middleware('can:read,ticket')
->name('ticket.show');





