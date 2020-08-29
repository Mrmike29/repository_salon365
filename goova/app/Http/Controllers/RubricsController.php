<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Response;

class RubricsController
{

    function postSaveRubric (Request $request) {
        $idEntity = Auth::user()->id_info_entity;
        $name = $request->get('name');
        $obj = $request->get('obj');

        try {
            $rubrics = DB::table('rubrics')
                ->insertGetId([
                    'id_entity' => $idEntity,
                    'name' => $name
                ]);

            foreach ($obj AS $item){
                DB::table('rubrics_range')
                    ->insert([
                        'id_rubrics' => $rubrics,
                        'description' => $item['desc'],
                        'score' => $item['value']
                    ]);
            }
        } catch (QueryException $e){
            return Response::json(['error' => 'Oops! Se detectó un problema, intenta más tarde.'], 404);
        }

        return Response::json(['message' => 'Exito! Se creó el Tema exitosamente!'], 200);
    }

    function getRubricsList (Request $request){
        $nxt = $request->get('nxt');
        $prev = $request->get('prev');
        $search = $request->get('search');
        $idEntity = Auth::user()->id_info_entity;

        $rubrics = DB::table('rubrics')
            ->join('entity AS E', 'E.id', '=', 'id_entity')
            ->where('id_entity', $idEntity);

        $rubricsCounter = DB::table('rubrics')
            ->join('entity AS E', 'E.id', '=', 'id_entity')
            ->where('id_entity', $idEntity);

        if ($search !== '' && $search !== null) {
            $rubrics = $rubrics->where('rubrics.name', 'LIKE', '%' . $search . '%');
            $rubricsCounter = $rubricsCounter->where('rubrics.name', 'LIKE', '%' . $search . '%');
            if(Auth::user()->id_rol == 1){
                $rubrics = $rubrics->orWhere('entity', 'LIKE', '%' . $search . '%');
                $rubricsCounter = $rubricsCounter->orWhere('entity', 'LIKE', '%' . $search . '%');
            }
        }

        $rubrics = $rubrics->select('rubrics.*', 'E.name AS entity')->skip($prev)->take(20)->get();
        $rubricsCounter = $rubricsCounter->count();

        return [ 'rubrics' => $rubrics, 'counter' => $rubricsCounter ];
    }

    function getDataEditRubric (Request $request) {
        $id = $request->get('id');

        try {
            $rubric = DB::table('rubrics')->where('id', $id)->first();
            $rubricRules = DB::table('rubrics_range')->where('id_rubrics', $id)->get();
        } catch (QueryException $e){
            return Response::json(['error' => 'Oops! Se detectó un problema, intenta más tarde.'], 404);
        }

        return [ 'rubric' => $rubric, 'rubricRules' => $rubricRules ];
    }
}
