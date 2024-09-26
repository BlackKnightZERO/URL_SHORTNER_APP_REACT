<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('token', [AuthController::class, 'getApiToken']);
    Route::post('refresh-token', [AuthController::class, 'refreshToken']);

    Route::prefix('urls')->group(function () {
        Route::get('get', [DashboardController::class, 'index']);
        Route::post('create', [DashboardController::class, 'create']);
        Route::get('{url}', [DashboardController::class, 'redirect']);
    });
});
