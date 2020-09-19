<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\User_list_students;
use App\Course;
use App\Teacher_course;
use App\Themes_time;
use App\Rubrics;
use App\Homework;
use App\Homework_course;
use App\Archives_homework;
use App\Archives_homework_course;
use App\Foro;
use App\Content_foro;
use App\Archives_content_foro;
use App\Exam;
use App\Questions;
use App\Type_question;
use App\Question_multiple;
use App\Questions_students;
use App\Parcial_notes;
use App\Notes_exam;
use App\Notes_homework;
use App\Entity;
use DB;
use Auth;
use Mail;
use DateTime;

class RepositorioController extends Controller
{
    public function codigo()
    {
        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';

        return substr(str_shuffle($permitted_chars), 0, 15);
    }

    public function index_homework()
    {
        $id_user = Auth::user()->id;
        $rol_user = Auth::user()->id_rol;
        $entity_user = Auth::user()->id_info_entity;
        if($rol_user == 4){
            $materias = Homework::join('themes_time','themes_time.id','homework.id_theme_time')
                                ->join('subjects','subjects.id','themes_time.id_subject')
                                ->join('teacher_course','teacher_course.id_course','homework.id_course')
                                ->where('teacher_course.id_users',$id_user)
                                ->select('subjects.id','subjects.name')
                                ->groupBy('subjects.id')
                                ->get();
            $profesores = NULL;
        }elseif($rol_user == 2){
            $materias = NULL;
            $profesores = User::where('id_rol',4)
                                ->where('id_info_entity',$entity_user)
                                ->get();
        }elseif($rol_user == 5){
            $materias = Homework::join('themes_time','themes_time.id','homework.id_theme_time')
                                ->join('subjects','subjects.id','themes_time.id_subject')
                                ->join('course','course.id','homework.id_course')
                                ->join('list_students','list_students.id','course.id_list_students')
                                ->join('users_list_students','users_list_students.id_list_students','list_students.id')
                                ->where('users_list_students.id_users',$id_user)
                                ->select('subjects.id','subjects.name')
                                ->groupBy('subjects.id')
                                ->get();
            $profesores = NULL;
        }

        return view('repositorio.index-homework',array('materias'=>$materias, 'profesores'=>$profesores));
    }

    public function subjects_teacher($id)
    {
        $materias = Homework::join('themes_time','themes_time.id','homework.id_theme_time')
                            ->join('subjects','subjects.id','themes_time.id_subject')
                            ->join('teacher_course','teacher_course.id_course','homework.id_course')
                            ->where('teacher_course.id_users',$id)
                            ->select('subjects.id','subjects.name')
                            ->groupBy('subjects.id')
                            ->get();
        
        return $materias;
    }

    public function themes_subjects($id, $teacher)
    {
        if($teacher == 0){
            $id_user = Auth::user()->id;
        }else{
            $id_user = $teacher;
        }
        $temas = Homework::join('themes_time','themes_time.id','homework.id_theme_time')
                        ->join('teacher_course','teacher_course.id_course','homework.id_course')
                        ->join('course','course.id','homework.id_course')
                        ->join('list_students','list_students.id','course.id_list_students')
                        ->where('teacher_course.id_users',$id_user)
                        ->where('themes_time.id_subject',$id)
                        ->select('themes_time.id','themes_time.name','list_students.name as name_list')
                        ->groupBy('themes_time.id')
                        ->get();

        return $temas;
    }

    public function search_themes($subject, $theme, $teacher)
    {
        $data = [];
        if($teacher == 0){
            $id_user = Auth::user()->id;
        }else{
            $id_user = $teacher;
        }
        $hoy = date('Y-m-d 00:00:00');
        if(Auth::user()->id_rol == 5){
            $tareas = Homework::join('themes_time','themes_time.id','homework.id_theme_time')
                                ->leftJoin('archives_homework','archives_homework.id','homework.id')
                                ->join('course','course.id','homework.id_course')
                                ->join('teacher_course','teacher_course.id_course','course.id')
                                ->join('list_students','list_students.id','course.id_list_students')
                                ->leftJoin('users_list_students','users_list_students.id_list_students','list_students.id')
                                ->join('users','users.id','teacher_course.id_users')
                                ->leftJoin('homework_course', function ($join) {
                                    $join->on('homework_course.id_homework', '=', 'homework.id');
                                    $join->on('homework_course.id_student', '=', 'users_list_students.id_users');
                                })
                                // ->leftJoin('homework_course','homework_course.id_homework','homework.id')
                                // ->leftJoin('homework_course as homework_course_2','homework_course_2.id_student','users_list_students.id_users')
                                ->leftJoin('notes_homework', function ($join) {
                                    $join->on('notes_homework.id_homework', '=', 'homework.id');
                                    $join->on('notes_homework.id_student', '=', 'users_list_students.id_users');
                                })
                                ->leftJoin('parcial_notes','parcial_notes.id','notes_homework.id_parcial_notes')
                                ->select('themes_time.name as name_theme','users.name as name_students','users.last_name as last_name_students','homework.id as id_homework','homework.limit_time','homework_course.id as id_homework_course','parcial_notes.value as nota')
                                ->where('themes_time.id_subject',$subject)
                                ->where('users_list_students.id_users',Auth::user()->id)
                                ->where('homework.start_time','<=',$hoy)
                                ->groupBy('homework.id')
                                ->get();
            foreach ($tareas as $key => $val) {
                $val->name_teacher = $val->name_students.' '.$val->last_name_students;
                $val->limit_time = date('Y-m-d',strtotime($val->limit_time));
                if($val->nota != null){
                    $val->status = "Calificado";
                }elseif($val->id_homework_course){
                    $val->status = "Entregado";
                }elseif(date('Y-m-d',strtotime($val->limit_time)) < date('Y-m-d')){
                    $val->status = "Vencido";
                }else{
                    $val->status = "Pendiente";
                }
                $data[] = $val;
                $val->id_homework = encrypt($val->id_homework);
                if($val->id_homework_course){
                    $val->id_homework_course = encrypt($val->id_homework_course);
                }else{
                    $val->id_homework_course = null;
                }
                $val->limit_time = date('d/m/Y',strtotime($val->limit_time));
            }
        }else{
            $tareas = Homework::join('teacher_course','teacher_course.id_course','homework.id_course')
                                ->join('themes_time','themes_time.id','homework.id_theme_time')
                                ->join('subjects','subjects.id','teacher_course.id_subjects')
                                ->leftJoin('archives_homework','archives_homework.id','homework.id')
                                ->join('course','course.id','homework.id_course')
                                ->join('list_students','list_students.id','course.id_list_students')
                                ->leftJoin('users_list_students','users_list_students.id_list_students','list_students.id')
                                ->join('users','users.id','users_list_students.id_users')
                                ->leftJoin('homework_course', function ($join) {
                                    $join->on('homework_course.id_homework', '=', 'homework.id');
                                    $join->on('homework_course.id_student', '=', 'users.id');
                                })
                                // ->leftJoin('homework_course','homework_course.id_homework','homework.id')
                                // ->leftJoin('homework_course as homework_course_2','homework_course_2.id_student','users.id')
                                ->leftJoin('notes_homework', function ($join) {
                                    $join->on('notes_homework.id_homework', '=', 'homework.id');
                                    $join->on('notes_homework.id_student', '=', 'users.id');
                                })
                                ->leftJoin('parcial_notes','parcial_notes.id','notes_homework.id_parcial_notes')
                                ->select('themes_time.name as name_theme','subjects.name as name_subject','users.id as id_user','users.name as name_students','users.last_name as last_name_students','list_students.name as name_list','homework.id as id_homework','homework.limit_time','homework_course.id as id_homework_course','parcial_notes.value as nota')
                                ->where('teacher_course.id_subjects',$subject)
                                ->where('teacher_course.id_users',$id_user)
                                ->where('homework.id_theme_time',$theme)
                                ->groupBy('users.id','homework.id')
                                ->get();
            foreach ($tareas as $key => $val) {
                $val->name_students = $val->name_students.' '.$val->last_name_students;
                $val->limit_time = date('Y-m-d',strtotime($val->limit_time));
                if($val->nota != null){
                    $val->status = "Calificado";
                }elseif($val->id_homework_course){
                    $val->status = "Entregado";
                }elseif(date('Y-m-d',strtotime($val->limit_time)) < date('Y-m-d')){
                    $val->status = "Vencido";
                }else{
                    $val->status = "Pendiente";
                }
                $data[] = $val;
                $val->id_homework = encrypt($val->id_homework);
                if($val->id_homework_course){
                    $val->id_homework_course = encrypt($val->id_homework_course);
                }else{
                    $val->id_homework_course = null;
                }
                $val->limit_time = date('d/m/Y',strtotime($val->limit_time));
            }
        }
        return json_encode($data);
    }

    public function search_homework($id)
    {
        $id = decrypt($id);
        $tarea = Homework::find($id);
        $archivos = Archives_homework::where('id_homework',$id)->get();

        return $res = ["tarea" => $tarea, "archivos" => $archivos];
    }

    public function search_homework_course($id)
    {
        $id = decrypt($id);
        $tarea = Homework_course::find($id);
        $archivos = Archives_homework_course::where('id_homework_course',$id)->get();

        return $res = ["tarea" => $tarea, "archivos" => $archivos];
    }

    public function create_homework()
    {
        $id_user = Auth::user()->id;
        $rol_user = Auth::user()->id_rol;
        if($rol_user == 4){
            $cursos = Course::join('list_students','list_students.id','course.id_list_students')
                            ->join('teacher_course','teacher_course.id_course','course.id')
                            ->select('list_students.name','course.id')
                            ->where('teacher_course.id_users',$id_user)
                            ->groupBy('list_students.name','course.id')
                            ->get();
        }elseif($rol_user == 2){
            $cursos = Course::join('list_students','list_students.id','course.id_list_students')
                            ->select('list_students.name','course.id')
                            ->get();
        }
        $rubricas = Rubrics::get();

        return view('repositorio.create-homework',array('cursos'=>$cursos, 'rubricas'=>$rubricas));
    }

    public function subjetcs_homework($id)
    {
        $id_user = Auth::user()->id;
        $rol_user = Auth::user()->id_rol;
        if($rol_user == 4){
            $materias = Teacher_course::join('users','users.id','teacher_course.id_users')
                                        ->join('subjects','subjects.id','teacher_course.id_subjects')
                                        ->select('teacher_course.id','subjects.name as subjects','users.name as teacher','users.last_name')
                                        ->where('teacher_course.id_course',$id)
                                        ->where('teacher_course.id_users',$id_user)
                                        ->get();
        }elseif($rol_user == 2){
            $materias = Teacher_course::join('users','users.id','teacher_course.id_users')
                                        ->join('subjects','subjects.id','teacher_course.id_subjects')
                                        ->select('teacher_course.id','subjects.name as subjects','users.name as teacher','users.last_name')
                                        ->where('teacher_course.id_course',$id)
                                        ->get();
        }

        return $materias;
    }

    public function themes_homework($id, $con)
    {
        $materia = Teacher_course::find($id);
        $temas = Themes_time::where('id_course',$con)->where('id_subject',$materia->id_subjects)->get();

        return $temas;
    }

    public function go_up_homework(Request $request)
    {
        $id_user = Auth::user()->id;
        $course = User::join('users_list_students','users_list_students.id_users','users.id')
                        ->join('list_students','list_students.id','users_list_students.id_list_students')
                        ->join('course','course.id_list_students','list_students.id')
                        ->select('course.id')
                        ->where('users.id',$id_user)
                        ->first();
        // dd($course->id);
        $remove = '<p data-f-id="pbf" style="text-align: center; font-size: 14px; margin-top: 30px; opacity: 0.65; font-family: sans-serif;">Powered by <a href="https://www.froala.com/wysiwyg-editor?pb=1" title="Froala Editor">Froala Editor</a></p>';

        $tareas = new Homework_course();
        $tareas->id_homework = decrypt($request->id_homework);
        $tareas->id_course = $course->id;
        $tareas->id_student = $id_user;
        $tareas->description = str_replace($remove,'',$request->description);
        $tareas->save();

        if($request->has('document')){
            foreach ($request->document as $key => $val) {
                $archivos = new Archives_homework_course();
                $archivos->id_homework_course = $tareas->id;
                $archivos->description = '/archives/'.$val;
                $archivos->save();
            }
        }

        return 1;
    }

    public function store_note_homework(Request $request)
    {
        $entity = Entity::where('id',Auth::user()->id_info_entity)
                        ->first();
        if($request->note > $entity->max_score){
            return $entity->max_score;
        }

        $nota = new Parcial_notes();
        $nota->value = $request->note;
        $nota->save();

        $nota_tarea = new Notes_homework();
        $nota_tarea->id_homework = decrypt($request->homework);
        $nota_tarea->id_student = $request->user;
        $nota_tarea->id_teacher = 2;
        $nota_tarea->id_parcial_notes = $nota->id;
        $nota_tarea->save();

        return $entity->max_score;
    }

    public function store_homework(Request $request)
    {
        $remove = '<p data-f-id="pbf" style="text-align: center; font-size: 14px; margin-top: 30px; opacity: 0.65; font-family: sans-serif;">Powered by <a href="https://www.froala.com/wysiwyg-editor?pb=1" title="Froala Editor">Froala Editor</a></p>';

        $tareas = new Homework($request->except(['id_subjects','description','document']));
        $tareas->description = str_replace($remove,'',$request->description);
        $tareas->save();

        if($request->has('document')){
            foreach ($request->document as $key => $val) {
                $archivos = new Archives_homework();
                $archivos->id_homework = $tareas->id;
                $archivos->description = '/archives/'.$val;
                $archivos->save();
            }
        }

        return redirect('/agregar_tareas');
    }

    public function index_foro()
    {
        $id_user = Auth::user()->id;
        $hoy = date('Y-m-d 00:00:00');
        if(Auth::user()->id_rol == 5){
            $foros = Foro::join('teacher_course','teacher_course.id','foro.id_teacher_course')
                        ->join('subjects','subjects.id','teacher_course.id_subjects')
                        ->join('course','course.id','teacher_course.id_course')
                        ->join('list_students','list_students.id','course.id_list_students')
                        ->join('users_list_students','users_list_students.id_list_students','list_students.id')
                        ->join('users','users.id','teacher_course.id_users')
                        ->select('foro.id','users.name as name_teacher','users.last_name as last_name_teacher','subjects.name as subject','list_students.name as course','foro.description as name','foro.date_start','foro.date_end')
                        ->where('users_list_students.id_users',$id_user)
                        ->where('foro.date_start','<=',$hoy)
                        ->groupBy('foro.id')
                        ->get();
        }elseif(Auth::user()->id_rol == 4){
            $foros = Foro::join('teacher_course','teacher_course.id','foro.id_teacher_course')
                        ->join('subjects','subjects.id','teacher_course.id_subjects')
                        ->join('course','course.id','teacher_course.id_course')
                        ->join('list_students','list_students.id','course.id_list_students')
                        ->join('users','users.id','teacher_course.id_users')
                        ->select('foro.id','users.name as name_teacher','users.last_name as last_name_teacher','subjects.name as subject','list_students.name as course','foro.description as name','foro.date_start','foro.date_end')
                        ->where('teacher_course.id_users',$id_user)
                        ->groupBy('foro.id')
                        ->get();
        }else{
            $foros = Foro::join('teacher_course','teacher_course.id','foro.id_teacher_course')
                        ->join('subjects','subjects.id','teacher_course.id_subjects')
                        ->join('course','course.id','teacher_course.id_course')
                        ->join('list_students','list_students.id','course.id_list_students')
                        ->join('users','users.id','teacher_course.id_users')
                        ->select('foro.id','users.name as name_teacher','users.last_name as last_name_teacher','subjects.name as subject','list_students.name as course','foro.description as name','foro.date_start','foro.date_end')
                        ->groupBy('foro.id')
                        ->get();
        }

        return view('repositorio.index-foro',array('foros'=>$foros));
    }

    public function info_foro($id)
    {
        $id = decrypt($id);
        $foro = Foro::find($id);
        $contenido = Content_foro::join('users','users.id','content_foro.id_user')
                                ->join('rol','rol.id','users.id_rol')
                                ->leftJoin('users as answer','answer.id','content_foro.answer_to')
                                ->select('users.*', 'content_foro.id as id_content_foro', 'rol.name as rol', 'content_foro.description as content', 'content_foro.id as id_content', 'answer.name as answer_name', 'answer.last_name as answer_last_name', 'answer.id as id_answer', 'users.id as id_users')
                                ->where('id_foro',$id)
                                ->get();
        $archivos = Archives_content_foro::get();


        return view('repositorio.info_foro',array('contenido'=>$contenido, 'archivos'=>$archivos, 'foro'=>$foro));
    }

    public function info_foro_answer($id)
    {
        $id = decrypt($id);
        $contenido = Content_foro::find($id);

        return view('repositorio.info_foro_answer', array('contenido'=>$contenido));
    }

    public function store_info_foro_answer(Request $request)
    {
        $remove = '<p data-f-id="pbf" style="text-align: center; font-size: 14px; margin-top: 30px; opacity: 0.65; font-family: sans-serif;">Powered by <a href="https://www.froala.com/wysiwyg-editor?pb=1" title="Froala Editor">Froala Editor</a></p>';

        $id_user = Auth::user()->id;
        // if($request->has('descriptions')){
            $contenido = new Content_foro();
            $contenido->id_foro = $request->id_foro;
            $contenido->id_user = $id_user;
            $contenido->answer_to = $request->user_answer;
            $contenido->description = str_replace($remove,'',$request->descriptions);
            $contenido->save();
        // }

        if($request->has('document')){
            foreach ($request->document as $key => $val) {
                $archivos = new Archives_content_foro();
                $archivos->id_content_foro = $contenido->id;
                $archivos->description = $val;
                $archivos->save();
            }
        }

        return redirect('/info_foro/'.encrypt($request->id_foro));
    }

    public function create_foro()
    {
        $id_user = Auth::user()->id;
        $cursos = Course::join('teacher_course','teacher_course.id_course','course.id')
                        ->join('list_students','list_students.id','course.id_list_students')
                        ->join('subjects','subjects.id','teacher_course.id_subjects')
                        ->select('course.id','list_students.name')
                        ->where('teacher_course.id_users',$id_user)
                        ->groupBy('course.id')
                        ->get();

        return view('repositorio.create-foro',array('cursos'=>$cursos));
    }

    public function subjects_course($id)
    {
        $id_user = Auth::user()->id;
        $materias = Course::join('teacher_course','teacher_course.id_course','course.id')
                            ->join('list_students','list_students.id','course.id_list_students')
                            ->join('subjects','subjects.id','teacher_course.id_subjects')
                            ->select('subjects.id','subjects.name')
                            ->where('teacher_course.id_users',$id_user)
                            ->where('teacher_course.id_course',$id)
                            ->get();
        
        return $materias;
    }

    public function store_foro(Request $request)
    {
        $remove = '<p data-f-id="pbf" style="text-align: center; font-size: 14px; margin-top: 30px; opacity: 0.65; font-family: sans-serif;">Powered by <a href="https://www.froala.com/wysiwyg-editor?pb=1" title="Froala Editor">Froala Editor</a></p>';

        $id_user = Auth::user()->id;

        $id_teacher_course = Teacher_course::where('id_users',$id_user)
                                            ->where('id_course',$request->id_course)
                                            ->where('id_subjects',$request->id_subject)
                                            ->first();

        $foro = new Foro($request->except('id_course','id_subject','descriptions','document'));
        $foro->id_teacher_course = $id_teacher_course->id;
        $foro->save();

        if($request->has('descriptions')){
            $contenido = new Content_foro();
            $contenido->id_foro = $foro->id;
            $contenido->id_user = $id_user;
            $contenido->answer_to = $id_user;
            $contenido->description = str_replace($remove,'',$request->descriptions);
            $contenido->save();
        }

        if($request->has('document')){
            foreach ($request->document as $key => $val) {
                $archivos = new Archives_content_foro();
                $archivos->id_content_foro = $contenido->id;
                $archivos->description = $val;
                $archivos->save();
            }
        }

        return redirect('/foros');
    }

    public function exams()
    {
        $id_user = Auth::user()->id;
        $rol_user = Auth::user()->id_rol;
        $entity_user = Auth::user()->id_info_entity;
        if($rol_user == 4){
            $profesores = NULL;
            $materias = Exam::join('themes_time','themes_time.id','exam.id_theme_time')
                            ->join('subjects','subjects.id','themes_time.id_subject')
                            ->join('teacher_course','teacher_course.id_course','exam.id_course')
                            ->where('teacher_course.id_users',$id_user)
                            ->select('subjects.id','subjects.name')
                            ->groupBy('subjects.id')
                            ->get();
        }else{
            $materias = NULL;
            $profesores = User::where('id_rol',4)
                                ->where('id_info_entity',$entity_user)
                                ->get();
        }

        return view('repositorio.view_exams',array('materias'=>$materias, 'profesores'=>$profesores));
    }

    public function search_exam($subject, $teacher)
    {
        $data = [];
        if($teacher == 0){
            $id_user = Auth::user()->id;
        }else{
            $id_user = $teacher;
        }
        $hoy = date('Y-m-d 00:00:00');
        if(Auth::user()->id_rol <> 4){
            $tareas = Exam::join('teacher_course','teacher_course.id_course','exam.id_course')
                            ->join('themes_time','themes_time.id','exam.id_theme_time')
                            ->join('subjects','subjects.id','themes_time.id_subject')
                            ->join('course','course.id','exam.id_course')
                            ->join('list_students','list_students.id','course.id_list_students')
                            ->select('themes_time.name as name_theme','subjects.name as name_subject','list_students.name as name_list','exam.id as id_exam','exam.date_end')
                            ->where('subjects.id',$subject)
                            ->where('teacher_course.id_users',$id_user)
                            ->groupBy('exam.id')
                            ->get();
            foreach ($tareas as $key => $val) {
                $val->date_end = date('d/m/Y',strtotime($val->date_end));
                $val->id_exam = encrypt($val->id_exam);
                $data[] = $val;
            }
        }else{
            $tareas = Exam::join('teacher_course','teacher_course.id_course','exam.id_course')
                            ->join('themes_time','themes_time.id','exam.id_theme_time')
                            ->join('subjects','subjects.id','themes_time.id_subject')
                            ->join('course','course.id','exam.id_course')
                            ->join('list_students','list_students.id','course.id_list_students')
                            ->select('themes_time.name as name_theme','subjects.name as name_subject','list_students.name as name_list','exam.id as id_exam','exam.date_end')
                            ->where('subjects.id',$subject)
                            ->where('teacher_course.id_users',$id_user)
                            ->groupBy('exam.id')
                            ->get();
            foreach ($tareas as $key => $val) {
                $val->date_end = date('d/m/Y',strtotime($val->date_end));
                $val->id_exam = encrypt($val->id_exam);
                $data[] = $val;
            }
        }
        return json_encode($data);
    }

    public function view_questions_exams(Request $request)
    {
        $id_exam = decrypt($request->id);
        $examen = Exam::find($id_exam);
        $preguntas = Questions::where('id_exam',$id_exam)->get();
        $preguntas_multiples = Question_multiple::join('questions','questions.id','question_multiple.id_question')
                                                ->select('question_multiple.*')
                                                ->where('questions.id_exam',$id_exam)
                                                ->get();

        return view('repositorio.view_questions_exam',array('examen'=>$examen, 'preguntas'=>$preguntas, 'preguntas_multiples'=>$preguntas_multiples));
    }

    public function index_exam()
    {
        $id_user = Auth::user()->id;
        $rol_user = Auth::user()->id_rol;
        $entity_user = Auth::user()->id_info_entity;
        if($rol_user == 4){
            $materias = Exam::join('themes_time','themes_time.id','exam.id_theme_time')
                            ->join('subjects','subjects.id','themes_time.id_subject')
                            ->join('teacher_course','teacher_course.id_course','exam.id_course')
                            ->where('teacher_course.id_users',$id_user)
                            ->select('subjects.id','subjects.name')
                            ->groupBy('subjects.id')
                            ->get();
            $profesores = NULL;
        }elseif($rol_user == 2){
            $materias = NULL;
            $profesores = User::where('id_rol',4)
                                ->where('id_info_entity',$entity_user)
                                ->get();
        }elseif($rol_user == 5){
            $materias = Exam::join('themes_time','themes_time.id','exam.id_theme_time')
                            ->join('subjects','subjects.id','themes_time.id_subject')
                            ->join('course','course.id','exam.id_course')
                            ->join('list_students','list_students.id','course.id_list_students')
                            ->join('users_list_students','users_list_students.id_list_students','list_students.id')
                            ->where('users_list_students.id_users',$id_user)
                            ->select('subjects.id','subjects.name')
                            ->groupBy('subjects.id')
                            ->get();
            $profesores = NULL;
        }

        return view('repositorio.index-exam',array('materias'=>$materias, 'profesores'=>$profesores));
    }

    public function subjects_teacher_exam($id)
    {
        $materias = Exam::join('themes_time','themes_time.id','exam.id_theme_time')
                        ->join('subjects','subjects.id','themes_time.id_subject')
                        ->join('teacher_course','teacher_course.id_course','exam.id_course')
                        ->where('teacher_course.id_users',$id)
                        ->select('subjects.id','subjects.name')
                        ->groupBy('subjects.id')
                        ->get();
        
        return $materias;
    }

    public function themes_subjects_exam($id, $teacher)
    {
        if($teacher == 0){
            $id_user = Auth::user()->id;
        }else{
            $id_user = $teacher;
        }
        $temas = Exam::join('themes_time','themes_time.id','exam.id_theme_time')
                    ->join('teacher_course','teacher_course.id_course','exam.id_course')
                    ->join('course','course.id','exam.id_course')
                    ->join('list_students','list_students.id','course.id_list_students')
                    ->where('teacher_course.id_users',$id_user)
                    ->where('themes_time.id_subject',$id)
                    ->select('themes_time.id','themes_time.name','list_students.name as name_list')
                    ->groupBy('themes_time.id')
                    ->get();

        return $temas;
    }

    public function search_themes_exam($subject, $theme, $teacher)
    {
        $data = [];
        if($teacher == 0){
            $id_user = Auth::user()->id;
        }else{
            $id_user = $teacher;
        }
        $hoy = date('Y-m-d 00:00:00');
        if(Auth::user()->id_rol == 5){
            $tareas = Exam::join('themes_time','themes_time.id','exam.id_theme_time')
                            ->join('course','course.id','exam.id_course')
                            ->join('teacher_course','teacher_course.id_course','course.id')
                            ->join('list_students','list_students.id','course.id_list_students')
                            ->leftJoin('users_list_students','users_list_students.id_list_students','list_students.id')
                            ->join('users','users.id','teacher_course.id_users')
                            ->leftJoin('questions_students', function ($join) {
                                $join->on('questions_students.id_exam', '=', 'exam.id');
                                $join->on('questions_students.id_users', '=', 'users_list_students.id_users');
                            })
                            ->leftJoin('notes_exam', function ($join) {
                                $join->on('notes_exam.id_exam', '=', 'exam.id');
                                $join->on('notes_exam.id_student', '=', 'users_list_students.id_users');
                            })
                            ->leftJoin('parcial_notes','parcial_notes.id','notes_exam.id_parcial_notes')
                            ->select('themes_time.name as name_theme','users_list_students.id_users as id_students','users.name as name_students','users.last_name as last_name_students','exam.id as id_exam','exam.date_end','questions_students.id as id_questions_students','notes_exam.id as id_nota','parcial_notes.value as note')
                            ->where('themes_time.id_subject',$subject)
                            ->where('users_list_students.id_users',Auth::user()->id)
                            ->where('exam.date_start','<=',$hoy)
                            ->groupBy('exam.id')
                            ->get();
            foreach ($tareas as $key => $val) {
                $val->name_teacher = $val->name_students.' '.$val->last_name_students;
                $val->date_end = date('Y-m-d',strtotime($val->date_end));
                if($val->id_nota){
                    $val->status = "Calificado";
                }elseif($val->id_questions_students){
                    $val->status = "Entregado";
                }elseif(date('Y-m-d',strtotime($val->date_end)) < date('Y-m-d')){
                    $val->status = "Vencido";
                }else{
                    $val->status = "Pendiente";
                }
                $data[] = $val;
                $val->id_exam = encrypt($val->id_exam);
                if($val->id_questions_students){
                    $val->id_questions_students = encrypt($val->id_questions_students);
                }else{
                    $val->id_questions_students = null;
                }
                $val->date_end = date('d/m/Y',strtotime($val->date_end));
            }
        }else{
            $tareas = Exam::join('teacher_course','teacher_course.id_course','exam.id_course')
                            ->join('themes_time','themes_time.id','exam.id_theme_time')
                            ->join('subjects','subjects.id','teacher_course.id_subjects')
                            ->join('course','course.id','exam.id_course')
                            ->join('list_students','list_students.id','course.id_list_students')
                            ->leftJoin('users_list_students','users_list_students.id_list_students','list_students.id')
                            ->join('users','users.id','users_list_students.id_users')
                            ->leftJoin('questions_students', function ($join) {
                                $join->on('questions_students.id_exam', '=', 'exam.id');
                                $join->on('questions_students.id_users', '=', 'users.id');
                            })
                            ->leftJoin('notes_exam', function ($join) {
                                $join->on('notes_exam.id_exam', '=', 'exam.id');
                                $join->on('notes_exam.id_student', '=', 'users.id');
                            })
                            ->leftJoin('parcial_notes','parcial_notes.id','notes_exam.id_parcial_notes')
                            ->select('themes_time.name as name_theme','subjects.name as name_subject','users.id as id_students','users.name as name_students','users.last_name as last_name_students','list_students.name as name_list','exam.id as id_exam','exam.date_end','questions_students.id as id_questions_students','notes_exam.id as id_nota','parcial_notes.value as note')
                            ->where('teacher_course.id_subjects',$subject)
                            ->where('teacher_course.id_users',$id_user)
                            ->where('exam.id_theme_time',$theme)
                            ->groupBy('users.id','exam.id')
                            ->get();
            foreach ($tareas as $key => $val) {
                $val->name_students = $val->name_students.' '.$val->last_name_students;
                $val->date_end = date('Y-m-d',strtotime($val->date_end));
                if($val->id_nota){
                    $val->status = "Calificado";
                }elseif($val->id_questions_students){
                    $val->status = "Entregado";
                }elseif(date('Y-m-d',strtotime($val->date_end)) < date('Y-m-d')){
                    $val->status = "Vencido";
                }else{
                    $val->status = "Pendiente";
                }
                $data[] = $val;
                $val->id_exam = encrypt($val->id_exam);
                if($val->id_questions_students){
                    $val->id_questions_students = encrypt($val->id_questions_students);
                }else{
                    $val->id_questions_students = null;
                }
                $val->date_end = date('d/m/Y',strtotime($val->date_end));
            }
        }
        return json_encode($data);
    }

    public function view_answers_exams($id, $user)
    {
        $id = decrypt($id);
        $info = Questions_students::find($id);
        $examen = Exam::find($info->id_exam);
        $preguntas = Questions::leftJoin('questions_students', function ($join) use ($user) {
                                    $join->on('questions_students.id_questions', '=', 'questions.id');
                                    $join->on('questions_students.id_users', '=', DB::raw("'".$user."'"));
                                })
                                ->select('questions.*', 'questions_students.status')
                                ->where('questions.id_exam',$info->id_exam)
                                ->groupBy('questions.id')
                                ->get();
        $preguntas_multiples = Question_multiple::join('questions','questions.id','question_multiple.id_question')
                                                ->leftJoin('questions_students', function ($join) use ($user) {
                                                    $join->on('questions_students.answer', '=', 'question_multiple.id');
                                                    $join->on('questions_students.id_users', '=', DB::raw("'".$user."'"));
                                                })
                                                ->select('question_multiple.*', 'questions_students.answer')
                                                ->where('questions.id_exam',$info->id_exam)
                                                ->get();
        $respuestas = Questions_students::leftJoin('question_multiple','question_multiple.id','questions_students.answer')
                                        ->select('questions_students.*')
                                        ->where('questions_students.id_exam',$info->id_exam)
                                        ->where('questions_students.id_course',$info->id_course)
                                        ->where('questions_students.id_users',$user)
                                        ->get();
        // dd($preguntas);
        $nota = Notes_exam::join('parcial_notes','parcial_notes.id','notes_exam.id_parcial_notes')
                            ->where('id_exam',$info->id_exam)
                            ->where('id_student',$user)
                            ->first();
         
        return view('repositorio.view_answers_exam',array('preguntas'=>$preguntas, 'preguntas_multiples'=>$preguntas_multiples, 'respuestas'=>$respuestas, 'nota'=>$nota, 'examen'=>$examen, 'info'=>$info));
    }

    public function perform_exam(Request $request)
    {
        $id_user = Auth::user()->id;
        $id_exam = decrypt($request->exam);
        $answer = Questions_students::where('id_exam',$id_exam)
                                    ->where('id_users',$id_user)
                                    ->first();
        if($answer){
            return redirect()->back();
        }else{
            $examen = Exam::find($id_exam);
            $preguntas = Questions::where('id_exam',$id_exam)->get();
            $preguntas_multiples = Question_multiple::join('questions','questions.id','question_multiple.id_question')
                                                    ->select('question_multiple.*')
                                                    ->where('questions.id_exam',$id_exam)
                                                    ->get();
        }

        return view('repositorio.info_exam',array('examen'=>$examen, 'preguntas'=>$preguntas, 'preguntas_multiples'=>$preguntas_multiples));
    }

    public function valid_question($quest)
    {
        $id_user = Auth::user()->id;
        $pregunta = Questions_students::where('id_exam',$quest->id_exam)
                                        ->where('id_questions',$quest->id)
                                        ->where('id_users',$id_user)
                                        ->get();
        foreach ($pregunta as $key => $val) {
            if($val->status <> 'f'){
                $res = Questions_students::find($val->id);
                if($quest->status == 'true'){
                    $res->status = 't';
                }else{
                    $res->status = 'f';
                }
                $res->update();
            }
        }
    }

    public function store_perform_exam(Request $request)
    {
        $entity = Entity::where('id',Auth::user()->id_info_entity)
                        ->first();
        $id_user = Auth::user()->id;
        $curso = User_list_students::join('list_students','list_students.id','users_list_students.id_list_students')
                                    ->join('course','course.id_list_students','list_students.id')
                                    ->select('course.id')
                                    ->where('users_list_students.id_users',$id_user)
                                    ->first();
        foreach ($request->respuesta as $keys => $value) {
            foreach ($value as $k => $v) {
                $respuestas = new Questions_students();
                $respuestas->id_exam = decrypt($request->id_exam);
                $respuestas->id_questions = $keys;
                $respuestas->id_course = $curso->id;
                $respuestas->id_users = $id_user;
                $respuestas->answer = $v;
                $respuestas->save();
            }
        }
        $preguntas = Questions::leftJoin('question_multiple','question_multiple.id_question','questions.id')
                                ->select('questions.*','question_multiple.id as id_opcion','question_multiple.description as opcion','question_multiple.status')
                                ->where('id_exam',decrypt($request->id_exam))
                                ->get();
        foreach($preguntas as $keys  => $value){
            foreach ($request->respuesta as $key => $val) {
                foreach ($val as $k => $v) {
                    if($value->id == $key && $value->id_opcion == $v){
                        if($value->id_type_question <> 3){
                            self::valid_question($value);
                        }
                    }
                }
            }
        }

        $respuestas = Questions_students::where('id_exam',decrypt($request->id_exam))
                                        ->where('id_course',$curso->id)
                                        ->where('id_users',$id_user)
                                        ->groupBy('id_questions')
                                        ->get();

        $p = 0;
        $s = 0;
        $valid = true;
        foreach($respuestas as $key => $val){
            $p++;
            if($val->status == 't'){
                $s++;
            }
            if(!$val->status){
                $valid = false;
            }
        }

        $status = '<h3>Espera hasta que el profesor lo califique</h3>';

        if($valid){
            $res = $entity->max_score / $p;
            $res = $res * $s;
            $res = number_format($res, 2);

            $nota = new Parcial_notes();
            $nota->value = $res;
            $nota->save();

            $nota_examen = new Notes_exam();
            $nota_examen->id_exam = decrypt($request->id_exam);
            $nota_examen->id_course = $curso->id;
            $nota_examen->id_teacher = 2;
            $nota_examen->id_student = $id_user;
            $nota_examen->id_parcial_notes = $nota->id;
            $nota_examen->save();

            $status = '<h2>Nota: '.$res.'</h2>';
        }

        return redirect('/examenes')->with('status',$status);
    }

    public function answer_exam($id)
    {
        $id = decrypt($id);
        $info = Questions_students::find($id);
        $examen = Exam::find($info->id_exam);
        $preguntas = Questions::where('id_exam',$info->id_exam)->where('id_type_question','3')->get();
        $respuestas = Questions_students::leftJoin('question_multiple','question_multiple.id','questions_students.answer')
                                        ->select('questions_students.*')
                                        ->where('questions_students.id_exam',$info->id_exam)
                                        ->where('questions_students.id_course',$info->id_course)
                                        ->where('questions_students.id_users',$info->id_users)
                                        ->get();
        return view('repositorio.note_exam',array('preguntas'=>$preguntas, 'respuestas'=>$respuestas, 'examen'=>$examen, 'info'=>$info));
    }

    public function store_answer_exam(Request $request)
    {
        $entity = Entity::where('id',Auth::user()->id_info_entity)
                        ->first();
        foreach ($request->status as $key => $value) {
            $respuesta = Questions_students::find($key);
            $respuesta->status = $value;
            $respuesta->update();
        }

        $respuestas = Questions_students::where('id_exam',decrypt($request->id_exam))
                                        ->where('id_users',decrypt($request->id_students))
                                        ->where('id_course',decrypt($request->id_course))
                                        ->groupBy('id_questions')
                                        ->get();

        $p = 0;
        $s = 0;
        $valid = true;
        foreach($respuestas as $key => $val){
            $p++;
            if($val->status == 't'){
                $s++;
            }
            if(!$val->status){
                $valid = false;
            }
        }
        
        $res = $entity->max_score / $p;
        $res = $res * $s;
        $res = number_format($res, 2);

        $nota = new Parcial_notes();
        $nota->value = $res;
        $nota->save();

        $nota_examen = new Notes_exam();
        $nota_examen->id_exam = decrypt($request->id_exam);
        $nota_examen->id_course = decrypt($request->id_course);
        $nota_examen->id_student = decrypt($request->id_students);
        $nota_examen->id_parcial_notes = $nota->id;
        $nota_examen->save();

        return redirect('/examenes');
    }

    public function view_note($id, $user)
    {
        if($user){
            $user = $user;
        }else{
            $user = Auth::user()->id;
        }
        $id = decrypt($id);
        $respuesta = Questions_students::find($id);

        $nota = Notes_exam::join('parcial_notes','parcial_notes.id','notes_exam.id_parcial_notes')
                            ->where('id_exam',$respuesta->id_exam)
                            ->where('id_student',$user)
                            ->first();
        return $nota;
    }

    public function create_exam()
    {
        $id_user = Auth::user()->id;
        $cursos = Teacher_course::join('course','course.id','teacher_course.id_course')
                                ->join('list_students','list_students.id','course.id_list_students')
                                ->select('course.id','list_students.name')
                                ->where('id_users',$id_user)
                                ->groupBy('course.id')
                                ->get();
        $tipo_pregunta = Type_question::get();
        $rubricas = Rubrics::get();

        return view('repositorio.create-exam',array('cursos'=>$cursos, 'rubricas'=>$rubricas, 'tipo_pregunta'=>$tipo_pregunta));
    }

    public function store_exam(Request $request)
    {
        $examen = new Exam();
        $examen->id_course = $request->id_course;
        $examen->id_rubrics = $request->id_rubrics;
        $examen->id_theme_time = $request->id_theme_time;
        $examen->date_start = $request->date_start;
        $examen->date_end = $request->date_end;
        $examen->save();

        foreach ($request->type_question as $key => $value) {
            $preguntas = new Questions();
            $preguntas->id_exam = $examen->id;
            $preguntas->id_type_question = $value;
            $preguntas->description = $request->question[$key];

            if($value == 3){
                $preguntas->answer = $request->respuesta[$key];
                $preguntas->save();
            }else{
                if($value == 1){
                    $preguntas->max_answer = $request->max_answer[$key];
                }elseif($value == 2){
                    $preguntas->max_answer = '1';
                }
                $preguntas->save();
                foreach ($request->opcion[$key] as $ke => $val) {
                    $preguntas_multiples = new Question_multiple();
                    $preguntas_multiples->id_question = $preguntas->id;
                    $preguntas_multiples->description = $val;
                    $preguntas_multiples->status = $request->status[$key][$ke];
                    $preguntas_multiples->save();
                }
            }
        }

        return redirect('/examenes');
    }

    public function qualify_exams_defeated()
    {
        $examenes = Exam::join('course','course.id','exam.id_course')
                        ->join('list_students','list_students.id','course.id_list_students')
                        ->join('users_list_students','users_list_students.id_list_students','list_students.id')
                        ->join('users','users.id','users_list_students.id_users')
                        ->leftJoin('notes_exam', function ($join) {
                            $join->on('notes_exam.id_exam', '=', 'exam.id');
                            $join->on('notes_exam.id_student', '=', 'users_list_students.id_users');
                        })
                        ->select('exam.id as id_exam','course.id as id_course','users.id as id_student','exam.date_end','notes_exam.id as id_note')
                        ->get();

        foreach($examenes as $key => $val){
            if($val->date_end < date('Y-m-d 00:00:00') && empty($val->id_note)){
                $nota = new Parcial_notes();
                $nota->value = '0';
                $nota->save();

                $nota_examen = new Notes_exam();
                $nota_examen->id_exam = $val->id_exam;
                $nota_examen->id_course = $val->id_course;
                $nota_examen->id_student = $val->id_student;
                $nota_examen->id_parcial_notes = $nota->id;
                $nota_examen->save();
            }
        }
    }

    public function archivos_store(Request $request)
    {
        $path = public_path().'/archives/';
        $file = $request->file('file');
        $fileName = uniqid().$file->getClientOriginalName();
        $file->move($path, $fileName);

        return response()->json([
            'name'          => $fileName,
            'original_name' => $file->getClientOriginalName(),
        ]);
    }

    public function upload_image(Request $request)
    {
        $path = public_path().'/froala_img/';
        $file = $request->file('file');
        $fileName = uniqid().$file->getClientOriginalName();
        $file->move($path, $fileName);

        $res = array('link'=>'/froala_img/'.$fileName);
        return json_encode($res);
    }

    public function archivos_delete(Request $request)
    {
        $filename = $request->get('filename');
        $path = public_path('/archives/').$filename;
        if (file_exists($path)) {
            unlink($path);
        }
        return $filename;
    }
}