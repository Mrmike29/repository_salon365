<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Response;

class BulletinController
{
    /** Cursos */
    function getCursosBoletinesView () { return view('bulletin/courses-bulletin'); }

    function getStudentsBulletin (Request $request) {
        $prev = $request->get('prev');
        $search = $request->get('search');
        $course = $request->get('course');

        $students = DB::table('users AS U')
            ->join('users_list_students AS ULS', 'ULS.id_users', 'U.id')
            ->join('list_students AS LS', 'LS.id', 'ULS.id_list_students')
            ->join('course AS C', 'C.id_list_students', 'LS.id')
            ->join('teacher_course AS TC', 'TC.id_course', 'C.id')
            ->where('TC.id_users', Auth::user()->id)
            ->groupBy('U.id');

        $studentsC = DB::table('users AS U')
            ->join('users_list_students AS ULS', 'ULS.id_users', 'U.id')
            ->join('list_students AS LS', 'LS.id', 'ULS.id_list_students')
            ->join('course AS C', 'C.id_list_students', 'LS.id')
            ->join('teacher_course AS TC', 'TC.id_course', 'C.id')
            ->where('TC.id_users', Auth::user()->id)
            ->groupBy('U.id');

        if ($search !== '' && $search !== null) {
            $students = $students->where('U.name', 'LIKE', '%' . $search . '%');
            $studentsC = $studentsC->where('U.name', 'LIKE', '%' . $search . '%');
        }

        if ($course !== '' && $course !== null) {
            $students = $students->where('C.id', $course);
            $studentsC = $studentsC->where('C.id', $course);
        }

        $students = $students->select('U.id', 'U.name', 'U.last_name', 'LS.name AS course')->skip($prev)->take(20)->get();
        $studentsC = $studentsC->count();

        return [ 'students' => $students, 'counter' => $studentsC ];
    }

    function getStudentToReport (Request $request) {
        $id = $request->get('id', null);

        if ($id === null) { return Response::json(['error' => 'Oops! Se detectó un problema, intenta más tarde.'], 500); }

        $student = DB::table('users')->where('id', $id)->first();

        $periods = DB::table('times')->get();

        return ['student' => $student, 'periods' => $periods];
    }

    function getReportsStudent (Request $request) {
        $id = $request->get('id', null);
        $period = $request->get('period', null);

        if ($id === null || $period === null) { return Response::json(['error' => 'Oops! Se detectó un problema, intenta más tarde.'], 500); }

        $reports = [];

        $subjectsStudent = DB::table('users AS U')
            ->join('users_list_students AS ULS', 'ULS.id_users', 'U.id')
            ->join('list_students AS LS', 'LS.id', 'ULS.id_list_students')
            ->join('course AS C', 'C.id_list_students', 'LS.id')
            ->join('teacher_course AS TC', 'TC.id_course', 'C.id')
            ->join('subjects AS S', 'S.id', 'TC.id_subjects')
            ->where('TC.id_users', Auth::user()->id)
            ->where('U.id', $id)
            ->select('S.id', 'S.name AS subject')
            ->groupBy('S.id')
            ->get();

        foreach ($subjectsStudent AS $item) {
            $reports[$item->id] = DB::table('period_report_subject AS PRS')
                ->where('PRS.id_student', $id)
                ->where('PRS.id_subject', $item->id)
                ->where('PRS.id_time', $period)
                ->select('id', 'cognitive_observation', 'personal_observation', 'social_observation')
                ->first();
        }

        return [ 'subjects' => $subjectsStudent, 'reports' => $reports ];
    }

    function postSaveReport (Request $request) {
        $student = $request->get('student');
        $subject = $request->get('subject');
        $time = $request->get('time');
        $cognitivePerformance = $request->get('cognitivePerformance', '');
        $personalPerformance = $request->get('personalPerformance', '');
        $socialPerformance = $request->get('socialPerformance', '');

        if ($student === null || $subject === null || $time === null) { return Response::json(['error' => 'Oops! Se detectó un problema, intenta más tarde.'], 500); }

        try {
            $i = DB::table('period_report_subject')->insertGetId([
                'id_student' => $student,
                'id_teacher' => Auth::user()->id,
                'id_subject' => $subject,
                'id_time' => $time,
                'cognitive_observation' => $cognitivePerformance,
                'personal_observation' => $personalPerformance,
                'social_observation' => $socialPerformance
            ]);
        } catch (QueryException $e){
            return Response::json(['error' => 'Oops! Se detectó un problema, intenta más tarde.'], 500);
        }

        return Response::json(['message' => 'Exito.', 'data' => $i], 200);
    }

    function putSaveReport (Request $request) {
        $id = $request->get('id', null);
        $cognitivePerformance = $request->get('cognitivePerformance', '');
        $personalPerformance = $request->get('personalPerformance', '');
        $socialPerformance = $request->get('socialPerformance', '');

        if ($id === null) { return Response::json(['error' => 'Oops! Se detectó un problema, intenta más tarde.'], 500); }

        try {
            DB::table('period_report_subject')
                ->where('id', $id)
                ->update([
                    'cognitive_observation' => $cognitivePerformance,
                    'personal_observation' => $personalPerformance,
                    'social_observation' => $socialPerformance
                ]);
        } catch (QueryException $e){
            return Response::json(['error' => 'Oops! Se detectó un problema, intenta más tarde.'], 500);
        }

        return Response::json(['message' => 'Exito.'], 200);
    }

    /** Mis Cursos */
    function getMisCursosView () { return view('bulletin/my-courses-bulletin'); }

    function getMyStudentsBulletin (Request $request) {
        $prev = $request->get('prev');
        $search = $request->get('search');
        $course = $request->get('course');

        $students = DB::table('users AS U')
            ->join('users_list_students AS ULS', 'ULS.id_users', 'U.id')
            ->join('list_students AS LS', 'LS.id', 'ULS.id_list_students')
            ->join('course AS C', 'C.id_list_students', 'LS.id')
            ->where('C.id_leader_group', Auth::user()->id);

        $studentsC = DB::table('users AS U')
            ->join('users_list_students AS ULS', 'ULS.id_users', 'U.id')
            ->join('list_students AS LS', 'LS.id', 'ULS.id_list_students')
            ->join('course AS C', 'C.id_list_students', 'LS.id')
            ->where('C.id_leader_group', Auth::user()->id);

        if ($search !== '' && $search !== null) {
            $students = $students->where('U.name', 'LIKE', '%' . $search . '%');
            $studentsC = $studentsC->where('U.name', 'LIKE', '%' . $search . '%');
        }

        if ($course !== '' && $course !== null) {
            $students = $students->where('C.id', $course);
            $studentsC = $studentsC->where('C.id', $course);
        }

        $students = $students->select('U.id', 'U.name', 'U.last_name', 'LS.name AS course')->skip($prev)->take(20)->get();
        $studentsC = $studentsC->count();

        return [ 'students' => $students, 'counter' => $studentsC ];
    }

    function getReportsMyStudent (Request $request) {
        $id = $request->get('id', null);
        $period = $request->get('period', null);

        if ($id === null || $period === null) { return Response::json(['error' => 'Oops! Se detectó un problema, intenta más tarde.'], 500); }

        $reports = DB::table('period_report_student AS PRS')
            ->where('PRS.id_student', $id)
            ->where('PRS.id_time', $period)
            ->select('id', 'observation')
            ->first();

        return [ 'reports' => $reports ];
    }

    function postSaveGeneralReport (Request $request) {
        $student = $request->get('student');
        $time = $request->get('time');
        $generalObservation = $request->get('generalObservation', '');

        if ($student === null || $time === null) { return Response::json(['error' => 'Oops! Se detectó un problema, intenta más tarde.'], 500); }

        try {
            $i = DB::table('period_report_student')->insertGetId([
                'id_student' => $student,
                'id_teacher' => Auth::user()->id,
                'id_time' => $time,
                'observation' => $generalObservation
            ]);
        } catch (QueryException $e){
            return Response::json(['error' => 'Oops! Se detectó un problema, intenta más tarde.'], 500);
        }

        return Response::json(['message' => 'Exito.', 'data' => $i], 200);
    }

    function putSaveGeneralReport (Request $request) {
        $id = $request->get('id', null);
        $generalObservation = $request->get('generalObservation', '');

        if ($id === null) { return Response::json(['error' => 'Oops! Se detectó un problema, intenta más tarde.'], 500); }

        try {
            DB::table('period_report_student')
                ->where('id', $id)
                ->update([ 'observation' => $generalObservation ]);
        } catch (QueryException $e){
            return Response::json(['error' => 'Oops! Se detectó un problema, intenta más tarde.'], 500);
        }

        return Response::json(['message' => 'Exito.'], 200);
    }

    /** Consultar Boletines */
    function getConsultarBoletinesView () { return view('bulletin/list-bulletin'); }

    function getListStudentsBulletin (Request $request) {
        $prev = $request->get('prev');
        $search = $request->get('search');
        $course = $request->get('course');

        $students = DB::table('users AS U')
            ->join('users_list_students AS ULS', 'ULS.id_users', 'U.id')
            ->join('list_students AS LS', 'LS.id', 'ULS.id_list_students')
            ->join('course AS C', 'C.id_list_students', 'LS.id')
            ->join('teacher_course AS TC', 'TC.id_course', 'C.id')
            ->groupBy('U.id');

        $studentsC = DB::table('users AS U')
            ->join('users_list_students AS ULS', 'ULS.id_users', 'U.id')
            ->join('list_students AS LS', 'LS.id', 'ULS.id_list_students')
            ->join('course AS C', 'C.id_list_students', 'LS.id')
            ->join('teacher_course AS TC', 'TC.id_course', 'C.id')
            ->where('TC.id_users', Auth::user()->id)
            ->groupBy('U.id');

        if ($search !== '' && $search !== null) {
            $students = $students->where('U.name', 'LIKE', '%' . $search . '%');
            $studentsC = $studentsC->where('U.name', 'LIKE', '%' . $search . '%');
        }

        if ($course !== '' && $course !== null) {
            $students = $students->where('C.id', $course);
            $studentsC = $studentsC->where('C.id', $course);
        }

        $students = $students->select('U.id', 'U.name', 'U.last_name', 'LS.name AS course')->skip($prev)->take(20)->get();
        $studentsC = $studentsC->count();

        return [ 'students' => $students, 'counter' => $studentsC ];
    }
}
