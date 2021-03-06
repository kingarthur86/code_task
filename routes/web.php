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

Route::resources([
    'users' => 'UsersController',
    'addresses' => 'AddressesController',
    'titles' => 'TitlesController',
    'genders' => 'GendersController'
]);

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/addresses/{address}/remove', 'AddressesController@remove')->name('addresses.remove');
