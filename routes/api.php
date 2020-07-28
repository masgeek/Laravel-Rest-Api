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
Route::post('login', 'Api\AuthController@login');
Route::post('register', 'Api\AuthController@register');
Route::get('logout', 'Api\AuthController@logout');
//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
//products
Route::post('products/create', 'Api\ProductsController@create')->middleware('jwtAuth');
Route::post('products/delete', 'Api\ProductsController@delete')->middleware('jwtAuth');
Route::post('products/update', 'Api\ProductsController@update')->middleware('jwtAuth');
Route::get('products', 'Api\ProductsController@products')->middleware('jwtAuth');
Route::get('products/{id}', 'Api\ProductsController@productsSpec')->middleware('jwtAuth');

//Reviews
Route::post('reviews/create', 'Api\ReviewsController@create')->middleware('jwtAuth');
Route::post('reviews/delete', 'Api\ReviewsController@delete')->middleware('jwtAuth');
Route::post('reviews/update', 'Api\ReviewsController@update')->middleware('jwtAuth');
Route::post('/products/reviews', 'Api\ReviewsController@reviews')->middleware('jwtAuth');
//Route::get('products/{id}/reviews', 'Api\ProductsController@productsSpec')->middleware('jwtAuth');
Route::post('cart/create', 'Api\CartController@create')->middleware('jwtAuth');
Route::post('cart/delete', 'Api\CartController@delete')->middleware('jwtAuth');
Route::post('cart/clearcart', 'Api\CartController@clearCart')->middleware('jwtAuth');
Route::post('cart/update', 'Api\CartController@update')->middleware('jwtAuth');
Route::get('cart', 'Api\CartController@carts')->middleware('jwtAuth');

//orders
Route::post('orders/create', 'Api\OrdersController@create')->middleware('jwtAuth');
Route::post('orders/delete', 'Api\OrdersController@delete')->middleware('jwtAuth');

Route::get('orders', 'Api\OrdersController@orders')->middleware('jwtAuth');


