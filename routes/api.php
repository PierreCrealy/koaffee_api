<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


Route::prefix('v1')->group(function(){

    Route::resource('exchange', \App\Http\Controllers\ExchangeController::class);
    Route::get('exchange/{id}/getHistories', [\App\Http\Controllers\ExchangeController::class, 'historiesByExchange']);
    Route::get('exchange/{access}/claim',  [\App\Http\Controllers\ExchangeController::class, 'claimExchange']);

    Route::resource('history', \App\Http\Controllers\HistoryController::class);
    Route::get('history/{id}/getExchange', [\App\Http\Controllers\HistoryController::class, 'exchangeByHistory']);

});


