<?php
session_start();
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BulletinController;
use App\Http\Controllers\RepositorioController;
use App\Http\Controllers\CursosController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\AreasController;
use App\Http\Controllers\SubjectsController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SalaController;
use App\Http\Controllers\RubricsController;
use App\Http\Controllers\ThemesController;
use App\Http\Controllers\ImportantDatesController;
use App\Http\Controllers\NotesController;
use App\Http\Controllers\TimesController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\PdfController;

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
Route::get('/get-entities', [FrontController::class, 'getEntities']);
Route::get('/get-e-c', [FrontController::class, 'getEC']);

Route::middleware(['auth'])->group(function () {
    // Route::get('/home', function () {
    //     return view('welcome');
    // });

    /**  */
    Route::get('/home', [HomeController::class, 'home']);
    
    /**  */
    Route::get('/getBoletin', [SalaController::class, 'getBoletin']);

    /** TAREAS */
    Route::get('/tareas', [RepositorioController::class, 'index_homework']);
    Route::get('/temas_materias/{id}/{teacher}', [RepositorioController::class, 'themes_subjects']);
    Route::get('/materias_profesores/{id}', [RepositorioController::class, 'subjects_teacher']);
    Route::get('/buscar_tema/{subject}/{theme}/{teacher}', [RepositorioController::class, 'search_themes']);
    Route::get('/agregar_tareas', [RepositorioController::class, 'create_homework']);
    Route::get('/materias_tereas/{id}', [RepositorioController::class, 'subjetcs_homework']);
    Route::get('/temas_tereas/{id}/{con}', [RepositorioController::class, 'themes_homework']);
    Route::get('/buscar_tarea/{id}', [RepositorioController::class, 'search_homework']);
    Route::get('/buscar_tarea_curso/{id}', [RepositorioController::class, 'search_homework_course']);
    Route::post('/subir_tarea', [RepositorioController::class, 'go_up_homework']);
    Route::post('/crear_nota_tarea', [RepositorioController::class, 'store_note_homework']);
    Route::post('/crear_tarea', [RepositorioController::class, 'store_homework']);

    /** FOROS */
    Route::get('/foros', [RepositorioController::class, 'index_foro']);
    Route::get('/info_foro/{id}', [RepositorioController::class, 'info_foro']);
    Route::get('/info_foro_responder/{id}', [RepositorioController::class, 'info_foro_answer']);
    Route::post('/crear_respuest_foro', [RepositorioController::class, 'store_info_foro_answer']);
    Route::get('/agregar_foro', [RepositorioController::class, 'create_foro']);
    Route::get('/materias_curso/{id}', [RepositorioController::class, 'subjects_course']);
    Route::post('/crear_foro', [RepositorioController::class, 'store_foro']);

    /** ARCHIVOS */
    Route::post('/archivo', [RepositorioController::class, 'archivos_store']);
    Route::post('/upload_image', [RepositorioController::class, 'upload_image']);
    Route::post('/delete_archivo', [RepositorioController::class, 'archivos_delete']);

    /**  */
    Route::post('/probandoAndo', [UsuariosController::class, 'changePassword']);

    Route::get('/getFilteUser','UsuariosController@getFilteUser');
    /** USUARIOS */
    Route::get('/usuarios', [UsuariosController::class, 'index']);
    Route::get('/crear_usuarios', [UsuariosController::class, 'create']);
    Route::post('/store_usuarios', [UsuariosController::class, 'store']);
    Route::get('/editar_usuario/{id}', [UsuariosController::class, 'edit']);
    Route::post('/post_usuario', [UsuariosController::class, 'update']);
    Route::post('/inhabilitar_usuario', [UsuariosController::class, 'inhabilitar']);
    Route::post('/habilitar_usuario', [UsuariosController::class, 'habilitar']);
    Route::get('/estudientes_padres/{id_course}', [UsuariosController::class, 'students_parents']);

    /** CURSOS */
    Route::get('/cursos', [CursosController::class, 'index']);
    Route::get('/crear_cursos', [CursosController::class, 'create']);
    Route::post('/store_cursos', [CursosController::class, 'store']);
    Route::get('/editar_cursos/{id}', [CursosController::class, 'edit']);
    Route::post('/update_cursos', [CursosController::class, 'update']);
    Route::get('/view_students_course/{id}', [CursosController::class, 'view_students']);
    Route::get('/view_teachers_course/{id}', [CursosController::class, 'view_teachers']);

    Route::post('/previsualizarImagen','UsuariosController@previsualizarImagen');
    /** EXAMENES */
    Route::get('/exams', [RepositorioController::class, 'exams']);
    Route::post('/ver_preguntas_examen', [RepositorioController::class, 'view_questions_exams']);
    Route::get('/examenes', [RepositorioController::class, 'index_exam']);
    Route::get('/materias_profesores_exam/{id}', [RepositorioController::class, 'subjects_teacher_exam']);
    Route::get('/temas_materias_exam/{id}/{teacher}', [RepositorioController::class, 'themes_subjects_exam']);
    Route::get('/buscar_exam/{subject}/{teacher}', [RepositorioController::class, 'search_exam']);
    Route::get('/buscar_tema_exam/{subject}/{theme}/{teacher}', [RepositorioController::class, 'search_themes_exam']);
    Route::post('/realizar_examen', [RepositorioController::class, 'perform_exam']);
    Route::post('/crear_realizar_examen', [RepositorioController::class, 'store_perform_exam']);
    Route::get('/respuestas_examen/{id}', [RepositorioController::class, 'answer_exam']);
    Route::get('/ver_respuestas_examen/{id}/{user}', [RepositorioController::class, 'view_answers_exams']);
    Route::post('/crear_nota', [RepositorioController::class, 'store_answer_exam']);
    Route::get('/ver_nota/{id}/{user}', [RepositorioController::class, 'view_note']);
    Route::get('/agregar_examen', [RepositorioController::class, 'create_exam']);
    Route::post('/crear_examen', [RepositorioController::class, 'store_exam']);
    Route::get('/calificar_examenes_vencidos', [RepositorioController::class, 'qualify_exams_defeated']);

    /** AREAS */
    Route::get('/areas', [AreasController::class, 'index']);
    Route::get('/view_areas', [AreasController::class, 'view_areas']);
    Route::post('/store_areas', [AreasController::class, 'store']);
    Route::get('/edit_area/{id}', [AreasController::class, 'edit']);
    Route::post('/update_area', [AreasController::class, 'update']);

    /** ASIGNATURAS */
    Route::get('/asignaturas', [SubjectsController::class, 'index']);
    Route::get('/view_subjects', [SubjectsController::class, 'view_subjects']);
    Route::post('/store_subjects', [SubjectsController::class, 'store']);
    Route::get('/edit_subject/{id}', [SubjectsController::class, 'edit']);
    Route::post('/update_subject', [SubjectsController::class, 'update']);
    Route::get('/usuarios', 'UsuariosController@index');
    Route::get('/crear_usuarios', 'UsuariosController@create');
    Route::post('/store_usuarios', 'UsuariosController@store');
    Route::get('/editar_usuario/{id}', 'UsuariosController@edit');
    Route::get('/get-courses-parents', 'UsuariosController@getCoursesParents');
    Route::get('/get-students-per-course', 'UsuariosController@getStudentsPerCourse');
    Route::post('/post_usuario', 'UsuariosController@update');
    Route::post('/inhabilitar_usuario', 'UsuariosController@inhabilitar');
    Route::post('/habilitar_usuario', 'UsuariosController@habilitar');

    /** RÚBRICAS */
    Route::get('/gestionar-rubricas', function () { return view('rubrics/rubricas'); });
    Route::get('/rubricas', function () { return view('rubrics/rubricas'); });
    Route::get('/get-rubrics-list', [RubricsController::class, 'getRubricsList']);
    Route::get('/get-data-edit-rubric', [RubricsController::class, 'getDataEditRubric']);
    Route::get('/get-rule-rubric', [RubricsController::class, 'getRuleRubric']);
    Route::post('/post-save-rubric', [RubricsController::class, 'postSaveRubric']);
    Route::put('/put-save-edited-rubric', [RubricsController::class, 'putSaveEditedRubric']);

    /** CICLO O PERIODO */
    Route::get('/ciclo-o-periodo', function () { return view('times/ciclo_o_periodo'); });
    Route::get('/get-times-list', [TimesController::class, 'getTimesList']);
    Route::post('/post-save-time', [TimesController::class, 'postSaveTime']);


    /** TEMAS */
    Route::get('/temas', [ThemesController::class, 'getThemesView']);
    Route::get('/get-subject-filter', [ThemesController::class, 'getSubjectFilter']);
    Route::get('/get-times-filter', [ThemesController::class, 'getTimesFilter']);
    Route::get('/get-themes-list', [ThemesController::class, 'getThemesList']);
    Route::get('/get-data-create-theme', [ThemesController::class, 'getDataCreateTheme']);
    Route::get('/get-data-edit-theme', [ThemesController::class, 'getDataEditTheme']);
    Route::post('/post-save-theme', [ThemesController::class, 'postSaveTheme']);
    Route::put('/put-edit-theme', [ThemesController::class, 'putEditTheme']);


    /** FECHAS IMPORTANTES */
    Route::get('/fechas-importantes', [ImportantDatesController::class, 'getImportantDatesView']);
    Route::get('/get-pending-events', [ImportantDatesController::class, 'getPendingEvents']);
    Route::get('/get-held-events', [ImportantDatesController::class, 'getHeldEvents']);
    Route::get('/get-event', [ImportantDatesController::class, 'getEvent']);
    Route::get('/get-calendar-events', [ImportantDatesController::class, 'getCalendarEvents']);
    Route::post('/post-save-event', [ImportantDatesController::class, 'postSaveEvent']);
    Route::put('/put-edit-event', [ImportantDatesController::class, 'putEditEvent']);

    /** NOTAS */
    Route::get('/notas', [NotesController::class, 'getNotesView']);
    Route::get('/get-student', [NotesController::class, 'getStudent']);
    Route::get('/get-notes-list', [NotesController::class, 'getNotesList']);
    Route::get('/get-students-list', [NotesController::class, 'getStudentsList']);
    Route::get('/get-course-filter', [NotesController::class, 'getCourseFilter']);
    Route::get('/get-teacher-filter', [NotesController::class, 'getTeacherFilter']);


    /** REPORTES */
    Route::get('/reporte-anual', 'ReportsController@getAnualReport');
    Route::get('/reporte-periodo', 'ReportsController@getPeriodReport');
    Route::get('/get-reports', 'ReportsController@getReports');
    Route::get('/get-reports-period', 'ReportsController@getReportsPeriod');
    Route::get('/get-reports-anual', 'ReportsController@getReportsAnual');
    Route::get('/get-reports-subjects', 'ReportsController@getSubjectReport');
    Route::get('/get-period-filter', 'ReportsController@getPeriodFilter');
    


    /** BOLETIN */
    Route::get('/cursos-boletines', [BulletinController::class, 'getCursosBoletinesView']);
    Route::get('/mis-cursos', [BulletinController::class, 'getMisCursosView']);
    Route::get('/consultar-boletines', [BulletinController::class, 'getConsultarBoletinesView']);
    Route::get('/get-students-bulletin', [BulletinController::class, 'getStudentsBulletin']);
    Route::get('/get-list-students-bulletin', [BulletinController::class, 'getListStudentsBulletin']);
    Route::get('/get-my-students-bulletin', [BulletinController::class, 'getMyStudentsBulletin']);
    Route::get('/get-student-to-report', [BulletinController::class, 'getStudentToReport']);
    Route::get('/get-reports-student', [BulletinController::class, 'getReportsStudent']);
    Route::get('/get-reports-my-student', [BulletinController::class, 'getReportsMyStudent']);

    Route::post('/post-save-report', [BulletinController::class, 'postSaveReport']);
    Route::post('/post-save-general-report', [BulletinController::class, 'postSaveGeneralReport']);

    Route::put('/put-save-report', [BulletinController::class, 'putSaveReport']);
    Route::put('/put-save-general-report', [BulletinController::class, 'putSaveGeneralReport']);


    /** PDF */
    Route::get('/get-bulletin', 'PdfController@getBulletin');
    Route::get('/get-c-d', [PdfController::class, 'getCryptData']);

    /* VIDEOCHAT */
    Route::get('/listar/sala', [SalaController::class, 'index']);
    Route::get('/crear/sala', [SalaController::class, 'getCrearSala']);
    Route::post('/crear/sala', [SalaController::class, 'crearSala'])->name('crearSala');
    Route::get('/editar/sala/{id}', [SalaController::class, 'getEditarSala']);
    Route::post('/editar/sala', [SalaController::class, 'editarSala'])->name('editarSala');
    Route::post('/cambiar-estado/sala', [SalaController::class, 'cambiarEstado']);
    Route::get('/ingresar/sala/{id}', [SalaController::class, 'ingresarSala']);
    Route::get('/room_filter', [SalaController::class, 'room_filter']);
    Route::post('/saveAssist', [SalaController::class, 'saveAssist']);

    /* SECRETARIA */
    Route::get('/getHorarios', [SalaController::class, 'getHorario']);
});