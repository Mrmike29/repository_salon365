<?php


namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class TimesController
{

    function postSaveTime(Request $request){
        $idEntity = Auth::user()->id_info_entity;
        $name = $request->get('name');
        $date = $request->get('dateStart');
        $end = $request->get('dateEnd');
        $duration = $request->get('duration');

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
