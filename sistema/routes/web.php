<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientsController;
use App\Http\Controllers\MoviesController;
use App\Http\Controllers\RentalsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;

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

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home', [HomeController::class, 'index'])->name('home');

// Clientes
Route::get('/clientes', [ClientsController::class, 'listar'])->name('listar');
Route::get('/cliente/editar/{id}', [ClientsController::class, 'edit'])->name('edit');
Route::get('/clientes/registrar', [ClientsController::class, 'register'])->name('register');

// Peliculas
Route::get('/peliculas', [MoviesController::class, 'listar'])->name('listar');
Route::get('/pelicula/editar/{id}', [MoviesController::class, 'edit'])->name('edit');
Route::get('/peliculas/registrar', [MoviesController::class, 'register'])->name('register');
Route::get('/movies/categories', [MoviesController::class, 'listCategories'])->name('listCategories');

// Alquiler
Route::get('/alquiler', [RentalsController::class, 'listar'])->name('listar');
Route::get('/alquiler/editar/{id}', [RentalsController::class, 'edit'])->name('edit');
Route::get('/alquiler/registrar', [RentalsController::class, 'register'])->name('register');

Route::resources([
    'usuarios' =>  UserController::class,
]);

Route::apiResource('/clients', ClientsController::class);
Route::apiResource('/movies', MoviesController::class);
Route::apiResource('/rentals', RentalsController::class);