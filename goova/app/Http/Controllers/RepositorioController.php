<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
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
        if(Auth::user()->id_rol == 5){
            $tareas = Homework::join('themes_time','themes_time.id','homework.id_theme_time')
                                ->leftJoin('archives_homework','archives_homework.id','homework.id')
                                ->join('course','course.id','homework.id_course')
                                ->join('teacher_course','teacher_course.id_course','course.id')
                                ->join('list_students','list_students.id','course.id_list_students')
                                ->leftJoin('users_list_students','users_list_students.id_list_students','list_students.id')
                                ->join('users','users.id','teacher_course.id_users')
                                ->leftJoin('homework_course','homework_course.id_homework','homework.id')
                                ->select('themes_time.name as name_theme','users.name as name_students','users.last_name as last_name_students','homework.id as id_homework','homework.limit_time','homework_course.id as id_homework_course')
                                ->where('themes_time.id_subject',$subject)
                                ->where('users_list_students.id_users',Auth::user()->id)
                                ->groupBy('homework.id')
                                ->get();
            foreach ($tareas as $key => $val) {
                $val->name_teacher = $val->name_students.' '.$val->last_name_students;
                $val->limit_time = date('d/m/Y',strtotime($val->limit_time));
                if($val->id_homework_course){
                    $val->status = "Entregado";
                }elseif($val->limit_time < date('d/m/Y')){
                    $val->status = "Vencido";
                }else{
                    $val->status = "Pendiente";
                }
                $data[] = $val;
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
                                ->leftJoin('homework_course','homework_course.id_homework','homework.id')
                                ->select('themes_time.name as name_theme','subjects.name as name_subject','users.name as name_students','users.last_name as last_name_students','list_students.name as name_list','homework.id as id_homework','homework.limit_time','homework_course.id as id_homework_course')
                                ->where('teacher_course.id_subjects',$subject)
                                ->where('teacher_course.id_users',$id_user)
                                ->where('homework.id_theme_time',$theme)
                                ->groupBy('homework.id')
                                ->get();
            foreach ($tareas as $key => $val) {
                $val->name_students = $val->name_students.' '.$val->last_name_students;
                $val->limit_time = date('d/m/Y',strtotime($val->limit_time));
                if($val->id_homework_course){
                    $val->status = "Entregado";
                }elseif($val->limit_time < date('d/m/Y')){
                    $val->status = "Vencido";
                }else{
                    $val->status = "Pendiente";
                }
                $data[] = $val;
            }
        }
        return json_encode($data);
    }

    public function search_homework($id)
    {
        $tarea = Homework::find($id);
        $archivos = Archives_homework::where('id_homework',$id)->get();

        return $res = ["tarea" => $tarea, "archivos" => $archivos];
    }

    public function search_homework_course($id)
    {
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
        $tareas->id_homework = $request->id_homework;
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
        if(Auth::user()->id_rol == 5){
            $foros = Foro::join('teacher_course','teacher_course.id','foro.id_teacher_course')
                            ->join('course','course.id','teacher_course.id_course')
                            ->join('list_students','list_students.id','course.id_list_students')
                            ->join('users_list_students','users_list_students.id_list_students','list_students.id')
                            ->select('foro.id','list_students.name as course','foro.description as name','foro.date_start','foro.date_end')
                            ->where('users_list_students.id_users',$id_user)
                            ->groupBy('foro.id')
                            ->get();
        }else{
            $foros = Foro::join('teacher_course','teacher_course.id','foro.id_teacher_course')
                            ->join('course','course.id','teacher_course.id_course')
                            ->join('list_students','list_students.id','course.id_list_students')
                            ->select('foro.id','list_students.name as course','foro.description as name','foro.date_start','foro.date_end')
                            ->where('teacher_course.id_users',$id_user)
                            ->groupBy('foro.id')
                            ->get();
        }

        return view('repositorio.index-foro',array('foros'=>$foros));
    }

    public function info_foro($id)
    {
        $contenido = Content_foro::join('users','users.id','content_foro.id_user')
                                ->join('rol','rol.id','users.id_rol')
                                ->leftJoin('users as answer','answer.id','content_foro.answer_to')
                                ->select('users.*', 'content_foro.id as id_content_foro', 'rol.name as rol', 'content_foro.description as content', 'content_foro.id as id_content', 'answer.name as answer_name', 'answer.last_name as answer_last_name', 'answer.id as id_answer', 'users.id as id_users')
                                ->where('id_foro',$id)
                                ->get();
        $archivos = Archives_content_foro::get();


        return view('repositorio.info_foro',array('contenido'=>$contenido, 'archivos'=>$archivos));
    }

    public function info_foro_answer($id)
    {
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

        return redirect('/info_foro/'.$request->id_foro);
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
        $foro = new Foro($request->except('descriptions','document'));
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