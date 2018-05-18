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
/*Route::get('/', function () {
    return view('home'); // welcome
});*/

Route::get('/users', 'UserController@index')->name('usersIndex');
Route::get('/', 'NominationController@index')->name('nominationsIndex');
Route::get('/{id}', 'NominationController@show')->where('id', '[0-9]+')->name('nominationsShow');
Route::get('/{id}/works', 'WorkController@indexByNomination')->where('id', '[0-9]+')->name('worksIndexByNomination');
Route::get('/{nId}/works/{wId}/thumbsup', 'WorkController@thumbsUp')
    ->where(['nid' => '[0-9]+', 'wId' => '[0-9]+'])
    ->name('workThumbsUp');
Route::get('/create', 'NominationController@create')->name('nominationsCreate');
Route::post('/', 'NominationController@store')->name('nominationsStore');
Route::get('/works/create', 'WorkController@create')->name('worksCreate');
Route::post('/works', 'WorkController@store')->name('worksStore');

Route::get('/api/users', 'UserApiController@index')->name('apiUsersIndex');
Route::get('/api/nominations', 'NominationApiController@index')->name('apiNominationsIndex');
Route::get('/api/nominations/{id}/works', 'WorkApiController@indexByNomination')
    ->where('id', '[0-9]+')
    ->name('apiWorksIndexByNomination');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
