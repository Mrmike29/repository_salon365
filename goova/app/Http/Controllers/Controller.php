<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function getImportantDatesView(){

        $dates = DB::table('important_dates')->select('*')->get();

        return view('fechas_importantes', ['dates' => $dates]);
    }

    function getPendingEvents(){
        $idEntity = Auth::user()->id_info_entity;

        $dates = DB::table('important_dates')
            ->where('id_entity', $idEntity)
            ->where('end', '>', date('Y-m-d H:i:s'))
            ->select('*')
            ->get();

        return [ 'dates' => $dates ];
    }

    function getHeldEvents(){
        $idEntity = Auth::user()->id_info_entity;

        $dates = DB::table('important_dates')
            ->where('id_entity', $idEntity)
            ->where('end', '<', date('Y-m-d H:i:s'))
            ->select('*')
            ->get();

        return [ 'dates' => $dates ];
    }

    function getEvent(Request $request){
        $id = $request->id;

        $event = DB::table('important_dates')->select('*')->where('id', $id)->first();

        return [ 'event' => $event ];
    }

    function postSaveEvent(Request $request) {
        $idEntity = Auth::user()->id_info_entity;
        $name = $request->name;
        $description = $request->description;
        $date = $request->dateStart . ' ' . $request->timeStart;
        $end = $request->dateEnd . ' ' . $request->timeEnd;

        $event = DB::table('important_dates')
            ->insert([
                'id_entity' => $idEntity,
                'name' => $name,
                'description' => $description,
                'date' => $date,
                'end' => $end
            ]);
    }

    function putEditEvent(Request $request){
        $id = $request->id;
        $name = $request->name;
        $description = $request->description;
        $date = $request->dateStart . ' ' . $request->timeStart;
        $end = $request->dateEnd . ' ' . $request->timeEnd;

        $event = DB::table('important_dates')
            ->where('id', $id)
            ->update([
                'name' => $name,
                'description' => $description,
                'date' => $date,
                'end' => $end
            ]);
    }

    function getCalendarEvents(Request $request) {
        $idEntity = Auth::user()->id_info_entity;

        $dates = DB::table('important_dates')
            ->where('id_entity', $idEntity)
            ->select('id', 'name AS title', 'date AS start', 'end', 'description')
            ->get();

        return [ 'dates' => $dates ];
    }
}
