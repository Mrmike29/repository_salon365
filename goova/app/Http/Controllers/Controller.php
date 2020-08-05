<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function getImportantDatesView(){

//        if(Auth::user() == null){ return abort(403, 'Accion no autorizada');}
//        if(Auth::user()->id_role != 1 && Auth::user()->id_role != 2){ return abort(403, 'Accion no autorizada'); }

//        $id = Auth::user()->id;

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

    function getEvent(Request $request){
        $id = $request->id;

        $event = DB::table('important_dates')->select('*')->where('id', $id)->first();

        return [ 'event' => $event ];
    }

    function putEditEvent(Request $request){
        $id = $request->id;
        $name = $request->name;
        $description = $request->description;
        $date = $request->date;

        $event = DB::table('important_dates')->where('id', $id)->update(['name' => $name, 'description' => $description, 'date' => $date]);
    }
}
