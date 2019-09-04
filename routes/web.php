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



Route::group(['middleware' => ['guest']],function (){
    Route::get('/','Auth\LoginController@showLoginForm');
    Route::post('login', 'Auth\LoginController@login')->name('login');
});

Route::group(['middleware' => ['auth']],function (){
    Route::get('/main', function () {
        return view('contenido/contenido');
    })->name('main');

    Route::group(['middleware' => ['Administrador']],function (){

    });
});

//EJEMPLO PARA PETICONES GRAPQHL
Route::get('post','DataController@postRequest');