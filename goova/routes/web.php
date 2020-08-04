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

Route::get('/rubricas', function () {
    return view('rubricas');
});

Route::get('/ciclo-o-periodo', function () {
    return view('ciclo_o_periodo');
});


Route::get('/fechas-importantes', 'Controller@getImportantDatesView');

Route::get('/prueba', 'Controller@prueba');


Route::get('/agregar_tareas', function () {
    return view('create-homework');
});

Route::get('/usuarios','UsuariosController@index');

Route::post('/crear_usuarios','UsuariosController@created');

Route::post('/archivo', 'TareasController@store');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');