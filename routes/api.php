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

Route::get('/rewards', 'APIRewardController@index');
Route::get('/rewards/{reward}', 'APIRewardController@show');

Route::get('/categories', 'APICategoryController@index');

Route::post('/users', 'APIAuthController@signup');


Route::get('/users/{username}/rewards', 'APIUserController@indexRewards');
Route::post('/users/{username}/rewards', 'APIUserController@storeRewards');
Route::delete('/users/{username}/rewards', 'APIUserController@destroyRewards');

Route::post('/users/{username}/favorite-rewards', 'APIUserController@storeFavoriteRewards');
Route::delete('/users/{username}/favorite-rewards', 'APIUserController@destroyFavoriteRewards');

