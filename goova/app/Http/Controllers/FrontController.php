<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Response;

class FrontController
{
    function getEntities(Request $request) {
        $s = $request->get('s');

        try {
            $entities = DB::table('entity');
            if ($s !== '' && $s !== null) {
                $entities = $entities->orWhere('name', 'LIKE', '%' . $s . '%');
            }
            $entities = $entities->get();
        } catch (QueryException $e){
            return Response::json(['error' => 'Estamos presentando problemas.'], 500);
        }

        return Response::json(['entities' => $entities], 200);
    }

    function getEC(){
        $e = DB::table('entity')->select('color')->first();
        return Response::json(['e' => $e], 200);
    }
}
