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
    return redirect()->route('login');
});

Auth::routes();

Route::middleware('auth')->namespace('App\Http\Controllers')->group(function () {
    
    Route::get('/home', 'HomeController@index')->name('home');
    Route::post('/home' ,'HomeController@store')->name('home.store');
    Route::get('/home/delete/{id}', 'HomeController@delete')->name('home.delete');

    Route::get('/bus-time' ,'bus\BusController@index')->name('bus');
    Route::post('/bus-time' , 'bus\BusController@store')->name('bus.store');
    Route::get('/bus-time/delete/{id}' , 'bus\BusController@delete')->name('bus.delete');

    Route::get('/move-time' , 'movie\MovieController@index')->name('movie');
});

