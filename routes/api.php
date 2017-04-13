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

Route::post('/users', 'APIAuthController@signup');
Route::post('/session/new', 'APIAuthController@signin');

Route::get('/rewards', 'APIRewardController@index');
Route::get('/rewards/{reward}', 'APIRewardController@show');

Route::get('/categories', 'APICategoryController@index');