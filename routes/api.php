<?php

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('status', function () { return response()->json(['status' => 'ok']); });

Route::prefix('v1')->name('api.v1.')->namespace('Api\V1')->group(function () {
    Route::get('/list-all-products', 'ProductsController@index')->name('list.all.products');
    Route::get('/show-product/{id}', 'ProductsController@show')->name('show.product');
    Route::post('/create-product', 'ProductsController@store')->name('create.product');
    Route::put('/update-product/{id}', 'ProductsController@update')->name('update.product');
    Route::delete('/delete-product/{id}', 'ProductsController@destroy')->name('destroy.product');

    Route::get('/list-all-orders', 'OrdersController@index')->name('list.all.orders');
    Route::get('/show-order/{id}', 'OrdersController@show')->name('show.order');
    Route::post('/create-order', 'OrdersController@store')->name('create.order');
    Route::put('/update-order/{id}', 'OrdersController@update')->name('update.order');
    Route::delete('/delete-order/{id}', 'OrdersController@destroy')->name('destroy.order');

    Route::get('/all-logistics', 'LogisticsController@listAllOrders')->name('list.all.logistics');
    Route::put('/transfer-for-delivery', 'LogisticsController@transferToShipping')->name('update.order');
});
