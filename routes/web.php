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
    return view('home');
});

Route::get('home', 'HouseController@index')->name('house.home');
// Route::get('search', 'HouseController@se')->name('house.search');
Route::get('show/{house}', 'HouseController@show')->name('house.show');


Auth::routes();
// Route::get('/home', 'HomeController@index')->name('home');

Route::name('admin.')
    ->prefix('admin')
    ->namespace('Admin')
    ->middleware('auth')
    ->group(function () {
        Route::resource('houses', 'HouseController');
        Route::get('home', 'HomeController@index');
    });

