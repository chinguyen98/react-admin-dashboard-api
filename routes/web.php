<?php

use App\Http\Controllers\ResourceController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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

Route::group(['prefix' => 'auth'], function () {
    Route::post('/sign-up', [AuthController::class, 'signup']);
    Route::post('/sign-in', [AuthController::class, 'signin']);
});

Route::group(['middleware' => ['auth.jwt']], function () {
    Route::get('/users', [ResourceController::class, 'getAllUser']);
});
