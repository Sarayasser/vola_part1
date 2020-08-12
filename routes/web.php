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
Route::get('/home','AccountController@index')->name('index');
Route::get('/home/create','AccountController@create')->name('account.create');
Route::post('/home','AccountController@store')->name('account.store');
Route::get('/home/id/edit','AccountController@edit')->name('account.edit');
Route::post('/home','AccountController@update')->name('account.update');
Route::get('/home/id/status','AccountController@status')->name('account.status');


Route::get('/home/{filter}/filter','AccountController@filterBank')->name('account.filterBank');
Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
