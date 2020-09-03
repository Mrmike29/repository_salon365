<?php
session_start();
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
Route::get('/', function () { return view('front/index'); });

/** FRONT */
Route::get('/get-entities', 'FrontController@getEntities');
Route::get('/get-e-c', 'FrontController@getEC');

Route::middleware(['auth'])->group(function () {
    // Route::get('/home', function () {
    //     return view('welcome');
    // });
    Route::get('/home','HomeController@home');



    Route::get('/tareas','RepositorioController@index_homework');
    Route::get('/temas_materias/{id}/{teacher}','RepositorioController@themes_subjects');
    Route::get('/materias_profesores/{id}','RepositorioController@subjects_teacher');
    Route::get('/buscar_tema/{subject}/{theme}/{teacher}','RepositorioController@search_themes');
    Route::get('/agregar_tareas','RepositorioController@create_homework');
    Route::get('/materias_tereas/{id}','RepositorioController@subjetcs_homework');
    Route::get('/temas_tereas/{id}/{con}','RepositorioController@themes_homework');
    Route::get('/buscar_tarea/{id}','RepositorioController@search_homework');
    Route::get('/buscar_tarea_curso/{id}','RepositorioController@search_homework_course');
    Route::post('/subir_tarea','RepositorioController@go_up_homework');
    Route::post('/crear_tarea','RepositorioController@store_homework');

    Route::get('/foros','RepositorioController@index_foro');
    Route::get('/info_foro/{id}','RepositorioController@info_foro');
    Route::get('/info_foro_responder/{id}','RepositorioController@info_foro_answer');
    Route::post('/crear_respuest_foro','RepositorioController@store_info_foro_answer');
    Route::get('/agregar_foro','RepositorioController@create_foro');
    Route::get('/materias_curso/{id}','RepositorioController@subjects_course');
    Route::post('/crear_foro','RepositorioController@store_foro');

    Route::post('/archivo', 'RepositorioController@archivos_store');
    Route::post('/upload_image', 'RepositorioController@upload_image');
    Route::post('/delete_archivo', 'RepositorioController@archivos_delete');


    Route::post('/probandoAndo','UsuariosController@changePassword');

    Route::get('/usuarios','UsuariosController@index');
    Route::get('/crear_usuarios','UsuariosController@create');
    Route::post('/store_usuarios','UsuariosController@store');
    Route::get('/editar_usuario/{id}','UsuariosController@edit');
    Route::post('/post_usuario','UsuariosController@update');
    Route::post('/inhabilitar_usuario','UsuariosController@inhabilitar');
    Route::post('/habilitar_usuario','UsuariosController@habilitar');
    Route::get('/cursos','CursosController@index');
    Route::get('/crear_cursos','CursosController@create');
    Route::post('/store_cursos','CursosController@store');
    Route::get('/editar_cursos/{id}','CursosController@edit');
    Route::post('/update_cursos','CursosController@update');
    Route::get('/view_students_course/{id}','CursosController@view_students');
    Route::get('/view_teachers_course/{id}','CursosController@view_teachers');

    /** RÚBRICAS */
    Route::get('/gestionar-rubricas', function () { return view('rubricas'); });
    Route::get('/rubricas', function () { return view('rubricas'); });
    Route::get('/get-rubrics-list', 'RubricsController@getRubricsList');
    Route::get('/get-data-edit-rubric', 'RubricsController@getDataEditRubric');
    Route::get('/get-rule-rubric', 'RubricsController@getRuleRubric');

    Route::post('/post-save-rubric', 'RubricsController@postSaveRubric');

    Route::put('/put-save-edited-rubric', 'RubricsController@putSaveEditedRubric');


    /** CICLO O PERIODO */
    Route::get('/ciclo-o-periodo', function () { return view('ciclo_o_periodo'); });
    Route::get('/get-times-list', 'TimesController@getTimesList');
    Route::post('/post-save-time', 'TimesController@postSaveTime');

    /** TEMAS */
    Route::get('/temas', 'ThemesController@getThemesView');
    Route::get('/get-subject-filter', 'ThemesController@getSubjectFilter');
    Route::get('/get-times-filter', 'ThemesController@getTimesFilter');
    Route::get('/get-themes-list', 'ThemesController@getThemesList');
    Route::get('/get-data-create-theme', 'ThemesController@getDataCreateTheme');
    Route::get('/get-data-edit-theme', 'ThemesController@getDataEditTheme');
    Route::post('/post-save-theme', 'ThemesController@postSaveTheme');
    Route::put('/put-edit-theme', 'ThemesController@putEditTheme');

    /** FECHAS IMPORTANTES */
    Route::get('/fechas-importantes', 'ImportantDatesController@getImportantDatesView');
    Route::get('/get-pending-events', 'ImportantDatesController@getPendingEvents');
    Route::get('/get-held-events', 'ImportantDatesController@getHeldEvents');
    Route::get('/get-event', 'ImportantDatesController@getEvent');
    Route::get('/get-calendar-events', 'ImportantDatesController@getCalendarEvents');
    Route::post('/post-save-event', 'ImportantDatesController@postSaveEvent');
    Route::put('/put-edit-event', 'ImportantDatesController@putEditEvent');

    /* VIDEOCHAT */
    Route::get('/listar/sala','SalaController@index');
    Route::get('/crear/sala','SalaController@getCrearSala');
    Route::post('/crear/sala','SalaController@crearSala')->name('crearSala');
    Route::get('/editar/sala/{id}','SalaController@getEditarSala');
    Route::post('/editar/sala','SalaController@editarSala')->name('editarSala');
    Route::post('/cambiar-estado/sala','SalaController@cambiarEstado');
    Route::get('/ingresar/sala/{id}','SalaController@ingresarSala');
    Route::get('/room_filter','SalaController@room_filter');

});
