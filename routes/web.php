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
Route::redirect('/', '/nominations', 301);

Route::middleware(['auth'])->group(function () {
    Route::get('/nominations/{id}/works', 'WorkController@indexByNomination')
        ->where('id', '[0-9]+')
        ->name('works.indexByNomination');

    Route::get('/nominations/{nId}/works/{wId}/thumbsup', 'WorkController@thumbsUp')
        ->where(['nid' => '[0-9]+', 'wId' => '[0-9]+'])
        ->name('works.thumbsUp');

    Route::get('/api/users', 'UserController@indexDT')
        ->name('api.users.index');

    Route::get('/api/nominations', 'NominationController@indexDT')
        ->name('api.nominations.index');

    Route::get('/api/works', 'WorkController@indexDT')
        ->name('api.works.index');

    Route::get('/api/nominations/{id}/works', 'WorkController@indexByNominationDT')
        ->where('id', '[0-9]+')
        ->name('api.works.indexByNomination');

    Route::get('/works/create/{Id}', 'WorkController@create')->where('id', '[0-9]+');

    Route::resource('users', 'UserController');
    Route::resource('nominations', 'NominationController');
    Route::resource('works', 'WorkController');
});

Auth::routes();
