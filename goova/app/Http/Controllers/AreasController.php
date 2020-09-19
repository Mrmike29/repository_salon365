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

class AreasController extends Controller
{
    public function index()
    {
        $areas = Areas::get();

        return view('areas.index',array('areas'=>$areas));
    }

    public function view_areas()
    {
        $data = [];
        $areas = Areas::get();

        foreach ($areas as $key => $val) {
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
        $area = new Areas();
        $area->name = $request->name;
        $area->save();

        return $request->name;
    }

    public function edit($id)
    {
        $area = Areas::find($id);

        return $area;
    }

    public function update(Request $request)
    {
        $area = Areas::find($request->id);
        $area->name = $request->name;
        $area->update();

        return $request->name;
    }
}