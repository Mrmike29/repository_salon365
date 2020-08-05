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

Route::get('/gestionar-rubricas', function () {
    return view('rubricas');
});

Route::get('/ciclo-o-periodo', function () {
    return view('ciclo_o_periodo');
});

Route::get('/fechas-importantes', 'Controller@getImportantDatesView');

Route::get('/get-event', 'Controller@getEvent');

Route::put('/put-edit-event', 'Controller@putEditEvent');

Route::get('/agregar_tareas', function () {
    return view('create-homework');
});

Route::get('/usuarios','UsuariosController@index');

Route::get('/crear_usuarios','UsuariosController@created');

Route::post('/archivo', 'TareasController@store');

Route::get('/home', 'HomeController@index')->name('home');
Auth::routes();

