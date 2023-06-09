<?php

use App\Http\Controllers\ApiDetailsController;
use App\Http\Controllers\ProductsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::resource('products', ProductsController::class)->only([
    'destroy', 'show', 'store', 'update', 'index'
])->middleware('api_foodfact');

Route::middleware('api_foodfact')->group(function () {
    Route::get('/', [ApiDetailsController::class, 'index'])->name('detalhesApi');
    Route::get('/importar', [ProductsController::class, 'importarProdutos'])->name('importar');    
    Route::get('/search', [ProductsController::class, 'search'])->name('search');
});

