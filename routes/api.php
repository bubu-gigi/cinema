<?php

use Illuminate\Http\Request;
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
    Route::get('/film/{id}', 'get')->where('id', '[0-9]+');
    Route::get('/film/{title}', 'getIdByTitle');
    Route::post('/films', 'store');
    Route::delete('/film/{id}', 'delete');
    Route::put('/films', 'update');
    Route::get('/films/coming-soon', 'comingSoon');
    Route::get('/films/avaiable', 'avaiable');
    Route::get('/films/expired', 'expired');
    Route::get('/film/pellicola/{id}', 'getPellicola');
    Route::get('/film/{id}/collection', 'collection');

});

Route::controller(HallController::class)->group(function () {
    Route::get('/halls', 'show');
    Route::get('/hall/{id}', 'get');
    Route::post('/halls', 'store');
    Route::delete('/hall/{id}', 'delete');
    Route::put('/halls', 'update');
    Route::get('halls/number', 'getHallsNumber');
});

Route::controller(TicketController::class)->group(function () {
    Route::get('/tickets', 'show');
    Route::get('/ticket/{title}', 'get');
    Route::post('/tickets', 'get');
    Route::put('/tickets', 'update');
    Route::delete('/ticket/{id}', 'delete');
});


