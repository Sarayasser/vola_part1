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
////Account
Route::get('/home','AccountController@index')->name('index');
Route::get('/home/create','AccountController@create')->name('account.create');
Route::post('/home','AccountController@store')->name('account.store');
Route::get('/home/{id}/edit','AccountController@edit')->name('account.edit');
Route::post('/home','AccountController@update')->name('account.update');
Route::get('/home/{id}/status','AccountController@status')->name('account.status');

///Transactions
Route::get('/home/{id}','AccountController@show')->name('account.show');
Route::get('/home/{id}/create','AccountController@createTrans')->name('account.createTrans');
Route::post('/home/{id}/deposit','AccountController@deposit')->name('account.deposit');
Route::post('/home/{id}/withdraw','AccountController@withdraw')->name('account.withdraw');
Route::post('/home/{id}/transfer','AccountController@transfer')->name('account.transfer');
Route::get('/home/{id}/del','AccountController@delete')->name('account.delete');

Route::get('/home/{id}/{filter}','AccountController@filterDate')->name('account.filterDate');
Route::get('/home/{filter}/filter','AccountController@filterBank')->name('account.filterBank');


Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
