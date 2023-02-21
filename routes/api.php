<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ApiController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/v1/movie/all', [ApiController::class, 'movieAll']);

Route::post('/v1/movie/store', [ApiController::class, 'movieStore']);

Route::delete('/v1/movie/delete/{movie}', [ApiController::class, 'movieDelete']);

Route::post('/v1/movie/update/{movie}', [ApiController::class, 'movieUpdate']);
