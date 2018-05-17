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
    return view('home'); // welcome
});

Route::get('/users', 'UserController@index')->name('usersIndex');
Route::get('/nominations', 'NominationController@index')->name('nominationsIndex');
Route::get('/nominations/{id}', 'NominationController@show')->where('id', '[0-9]+')->name('nominationsShow');
Route::get('/nominations/{id}/works', 'WorkController@indexByNomination')->where('id', '[0-9]+')->name('worksIndexByNomination');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
