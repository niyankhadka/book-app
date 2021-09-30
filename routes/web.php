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
    return view('welcome');
});

Route::get('/books', 'BookController@index')->name( 'book.index' );
Route::get('/books/create', 'BookController@create')->name( 'book.create' );
Route::post('/books/store', 'BookController@store')->name('book.store');
Route::get('/books/{id}/edit', 'BookController@edit')->name('book.edit');
Route::post('/books/{id}/update', 'BookController@update')->name('book.update');
Route::post( 'books/{id}/delete', 'BookController@destroy' )->name('book.destroy');
