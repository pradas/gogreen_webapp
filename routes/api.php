<?php

use Illuminate\Http\Request;

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

Route::post('/session', 'APIAuthController@signin');
// si user es manager, devolver la  id

Route::get('/rewards', 'APIRewardController@index');
Route::get('/rewards/{reward}', 'APIRewardController@show');

Route::get('/categories', 'APICategoryController@index');

Route::post('/users', 'APIAuthController@signup');
Route::get('/users/{username}', 'APIUserController@show');
// bug: no put de la fecha
Route::put('/users/{usernmae}', 'APIUserController@update');

Route::get('/users/{username}/rewards', 'APIUserController@indexRewards');
Route::post('/users/{username}/rewards', 'APIUserController@storeRewards');

// bug: infinitos favoritos
Route::get('/users/{username}/favourite-rewards', 'APIFavouriteController@indexRewards');
Route::post('/users/{username}/favourite-rewards', 'APIFavouriteController@storeRewards');
Route::delete('/users/{username}/favourite-rewards/{reward}', 'APIFavouriteController@destroyRewards');


Route::get('/users/{username}/favourite-events', 'APIFavouriteController@indexEvents');
Route::post('/users/{username}/favourite-events', 'APIFavouriteController@storeEvents');
Route::delete('/users/{username}/favourite-events/{event}', 'APIFavouriteController@destroyEvents');

Route::get('/users/{username}/favourite-deals', 'APIFavouriteController@indexDeals');
Route::post('/users/{username}/favourite-deals', 'APIFavouriteController@storeDeals');
Route::delete('/users/{username}/favourite-deals/{deal}', 'APIFavouriteController@destroyDeals');

Route::get('/events', 'APIEventController@index');
Route::get('/events/{event}', 'APIEventController@show');

Route::get('/shops/{shop}/events', 'APIEventController@indexShops');
Route::post('/shops/{shop}/events', 'APIEventController@store');
Route::get('/shops/{shop}/events/{event}', 'APIEventController@showShops');
Route::put('/shops/{shop}/events/{event}', 'APIEventController@update');
Route::delete('/shops/{shop}/events/{event}', 'APIEventController@destroy');

Route::get('/shops', 'APIShopController@index');
Route::get('/shops/{shop}', 'APIShopController@show');
Route::put('/shops/{shop}', 'APIShopController@update');
// Delete de shop no se tendria que hacer
Route::delete('/shops/{shop}', 'APIShopController@destroy');

Route::get('/shops/{shop}/employees', 'APIEmployeeController@index');
Route::post('/shops/{shop}/employees', 'APIEmployeeController@store');
Route::delete('/shops/{shop}/employees/{username}', 'APIEmployeeController@destroy');

Route::get('/deals', 'APIDealController@index');
Route::get('/deals/{deal}', 'APIDealController@show');

Route::get('/shops/{shop}/deals', 'APIDealController@indexShops');
Route::post('/shops/{shop}/deals', 'APIDealController@store');
Route::get('/shops/{shop}/deals/{deal}', 'APIDealController@showShops');
Route::put('/shops/{shop}/deals/{deal}', 'APIDealController@update');
Route::delete('/shops/{shop}/deals/{deal}', 'APIDealController@destroy');


Route::post('/validate-email', 'APIValidatorController@validateEmail');
