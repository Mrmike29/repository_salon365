<?php


namespace App\Http\Controllers;


use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class TimesController
{

    function postSaveTime(Request $request){
        $idEntity = Auth::user()->id_info_entity;
        $name = $request->name;
        $date = $request->dateStart;
        $end = $request->dateEnd;
        $duration = $request->duration;

        $time = DB::table('times')
            ->insert([
                'id_entity' => $idEntity,
                'name' => $name,
                'time_start' => $date,
                'time_end' => $end,
                'duration' => $duration
            ]);
    }

    function getTimesList (Request $request){
        $idEntity = Auth::user()->id_info_entity;

        $times = DB::table('times')->where('id_entity', $idEntity)->select('*')->get();

        return [ 'times' => $times ];
    }
}