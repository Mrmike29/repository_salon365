<?php


namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ThemesController {
    function getThemesView() { return view('themes/temas'); }

    function getSubjectFilter() { $subjects = DB::table('subjects')->get(); return [ 'subjects' => $subjects ]; }

    function getTimesFilter() { $times = DB::table('times')->get(); return [ 'times' => $times ]; }

    function getDataCreateTheme() {
        $idEntity = Auth::user()->id_info_entity;

        $subjects = DB::table('subjects')->select('*')->get();
        $times = DB::table('times')->where('id_entity', $idEntity)->select('*')->get();
        $courses = DB::table('course')
            ->join('list_students AS LS', 'LS.id', '=', 'id_list_students')
            ->where('id_entity', $idEntity)
            ->select('course.id', 'LS.name')
            ->get();

        return [
            'subjects' => $subjects,
            'courses' => $courses,
            'times' => $times
        ];

    }

    function postSaveTheme(Request $request){
        $time = $request->get('time');
        $name = $request->get('name');
        $exam = $request->get('exam');
        $course = $request->get('course');
        $subject = $request->get('subject');
        $homework = $request->get('homework');
        $description = $request->get('description');

        $themes = DB::table('themes_time')
            ->insert([
                'id_subject' => $subject,
                'id_course' => $course,
                'id_time' => $time,
                'name' => $name,
                'description' => $description,
                'homework_percentage' => $homework,
                'exam_percentage' => $exam
            ]);
    }

    function getThemesList (Request $request) {
        $nxt = $request->get('nxt');
        $prev = $request->get('prev');
        $time = $request->get('time');
        $search = $request->get('search');
        $subject = $request->get('subject');

        $themes = DB::table('themes_time')
            ->join('times AS T', 'T.id', '=', 'id_time')
            ->join('entity AS E', 'E.id', '=', 'T.id_entity')
            ->join('course AS C', 'C.id', '=', 'id_course')
            ->join('list_students AS LS', 'LS.id', '=', 'C.id_list_students')
            ->join('subjects AS S', 'S.id', '=', 'id_subject');

        $themesCounter = DB::table('themes_time')
            ->join('times AS T', 'T.id', '=', 'id_time')
            ->join('entity AS E', 'E.id', '=', 'T.id_entity')
            ->join('course AS C', 'C.id', '=', 'id_course')
            ->join('list_students AS LS', 'LS.id', '=', 'C.id_list_students')
            ->join('subjects AS S', 'S.id', '=', 'id_subject');


        if ($search !== '' && $search !== null) {
            $themes = $themes->where('themes_time.name', 'LIKE', '%' . $search . '%');
            $themesCounter = $themesCounter->where('themes_time.name', 'LIKE', '%' . $search . '%');
        }

        if ($subject !== '' && $subject !== null) {
            $themes = $themes->where('themes_time.id_subject', $subject);
            $themesCounter = $themesCounter->where('themes_time.id_subject', $subject);
        }

        if ($time !== '' && $time !== null) {
            $themes = $themes->where('themes_time.id_time', $time);
            $themesCounter = $themesCounter->where('themes_time.id_time', $time);
        }

        $themes = $themes->select('themes_time.*', 'E.name AS entity', 'T.name AS time', 'LS.name AS course', 'S.name AS subject')->skip($prev)->take(20)->get();
        $themesCounter = $themesCounter->count();

        return [ 'themes' => $themes, 'counter' => $themesCounter ];
    }

    function getDataEditTheme(Request $request) {
        $idEntity = Auth::user()->id_info_entity;
        $id = $request->get('id');

        $subjects = DB::table('subjects')->select('*')->get();
        $times = DB::table('times')->where('id_entity', $idEntity)->select('*')->get();
        $courses = DB::table('course')
            ->join('list_students AS LS', 'LS.id', '=', 'id_list_students')
            ->where('id_entity', $idEntity)
            ->select('course.id', 'LS.name')
            ->get();

        $theme = DB::table('themes_time')->where('id', $id)->select('*')->first();

        return [
            'subjects' => $subjects,
            'courses' => $courses,
            'times' => $times,
            'theme' => $theme
        ];

    }

    function putEditTheme(Request $request) {
        $id = $request->get('id');
        $time = $request->get('time');
        $name = $request->get('name');
        $exam = $request->get('exam');
        $course = $request->get('course');
        $subject = $request->get('subject');
        $homework = $request->get('homework');
        $description = $request->get('description');

        $theme = DB::table('themes_time')
            ->where('id', $id)
            ->update([
                'id_subject' => $subject,
                'id_course' => $course,
                'id_time' => $time,
                'name' => $name,
                'description' => $description,
                'homework_percentage' => $homework,
                'exam_percentage' => $exam
            ]);

        return [ 'theme' => $theme ];
    }
}
