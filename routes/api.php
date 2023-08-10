<?php

use App\Http\Controllers\Api\SettingsController;
use App\Http\Controllers\Api\Auth\UserAuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Orion\Facades\Orion;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('auth/logout', [UserAuthController::class, 'logout']);
});

Route::prefix('auth')->group(function () {
    Route::post('login', [UserAuthController::class, 'login']);

    Route::group(['as' => 'api.'], function () {
        Orion::resource('settings', SettingsController::class);
    });
});
