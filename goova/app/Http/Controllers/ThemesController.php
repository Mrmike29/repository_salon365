<?php


namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ThemesController
{
    function postSaveTheme(Request $request){
        $subject = $request->subject;
        $course = $request->course;
        $time = $request->time;
        $name = $request->name;
        $description = $request->description;

        $themes = DB::table('themes_time')
            ->insert([
                'id_subject' => $subject,
                'id_course' => $course,
                'id_time' => $time,
                'name' => $name,
                'description' => $description
            ]);
    }

    function getThemesList (Request $request){
        $idEntity = Auth::user()->id_info_entity;

        $themes = DB::table('themes_time')->select('*')->get();

        return [ 'themes' => $themes ];
    }
}