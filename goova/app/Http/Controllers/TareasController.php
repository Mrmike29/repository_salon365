<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;
use App\Teacher_course;
use Auth;
use Mail;

class TareasController extends Controller
{
    public function create_homework()
    {
        $cursos = Course::join('list_students','list_students.id','course.id_list_students')->select('list_students.name','course.id')->get();

        return view('repositorio.create-homework',array('cursos'=>$cursos));
    }

    public function subjetcs_homework($id)
    {
        $materias = Teacher_course::join('users','users.id','teacher_course.id_users')->join('subjects','subjects.id','teacher_course.id_subjects')->select('teacher_course.id','subjects.name as subjects','users.name as teacher','users.last_name')->where('teacher_course.id_course',$id)->get();

        return $materias;
    }

    public function archivos_store(Request $request)
    {
        $path = public_path().'/archives/';
        $files = $request->file('file');
        foreach($files as $file){
            $fileName = $file->getClientOriginalName();
            $file->move($path, $fileName);
        }
    }
}