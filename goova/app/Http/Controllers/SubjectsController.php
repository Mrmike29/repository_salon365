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
use App\Areas;
use App\Teacher_course;
use Hash;
use Auth;
use Mail;

class SubjectsController extends Controller
{
    public function index()
    {
        $subjects = Subjects::get();
        $areas = Areas::get();

        return view('asignaturas.index',array('subjects'=>$subjects, 'areas'=>$areas));
    }

    public function view_subjects()
    {
        $data = [];
        $subjects = Subjects::join('areas','areas.id','subjects.id_area')
                            ->select('subjects.name','subjects.id','areas.name as name_areas')
                            ->get();

        foreach ($subjects as $key => $val) {
            $data[] = $val;
        }

        return json_encode($data);
    }

    public function create()
    {
        $teachers = User::where('id_rol',4)->get();
        $subjects = Subjects::get();

        return view('cursos.create',array('teachers'=>$teachers,'subjects'=>$subjects));
    }

    public function store(Request $request)
    {
        $subject = new Subjects($request->all());
        $subject->save();

        return $request->name;
    }

    public function edit($id)
    {
        $subject = Subjects::find($id);

        return $subject;
    }

    public function update(Request $request)
    {
        $subject = Subjects::find($request->id);
        $subject->update($request->all());

        return $request->name;
    }
}