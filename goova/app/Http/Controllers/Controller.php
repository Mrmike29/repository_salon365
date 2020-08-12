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

//        if(Auth::user()['id_role'] == 1){
//            $events = DB::table('eventos')
//                ->select('eventos.*')
//                ->get();
//        }elseif(Auth::user()['id_role'] == 2){
//            $events = DB::table('eventos')
//                ->select('eventos.*')
//                ->join('gerencias AS G', 'G.id', 'id_gerencia')
//                ->join('users AS U', 'U.id', 'G.id_user')
//                ->where('U.id', $id)
//                ->get();
//        }elseif(Auth::user()['id_role'] == 3) {
//            $events = DB::table('eventos')
//                ->select('eventos.id', 'eventos.nombre', 'eventos.descripcion', 'eventos.fecha_realizar', 'UE.id_user AS id_user', 'UE.id AS UE_id')
//                ->join('users_eventos AS UE', 'UE.id_evento', 'eventos.id')
//                ->where('UE.id_user', $id)
//                ->get();
//        }

        return view('fechas_importantes', ['dates' => $dates]);
    }

    function getPendingEvents(){
        $idEntity = Auth::user()->id_info_entity;

        $dates = DB::table('important_dates')
            ->where('id_entity', $idEntity)
            ->where('date', '>', date('Y-m-d H:i:s'))
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
        $date = $request->date;

        $event = DB::table('important_dates')->where('id', $id)->update(['name' => $name, 'description' => $description, 'date' => $date]);
    }
}
