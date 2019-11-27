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
    return redirect(url('/login'));
});

/*Resource que facilita chamar uma função do Controller*/
Route::resource('usuario', 'UserController');

/*Resource que facilita chamar uma função do Controller*/
Route::resource('produto', 'ProdutoController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home/home', 'HomeController@home')->name('home.home');
/*Pegando todos os produtos*/
Route::get('/produtar/{id}', 'ProdutoController@produtos')->name('produtar');
Route::delete('produtar/{id}', 'ProdutoController@destroy')->name('produtar.destroy');