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


Route::group(['middleware' => ['guest']], function () {
    Route::get('/', 'Auth\LoginController@showLoginForm');
    Route::match(array('GET', 'POST'), 'login', 'Auth\LoginController@login')->name('login');


});

Route::group(['middleware' => ['auth']], function () {
    Route::post('/logout', 'Auth\LoginController@logout')->name('logout');
    Route::get('/main', function () {
        return view('contenido/contenido');
    })->name('main');


    Route::group(['middleware' => ['Administrador']], function () {
        Route::get('/rol','RolController@index');
        Route::get('/rol/select-rol','RolController@selectRol');
        
        Route::get('/user','UserController@index');
        Route::post('/user/registrar','UserController@store');
        Route::put('/user/actualizar','UserController@update');
        Route::put('/user/activar','UserController@activar');
        Route::put('/user/desactivar','UserController@desactivar');

    });


});

//EJEMPLO PARA PETICONES GRAPQHL
Route::get('post', 'DataController@postRequest');

// Exception routes
Route::get('exception/index', 'ExceptionController@index');

//LOG VIWER
Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');

