<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Response;

class TimesController
{

    function postSaveTime(Request $request){
        $idEntity = Auth::user()->id_info_entity;
        $name = $request->get('name');
        $date = $request->get('dateStart');
        $end = $request->get('dateEnd');
        $duration = $request->get('duration');

        try {
        $time = DB::table('times')
            ->insert([
                'id_entity' => $idEntity,
                'name' => $name,
                'time_start' => $date,
                'time_end' => $end,
                'duration' => $duration
            ]);
        } catch (QueryException $e){
            return Response::json(['error' => 'Oops! Se detectó un problema, intenta más tarde.'], 500);
        }

        return Response::json(['message' => 'Exito! Se creó el Ciclo/Periodo exitosamente!'], 200);
    }

    function getTimesList (Request $request){
        $nxt = $request->get('nxt');
        $prev = $request->get('prev');
        $search = $request->get('search');
        $idEntity = Auth::user()->id_info_entity;

        $times = DB::table('times');
        $timesCounter = DB::table('times');
        if ($search !== '' && $search !== null) {
            $times = $times->where('times.name', 'LIKE', '%' . $search . '%');
            $timesCounter = $timesCounter->where('times.name', 'LIKE', '%' . $search . '%');
        }

        $times = $times->select('*')->skip($prev)->take(20)->get();
        $timesCounter = $timesCounter->count();

        return [ 'times' => $times, 'counter' => $timesCounter ];
    }

    function getTime (Request $request) {
        $id = $request->get('id', null);

        if ($id === null) { return Response::json(['error' => 'Oops! Se detectó un problema, intenta más tarde.'], 500); }

        $time = DB::table('times')->where('id', $id)->first();

        return [ 'time' => $time ];
    }

    function putEditTime (Request $request) {
        $id = $request->get('id', null);
        $name = $request->get('name');
        $date = $request->get('dateStart');
        $end = $request->get('dateEnd');
        $duration = $request->get('duration');

        if ($id === null) { return Response::json(['error' => 'Oops! Se detectó un problema, intenta más tarde.'], 500); }

        try {
            DB::table('times')->where('id', $id)
                ->update([
                    'name' => $name,
                    'time_start' => $date,
                    'time_end' => $end,
                    'duration' => $duration
                ]);
        } catch (QueryException $e) {
            return Response::json(['error' => 'Oops! Se detectó un problema, intenta más tarde.'], 500);
        }

        return Response::json(['success' => true], 200);
    }

    function deleteTime (Request $request){
        $id = $request->get('id', null);

        if ($id === null) { return Response::json(['error' => 'Oops! Se detectó un problema, intenta más tarde.'], 500); }

        try {
            $r = DB::table('times AS T')
                ->join('themes_time AS TT', 'TT.id_time', 'T.id')
                ->where('T.id', $id)
                ->get();

            if(count($r) > 0) { return Response::json(['error' => 'Esta acción no se puede realizar.'], 500); }

            DB::table('times')->where('id', $id)->delete();
        } catch (QueryException $e) {
            return Response::json(['error' => 'Oops! Se detectó un problema, intenta más tarde.'], 500);
        }

        return Response::json(['success' => true], 200);
    }
}
