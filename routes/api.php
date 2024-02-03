<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\ProductionController;
use App\Http\Controllers\API\ProcessController;
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
Route::prefix('product')->group(function(){
    Route::get('/',[ProductController::class, 'index']);
    Route::post('/all',[ProductController::class, 'getProducts']);
    Route::get('/where/{id}',[ProductController::class, 'getProductIssue']);
    Route::post('/process',[ProductController::class, 'getProcess']);
    Route::post('/issue',[ProductController::class, 'getIssue']);
    Route::post('/row',[ProductController::class, 'getRow']);
    Route::post('/store',[ProductController::class, 'store']);
    Route::put('/{id}',[ProductController::class, 'update']);
    Route::delete('/{id}',[ProductController::class, 'destroy']);
});
Route::prefix('pos')->group(function(){
    Route::get('/where/{id}',[ProductionController::class, 'Pos']);
    Route::get('/category/{id}',[ProductionController::class, 'Category']);
    Route::get('/brand/{id}',[ProductionController::class, 'Brand']);
    Route::get('/subcategory/{id}',[ProductionController::class, 'Subcategory']);
    Route::get('/product',[ProductionController::class, 'product']);
    Route::get('/payment_method',[ProductionController::class, 'payment_method']);
});
Route::prefix('issue')->group(function(){
    Route::get('/where/{id}',[ProductionController::class, 'Issue_item']);
});
Route::prefix('process')->group(function(){
    Route::get('/where/{id}',[ProductionController::class, 'Process_Item']);
});
Route::prefix('sales')->group(function(){
    Route::get('/where/{id}',[ProductionController::class, 'Pos_Item']);
});
Route::prefix('purchases')->group(function(){
    Route::get('/where/{id}',[ProductionController::class, 'Purchases_Item']);
});

Route::get('customer',[ProductionController::class, 'customer']);
Route::get('customer/{id}',[ProductionController::class, 'customerbyid']);
