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

    // Basic routes
    Route::post('login',[\App\Http\Controllers\AuthController::class,'login']);
    Route::post('register',[\App\Http\Controllers\AuthController::class,'register']);


    Route::middleware('auth:sanctum')->group(function(){

        // Order routes
        Route::get('order/{status}/orders-status',  [\App\Http\Controllers\OrderController::class, 'getByStatus']);
        Route::get('order/group-by-status',  [\App\Http\Controllers\OrderController::class, 'getGroupedByStatus']);

        Route::get('order/{userId}/{status}/latest',  [\App\Http\Controllers\OrderController::class, 'getUserOrderByStatus']);
        Route::get('order/{userId}/group-by-status',  [\App\Http\Controllers\OrderController::class, 'getUserOrdersGroupedByStatus']);

        Route::resource('order', \App\Http\Controllers\OrderController::class);

        // Product routes
        Route::get('product/{category}/products-category',  [\App\Http\Controllers\ProductController::class, 'getByCategory']);
        Route::get('product/group-by-category',  [\App\Http\Controllers\ProductController::class, 'getGroupedByCategory']);

        Route::resource('product', \App\Http\Controllers\ProductController::class);

        Route::resource('service', \App\Http\Controllers\ServiceController::class);

        Route::get('liked-product/{userId}/liked',  [\App\Http\Controllers\LikedProductController::class, 'indexByUser']);
        Route::resource('liked-product', \App\Http\Controllers\LikedProductController::class);

    });


    // ---


    Route::resource('exchange', \App\Http\Controllers\ExchangeController::class);
    Route::get('exchange/{id}/get-histories', [\App\Http\Controllers\ExchangeController::class, 'historiesByExchange']);
    Route::get('exchange/{access}/claim',  [\App\Http\Controllers\ExchangeController::class, 'claimExchange']);

    Route::resource('history', \App\Http\Controllers\HistoryController::class);
    Route::get('history/{id}/get-exchange', [\App\Http\Controllers\HistoryController::class, 'exchangeByHistory']);

});


