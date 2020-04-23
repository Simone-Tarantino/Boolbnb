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

// Rotta homepage

Route::get('/', function () {
    return view('welcome');
 });

// Rotta pagina search

Route::post('/search', 'HouseController@distance')->name('house.search');

// Rotta show guest

Route::get('show/{house}', 'HouseController@show')->name('house.show');

// Rotta messaggio appartamento

Route::get('contact-us/{house}', 'ContactUSController@contactUS')->name('contactus');
Route::post('contact-us', ['as' => 'contactus.store', 'uses' => 'ContactUSController@contactUSPost']);

// Rotte auth

Auth::routes();

// Rotte crud admin

Route::name('admin.')
    ->prefix('admin')
    ->namespace('Admin')
    ->middleware('auth')
    ->group(function () {
        Route::resource('houses', 'HouseController');
        Route::get('home', 'HomeController@index');
        Route::get('messages', 'MessageController@index')->name('messages');
        // Route::get('messages/{result}', 'MessageController@show')->name('messages.show');
    });

