<?php

use Illuminate\Support\Facades\Route;

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
})->name('welcome');


Route::middleware(['auth'])->group(function () {
    Route::resource('tickets', 'TicketsController')->only(['store', 'destroy']);
    Route::post('/ticketValidation', 'TicketsController@ticketValidation');
    Route::post('/a/tickets', 'TicketsController@asyncCreate');
    Route::patch('/a/e/tickets', 'TicketsController@asyncEdit');
    Route::get('/a/a/redeemTicket/{id}', 'TicketsController@asyncRedeem');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
