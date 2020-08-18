<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;
use App\Teacher_course;
use App\Themes_time;
use App\Rubrics;
use App\Homework;
use App\Archives_homework;
use Auth;
use Mail;
use DateTime;

class RepositorioController extends Controller
{
    public function index_homework()
    {
        $id_user = Auth::user()->id;
        $materias = Homework::join('themes_time','themes_time.id','homework.id_theme_time')
                            ->join('subjects','subjects.id','themes_time.id_subject')
                            ->join('teacher_course','teacher_course.id_course','homework.id_course')
                            ->where('teacher_course.id_users',$id_user)
                            ->select('subjects.id','subjects.name')
                            ->groupBy('subjects.id','subjects.name')
                            ->get();

        return view('repositorio.index-homework',array('materias'=>$materias));
    }

    public function themes_subjects($id)
    {
        $temas = Homework::join('themes_time','themes_time.id','homework.id_theme_time')
                        ->join('subjects','subjects.id','themes_time.id_subject')
                        ->where('subjects.id',$id)
                        ->select('themes_time.id','themes_time.name')
                        ->get();
        
        return $temas;
    }

    public function create_homework()
    {
        $cursos = Course::join('list_students','list_students.id','course.id_list_students')->select('list_students.name','course.id')->get();
        $rubricas = Rubrics::get();

        return view('repositorio.create-homework',array('cursos'=>$cursos, 'rubricas'=>$rubricas));
    }

    public function subjetcs_homework($id)
    {
        $materias = Teacher_course::join('users','users.id','teacher_course.id_users')->join('subjects','subjects.id','teacher_course.id_subjects')->select('teacher_course.id','subjects.name as subjects','users.name as teacher','users.last_name')->where('teacher_course.id_course',$id)->get();

        return $materias;
    }

    public function themes_homework($id, $con)
    {
        $materia = Teacher_course::find($id);
        $temas = Themes_time::where('id_course',$con)->where('id_subject',$materia->id_subjects)->get();

        return $temas;
    }

    public function store_homework(Request $request)
    {
        $remove = '<p data-f-id="pbf" style="text-align: center; font-size: 14px; margin-top: 30px; opacity: 0.65; font-family: sans-serif;">Powered by <a href="https://www.froala.com/wysiwyg-editor?pb=1" title="Froala Editor">Froala Editor</a></p>';

        $tareas = new Homework($request->except(['id_subjects','description','document']));
        $tareas->description = str_replace($remove,'',$request->description);
        $tareas->save();

        foreach ($request->document as $key => $val) {
            $archivos = new Archives_homework();
            $archivos->id_homework = $tareas->id;
            $archivos->description = '/archives/'.$val;
            $archivos->save();
        }

        return redirect('/agregar_tareas');
    }

    public function archivos_store(Request $request)
    {
        $path = public_path().'/archives/';
        $file = $request->file('file');
        $fileName = uniqid().trim($file->getClientOriginalName());
        $file->move($path, $fileName);

        return response()->json([
            'name'          => $fileName,
            'original_name' => $file->getClientOriginalName(),
        ]);
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