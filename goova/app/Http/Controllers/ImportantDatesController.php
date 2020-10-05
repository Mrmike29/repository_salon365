<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Response;

class ImportantDatesController
{
    public function getImportantDatesView(){

        $dates = DB::table('important_dates')->select('*')->get();

        return view('important-dates/fechas_importantes', ['dates' => $dates]);
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
        $id = $request->get('id');

        $event = DB::table('important_dates')->select('*')->where('id', $id)->first();

        return [ 'event' => $event ];
    }

    function postSaveEvent(Request $request) {
        $idEntity = Auth::user()->id_info_entity;
        $name = $request->get('name');
        $description = $request->get('description');
        $date = $request->get('dateStart') . ' ' . $request->get('timeStart');
        $end = $request->get('dateEnd') . ' ' . $request->get('timeEnd');

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
        $id = $request->get('id');
        $name = $request->get('name');
        $description = $request->get('description');
        $date = $request->get('dateStart') . ' ' . $request->get('timeStart');
        $end = $request->get('dateEnd') . ' ' . $request->get('timeEnd');

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

    function deleteEvent (Request $request) {
        $id = $request->get('id', null);

        if ($id === null) { return Response::json(['error' => 'Oops! Se detectó un problema, intenta más tarde.'], 500); }

        try {
            DB::table('important_dates')->where('id', $id)->delete();
        } catch (QueryException $e) {
            return Response::json(['error' => 'Oops! Se detectó un problema, intenta más tarde.'], 500);
        }

        return Response::json(['success' => true], 200);
    }

}
