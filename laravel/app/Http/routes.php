<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::get('/dvds/create', 'DvdController@create');
Route::post('/dvds', 'DvdController@postDvd');

Route::get('/', 'DvdController@search');
Route::get('/dvds/search', 'DvdController@search');

Route::get('/dvds/search', 'DvdController@search');
Route::get('/dvds', 'DvdController@results');

Route::get('dvds/{id}', 'DvdController@details');
Route::post('/dvds/details/{id}', 'DvdController@storeReview');

Route::get('/genres/{genreName}/dvds', 'DvdsController@genreResults');




?>
