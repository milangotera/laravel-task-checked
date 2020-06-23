<?php

use Illuminate\Support\Facades\Route;

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
Route::get('/task/new', 'TaskController@create')->name('task.create');
Route::post('/task/new', 'TaskController@store')->name('task.store');
Route::get('/task/{id}/show', 'TaskController@show')->name('task.show');
Route::get('/task/{id}/delete', 'TaskController@delete')->name('task.delete');
Route::put('/task/{id}/update', 'TaskController@update')->name('task.update');
