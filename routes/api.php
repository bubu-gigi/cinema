<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FilmController;
use App\Http\Controllers\HallController;
use App\Http\Controllers\TicketController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::controller(FilmController::class)->group(function () {
    Route::get('/films', 'show'); #!
    Route::get('/film/{id}', 'getFilm'); #!
    Route::post('/films', 'store'); #!
    Route::delete('/film/{id}', 'deleteFilm');
    Route::put('/films', 'update'); #!
    Route::get('/films/coming-soon', 'comingSoon'); #!
    Route::get('/films/avaiable', 'avaiable'); #!
    Route::get('/films/expired', 'expired'); #!
    Route::get('/film/pellicole/{id}', 'getNumeroPellicole'); #!
    Route::get('/film/collection/{id}', 'getCollection'); #!
});

Route::controller(HallController::class)->group(function () {
    Route::get('/halls', 'show'); #!
    Route::get('/hall/{id}', 'getHall'); #!
    Route::post('/halls', 'store'); #!
    Route::delete('/hall/{id}', 'deleteHall');
    Route::put('/halls', 'update'); #!
    Route::get('/halls/number', 'getHallsNumber'); #!
});

Route::controller(TicketController::class)->group(function () {
    Route::get('/tickets', 'show'); #!
    Route::get('/ticket/{id}', 'getTicket'); #!
    Route::post('/tickets', 'store');
    Route::put('/tickets', 'update');
    Route::delete('/ticket/{id}', 'deleteTicket');
});

Route::controller(BookingController::class)->group(function () {
    Route::post('/booking/{vip?}', 'bookingFilm');
});

Route::controller(ReportController::class)->group(function () {
    Route::get('/report/daily/{id}', 'dailyReport');
    Route::get('/report/weekly/{id}', 'weeklyReport');
    Route::get('/report/monthly/{id}', 'monthlyReport');
});

