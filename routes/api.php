<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DynlistAPIController;
use App\Http\Controllers\AuthAPIController;

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

Route::post('/login', [AuthAPIController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/me', [AuthAPIController::class, 'me']);
    // IMPORT
    Route::post('/import', [DynlistAPIController::class, 'import']);
    // SEARCH
    Route::get('/search', [DynlistAPIController::class, 'search']);
});
