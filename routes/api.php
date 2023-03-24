<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StockController;
use App\Http\Controllers\SupplyController;
use App\Http\Controllers\PriceCountController;

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

Route::resource('stock', StockController::class)->only('index', 'show', 'store');
Route::resource('supply', SupplyController::class)->only('index', 'show', 'store');
Route::post('price', [ PriceCountController::class, 'index' ])->name('price');
