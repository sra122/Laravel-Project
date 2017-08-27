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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/login', 'Auth\LoginController@index')->name('login');

Route::get('/task', 'TaskController@index')->name('task');
Route::post('/task', 'TaskController@store');
Route::post('/task/{task}', 'TaskController@destroy')->name('destroy');
Route::put('/task/{task}', 'TaskController@update')->name('update');
Route::get('/task/{task}/edit', 'TaskController@edit')->name('edit');

