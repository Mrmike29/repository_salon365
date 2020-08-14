<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Type_document;
use App\Rol;
use App\Entity;
use App\List_students;
use App\User_list_students;
use App\Course;
use App\Subjects;
use App\Teacher_course;
use Hash;
use Auth;
use Mail;

class CursosController extends Controller
{
    public function index()
    {
        $courses = Course::join('list_students','list_students.id','course.id_list_students')->select('list_students.name','list_students.id as id_list','course.id as id_course')->get();

        return view('cursos.index',array('courses'=>$courses));
    }

    public function create()
    {
        $teachers = User::where('id_rol',4)->get();
        $subjects = Subjects::get();

        return view('cursos.create',array('teachers'=>$teachers,'subjects'=>$subjects));
    }

    public function store(Request $request)
    {
        $list = new List_students();
        $list->name = $request->name;
        $list->save();

        $course = new Course();
        $course->id_list_students = $list->id;
        $course->save();

        if(isset($request->id_subjects) && !empty($request->id_subjects)){
            foreach ($request->id_subjects as $key => $val) {
                $teacher = new Teacher_course();
                $teacher->id_users = $request->id_teacher[$key];
                $teacher->id_subjects = $val;
                $teacher->id_course = $course->id;
                $teacher->save();
            }
        }

        return redirect('/cursos');
    }

    public function edit($id)
    {
        $teachers = User::where('id_rol',4)->get();
        $subjects = Subjects::get();
        $course = Course::join('list_students','list_students.id','course.id_list_students')->select('course.id','list_students.name')->where('course.id',$id)->first();
        $info = Teacher_course::where('id_course',$id)->get();

        return view('cursos.edit',array('teachers'=>$teachers,'subjects'=>$subjects,'course'=>$course,'info'=>$info));
    }

    public function update(Request $request)
    {
        $curso = Course::find($request->id);
        $lista = List_students::find($curso->id_list_students);
        $lista->name = $request->name;
        $lista->update();

        Teacher_course::where('id_course',$request->id)->delete();

        
        if(isset($request->id_subjects) && !empty($request->id_subjects)){
            foreach ($request->id_subjects as $key => $val) {
                $teacher = new Teacher_course();
                $teacher->id_users = $request->id_teacher[$key];
                $teacher->id_subjects = $val;
                $teacher->id_course = $request->id;
                $teacher->save();
            }
        }

        return redirect('/cursos');
    }

    public function view_students($id)
    {
        $students = User_list_students::join('users','users_list_students.id_users','users.id')->select('users.document','users.name','users.last_name')->where('users_list_students.id_list_students',$id)->get();

        if($students->isEmpty()){
            $students = 0;
        }

        return $students;
    }

    public function view_teachers($id)
    {
        $teachers = Teacher_course::join('users','users.id','teacher_course.id_users')->join('subjects','subjects.id','teacher_course.id_subjects')->select('users.document','users.name','users.last_name','subjects.name as subject')->where('teacher_course.id_course',$id)->get();

        if($teachers->isEmpty()){
            $teachers = 0;
        }

        return $teachers;
    }
}