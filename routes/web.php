<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::controller(AuthController::class)->group(function () {
    Route::get('login', 'login')->name('login');
    Route::get('register', 'register')->name('register');
    Route::post('authenticate', 'authenticate')->name('authenticate');
    Route::post('register', 'register')->name('register');
    Route::post('logout', 'logout')->name('logout');
});

Route::name('front.')->controller(FrontController::class)->group(function () {
    Route::get('/', 'home')->name('home');
    Route::get('event/join-details/{id}', 'joinDetails')->name('joinDetails')->middleware('auth');
    Route::post('event/join/{id}', 'join')->name('join')->middleware('auth');
    Route::get('event/{slug}', 'eventDetails')->name('eventDetails');
});

Route::prefix('users')->name('users.')->controller(UserController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('{user}', 'show')->name('show');
});
Route::prefix('events')->name('events.')->controller(EventController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('{event}', 'show')->name('show');
    Route::post('save', 'save')->name('save');
    Route::post('saveTicket', 'save_ticket')->name('saveTicket');
    Route::delete('delete/{id}', 'delete')->name('delete');
    Route::delete('deleteTicket/{id}', 'delete_ticket')->name('deleteTicket');
});
