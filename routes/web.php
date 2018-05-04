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



Route::resource('/dashboard', 'Admin\DashboardController');
Route::resource('/charts', 'Admin\ChartsController');
Route::resource('/components/cards', 'User\CardsController');
Route::resource('/tables', 'Manager\TablesController');


Route::resource('/map', 'MapController');


//- Dashboard
//- Charts
//- Tables
//- Components
//- - Navbar
//- - Cards