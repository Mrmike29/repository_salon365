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
        $student = $request->get('id_student');

        $exam=DB::table('notes_exam as NE')
            ->join('parcial_notes as PN','PN.id','NE.id_parcial_notes')
            ->join('exam as EXAME','EXAME.id','NE.id_exam')
            ->join('themes_time AS TT', 'TT.id', 'EXAME.id_theme_time')
            ->join('subjects AS S', 'S.id', 'TT.id_subject')
            ->join('users AS UT', 'UT.id', 'NE.id_teacher');
            

        $homework=DB::table('notes_homework as NH')
            ->join('homework as HW','HW.id','NH.id_homework')
            ->join('parcial_notes as PN','PN.id','NH.id_parcial_notes')
            ->join('themes_time AS TT', 'TT.id', 'HW.id_theme_time')
            ->join('subjects AS S', 'S.id', 'TT.id_subject')
            ->join('users AS UT', 'UT.id', 'NH.id_teacher');
            
        if ($search !== '' && $search !== null) {
            $exam = $exam->where('UT.name', 'LIKE', '%' . $search . '%');
            // $exam = $exam->orWhere(DB::raw("CONCAT('UT.name', ' ', 'UT.last_name')"), 'LIKE', '%' . $search . '%');
            $exam = $exam->orWhere('UT.last_name', 'LIKE', '%' . $search . '%');
            $exam = $exam->orWhere('S.name', 'LIKE', '%' . $search . '%');
            $exam = $exam->orWhere('TT.name', 'LIKE', '%' . $search . '%');

            $homework = $homework->where('UT.name', 'LIKE', '%' . $search . '%');
            // $homework = $homework->orWhere(DB::raw("CONCAT('UT.name', ' ', 'UT.last_name')"), 'LIKE', '%' . $search . '%');
            $homework = $homework->orWhere('UT.last_name', 'LIKE', '%' . $search . '%');
            $homework = $homework->orWhere('S.name', 'LIKE', '%' . $search . '%');
            $homework = $homework->orWhere('TT.name', 'LIKE', '%' . $search . '%');
           
        }

        if ($teacher !== '' && $teacher !== null) {
            $exam = $exam->where('UT.id', $teacher);
            $homework = $homework->where('UT.id', $teacher);
        }

        if ($subject !== '' && $subject !== null) {
            $exam = $exam->where('S.id', $subject);
            $homework = $homework->where('S.id', $subject);
        }

        $exam=$exam->where('NE.id_student', $student)
            ->select(
                'S.name AS subject_name',
                'UT.name AS teacher_name',
                'UT.last_name AS teacher_lastname',
                'TT.name AS work',
                'PN.value'
            );
        $homeworkCounter=$homework->where('NH.id_student', $student)
        ->select(
            'S.name AS subject_name',
            'UT.name AS teacher_name',
            'UT.last_name AS teacher_lastname',
            'TT.name AS work',
            'PN.value'
        )
        ->union($exam)
        ->count();

        $homework=$homework->where('NH.id_student', $student)
        ->select(
            'S.name AS subject_name',
            'UT.name AS teacher_name',
            'UT.last_name AS teacher_lastname',
            'TT.name AS work',
            'PN.value'
        )
        ->union($exam)
        ->skip($prev)
        ->take(20)
        ->get();
        return compact('homework','homeworkCounter');

    }

    function getCourseFilter() {
        $course = DB::table('course')->join('list_students AS LS', 'id_list_students', 'LS.id')->get();
        return [ 'course' => $course ];
    }

    function getTeacherFilter() { $teacher = DB::table('users')->where('id_rol', 4)->get(); return [ 'teacher' => $teacher ]; }
}

