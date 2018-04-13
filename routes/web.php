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


//Route::get( '/threads', 'ThreadsController@index' );
Auth::routes();
Route::Resource( '/', 'ThreadsController' );
Route::Resource( 'home', 'ThreadsController' );
//Route::get( '/threads/', 'ThreadsController@index' );


Route::get( 'threads', 'ThreadsController@index' );
Route::get( 'threads/create', 'ThreadsController@create' );
Route::post( 'threads', 'ThreadsController@store' );
Route::get( 'threads/edit/{id}', 'ThreadsController@edit' );
Route::patch( 'threads/{id}', 'ThreadsController@update' );
Route::delete( 'threads/{id}', 'ThreadsController@destroy' );
Route::get( '/threads/{channel}/{thread}', 'ThreadsController@show' );


//Route::Resource( '/threads', 'ThreadsController' );
Route::Resource( '/replies', 'ReplyController' );
Route::post( '/threads/{channel}/{thread}/replies', 'ReplyController@store' );

