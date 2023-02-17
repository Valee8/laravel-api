<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MainController;

use App\Http\Controllers\ApiController;

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

Route::get('/', [MainController::class, 'home']) -> name('home');

Route::get('/movie/home', [MainController::class, 'movies']) -> name('movie.home');

Route::get('/movie/delete/{movie}', [MainController::class, 'movieDelete']) -> name('movie.delete');

Route::get('/movie/create/', [MainController::class, 'movieCreate']) -> name('movie.create');

Route::post('/movie/store/', [MainController::class, 'movieStore']) -> name('movie.store');

Route::get('/movie/edit/{movie}', [MainController::class, 'movieEdit']) -> name('movie.edit');

Route::post('/movie/update/{movie}', [MainController::class, 'movieUpdate']) -> name('movie.update');

Route::get('/movie/v1/all', [ApiController::class, 'movieAll']);
