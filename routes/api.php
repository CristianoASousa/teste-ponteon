<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BusinessmenController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('/businessmen')->group(function () {
    Route::get('/', [BusinessmenController::class, 'index']);
    Route::post('/', [BusinessmenController::class, 'store']);
    Route::get('/{id}', [BusinessmenController::class, 'show']);
    Route::delete('/{id}', [BusinessmenController::class, 'destroy']);
});

