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

Route::get('/', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/deposit','BankController@deposit')->name('deposit');

Route::get('/withdraw','BankController@withdraw')->name('withdraw');

Route::post('/deposit','BankController@save');

Route::post('/withdraw','BankController@take');

Route::get('/list', 'BankController@list')->name('list');

Route::get('/display','BankController@display');

