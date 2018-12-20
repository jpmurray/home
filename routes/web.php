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

Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/motdepasse', function () {
    return view('motdepasse');
})->name("motdepasse.edit");

Route::put('/motdepasse', 'PasswordController@update')->name("motdepasse.update");

Route::get('/users', 'UserController@index')->name("users.index");
Route::get('/users/new', 'UserController@create')->name("users.create");
Route::post('/users', 'UserController@store')->name("users.store");
Route::get('/users/{user}', 'UserController@edit')->name("users.edit");
Route::put('/users/{user}', 'UserController@update')->name("users.update");
Route::delete('/users/{user}', 'UserController@destroy')->name("users.delete");
