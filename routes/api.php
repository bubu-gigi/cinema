<?php

use App\Http\Controllers\BookingController;
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
    Route::get('/films', 'show');
    Route::get('/film/{id}', 'getFilmTitleById');
    Route::get('/film/{title}', 'getFilmIdByTitle');
    Route::post('/films', 'store');
    Route::delete('/film/{id}', 'deleteFilmById');
    Route::delete('/film/{title}', 'deleteFilmByTitle');
    Route::put('/films', 'update');
    Route::get('/films/coming-soon', 'comingSoon');
    Route::get('/films/avaiable', 'avaiable');
    Route::get('/films/expired', 'expired');
    Route::get('/film/pellicola/{id}', 'getNumeroPellicoleById');
    Route::get('/film/pellicola/{title}', 'getNumeroPellicoleByTitle');
    Route::get('/film/collection/{id}', 'getCollection');
    Route::get('/film/collection/{title}', 'getCollection');
});

Route::controller(HallController::class)->group(function () {
    Route::get('/halls', 'show');
    Route::get('/hall/{id}', 'getHallNameById');
    Route::get('/hall/{name}', 'getHallIdByName');
    Route::post('/halls', 'store');
    Route::delete('/hall/{id}', 'deleteHallById');
    Route::delete('/hall/{name}', 'deleteHallByName');
    Route::put('/halls', 'update');
    Route::get('halls/number', 'getHallsNumber');
});

Route::controller(TicketController::class)->group(function () {
    Route::get('/tickets', 'show');
    Route::get('/ticket/{id}', 'getTicketByFilmId');
    Route::get('/ticket/{title}', 'getTicketByFilmTitle');
    Route::post('/tickets', 'store');
    Route::put('/tickets', 'update');
    Route::put('/tickets/price', 'updatePrice');
    Route::delete('/ticket/{id}', 'deleteTicketByFilmId');
    Route::delete('/ticket/{title}', 'deleteTicketByFilmTitle');
});

Route::controller(BookingController::class)->group(function () {
    Route::get('/booking/films/avaiable', 'getFilmsAvaiable');
    Route::get('/booking/films/incoming', 'getFilmsIncoming');
    Route::post('/booking/{vip?}', 'bookingFilm');
});

