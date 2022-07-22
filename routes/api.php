<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\UserController;

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
    // return $request->user();
});

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::controller(RoomController::class)->group(function () {
        Route::post('/room', 'store');
        Route::get('/room', 'index');
        Route::put('/room/update/{id}', 'update');
        Route::get('/room/{id}', 'show');
        Route::delete('/room/{id}', 'destroy');
        Route::put('/room/{id}', 'restore');
    });
});

// Route::controller(RoomController::class)->group(function () {
//     Route::post('/room', 'store');
//     Route::get('/room', 'index');
//     Route::put('/room/update/{id}', 'update');
//     Route::get('/room/{id}', 'show');
//     Route::delete('/room/{id}', 'destroy');
//     Route::put('/room/{id}', 'restore');
// });

Route::controller(UserController::class)->group(function () {
    Route::post('/user', 'login');
});

