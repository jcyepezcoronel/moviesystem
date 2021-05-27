<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientsController;
use App\Http\Controllers\MoviesController;
use App\Http\Controllers\RentalsController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::prefix('clients')->group(function () {
    Route::get('/list', [ClientsController::class, 'list']);
    Route::post('/store', [ClientsController::class, 'store']);
    Route::get('/show', [ClientsController::class, 'show']);
    Route::post('/update', [ClientsController::class, 'update']);
    Route::post('/delete', [ClientsController::class, 'destroy']);
});

Route::prefix('movies')->group(function () {
    Route::get('/list', [MoviesController::class, 'list']);
    Route::post('/store', [MoviesController::class, 'store']);
    Route::get('/show', [MoviesController::class, 'show']);
    Route::post('/update', [MoviesController::class, 'update']);
    Route::post('/delete', [MoviesController::class, 'destroy']);
});

Route::prefix('rentals')->group(function () {
    Route::get('/list', [RentalsController::class, 'list']);
    Route::post('/store', [RentalsController::class, 'store']);
    Route::get('/show', [RentalsController::class, 'show']);
    Route::post('/update', [RentalsController::class, 'update']);
    Route::post('/delete', [RentalsController::class, 'destroy']);
});
