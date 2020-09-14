<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Response;


class NotesController
{
    function getNotesView() { return view('notes/notas'); }

    function getStudentsList (Request $request) {
        $nxt = $request->get('nxt');
        $prev = $request->get('prev');
        $search = $request->get('search');
        $course = $request->get('course');

        $notes = DB::table('users')
            ->leftJoin('users_list_students AS ULS', 'ULS.id_users', '=', 'users.id')
            ->leftJoin('list_students AS LS', 'LS.id', '=', 'ULS.id_list_students')
            ->leftJoin('course AS C', 'C.id_list_students', '=', 'LS.id');

        $notesCounter = DB::table('users')
            ->leftJoin('users_list_students AS ULS', 'ULS.id_users', '=', 'users.id')
            ->leftJoin('list_students AS LS', 'LS.id', '=', 'ULS.id_list_students')
            ->leftJoin('course AS C', 'C.id_list_students', '=', 'LS.id');

        if ($search !== '' && $search !== null) {
            $notes = $notes->where('users.name', 'LIKE', '%' . $search . '%');
            $notes = $notes->orWhere('users.last_name', 'LIKE', '%' . $search . '%');
            $notesCounter = $notesCounter->where('users.name', 'LIKE', '%' . $search . '%');
            $notesCounter = $notesCounter->orWhere('users.last_name', 'LIKE', '%' . $search . '%');
        }

        if ($course !== '' && $course !== null) {
            $notes = $notes->where('C.id', $course);
            $notesCounter = $notesCounter->where('C.id', $course);
        }

        if (Auth::user()->id_rol==5) {
            $notes = $notes->select('users.id', 'LS.name AS course', 'users.name', 'last_name')->where('id_rol', 5)->where('users.id',Auth::user()->id)->skip($prev)->take(20)->get();
            $notesCounter = $notesCounter->where('id_rol', 5)->where('users.id',Auth::user()->id)->count();
        }else{
            $notes = $notes->select('users.id', 'LS.name AS course', 'users.name', 'last_name')->where('id_rol', 5)->skip($prev)->take(20)->get();
            $notesCounter = $notesCounter->where('id_rol', 5)->count();
        }

        return [ 'notes' => $notes, 'counter' => $notesCounter ];
    }

    function getStudent(Request $request) {
        $id = $request->get('id');

        $student = DB::table('users')->where('id', $id)->first();

        return [ 's' => $student ];
    }

    function getNotesList(Request $request) {
        $nxt = $request->get('nxt');
        $prev = $request->get('prev');
        $search = $request->get('search');
        $teacher = $request->get('teacher');
        $subject = $request->get('subject');


    }

    function getCourseFilter() {
        $course = DB::table('course')->join('list_students AS LS', 'id_list_students', 'LS.id')->get();
        return [ 'course' => $course ];
    }

    function getTeacherFilter() { $teacher = DB::table('users')->where('id_rol', 4)->get(); return [ 'teacher' => $teacher ]; }
}
