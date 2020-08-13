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

Auth::routes();
Route::get('/', function () {
    return view('front/index');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/home', function () {
        return view('welcome');
    });
    Route::get('/agregar_tareas', function () {
        return view('create-homework');
    });
    Route::get('/gestionar-rubricas', function () {
        return view('rubricas');
    });
    Route::get('/usuarios','UsuariosController@index');
    Route::get('/crear_usuarios','UsuariosController@create');
    Route::post('/store_usuarios','UsuariosController@store');
    Route::get('/editar_usuario/{id}','UsuariosController@edit');
    Route::post('/post_usuario','UsuariosController@update');
    Route::post('/inhabilitar_usuario','UsuariosController@inhabilitar');
    Route::post('/habilitar_usuario','UsuariosController@habilitar');
    Route::post('/archivo', 'TareasController@store');
    Route::get('/rubricas', function () {
        return view('rubricas');
    });
    Route::get('/ciclo-o-periodo', function () {
        return view('ciclo_o_periodo');
    });

    /** FECHAS IMPORTANTES */
    Route::get('/fechas-importantes', 'Controller@getImportantDatesView');
    Route::get('/get-pending-events', 'Controller@getPendingEvents');
    Route::get('/get-event', 'Controller@getEvent');

    Route::post('/post-save-event', 'Controller@postSaveEvent');
    Route::put('/put-edit-event', 'Controller@putEditEvent');

    /* VIDEOCHAT */
    Route::get('/listar/sala','SalaController@index');
    Route::get('/crear/sala','SalaController@index');
    Route::post('/crear/sala','SalaController@index');
    Route::get('/editar/sala','SalaController@index');
    Route::post('/editar/sala','SalaController@index');
    Route::get('/cambiar-estado/sala','SalaController@index');
    Route::get('/ingresar/sala/{id}','SalaController@index');
    
});
