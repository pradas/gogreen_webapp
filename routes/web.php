<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    //return view('welcome');
    return redirect('/rewards');
});

Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('/new-manager', 'HomeController@newManager');

Route::get('/rewards', 'RewardController@index');
Route::get('/rewards/create', 'RewardController@create');
Route::post('/rewards', 'RewardController@store');
Route::get('/rewards/{reward}', 'RewardController@show');
Route::get('/rewards/{reward}/edit', 'RewardController@edit');
Route::put('/rewards/{reward}', 'RewardController@update');
Route::delete('/rewards/{reward}', 'RewardController@destroy');

Route::get('/use-reward/{reward}', 'UseRewardController@useReward');