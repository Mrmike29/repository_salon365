<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Response;
use phpDocumentor\Reflection\Type;

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
            return Response::json(['error' => 'Oops! Se detectó un problema, intenta más tarde.'], 500);
        }

        return Response::json(['message' => 'Exito! Se creó el Tema exitosamente!'], 200);
    }

    function getRubricsList (Request $request) {
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
            $rubricRules = DB::table('rubrics_range')->where('id_rubrics', $id)->where('status', 1)->get();
        } catch (QueryException $e){
            return Response::json(['error' => 'Oops! Se detectó un problema, intenta más tarde.'], 500);
        }

        return [ 'rubric' => $rubric, 'rubricRules' => $rubricRules ];
    }

    function getRuleRubric (Request $request) {
        $id = $request->get('idE');

        try {
            $rule = DB::table('rubrics_range')->where('id', $id)->first();
        } catch (QueryException $e){
            return Response::json(['error' => 'Oops! Se detectó un problema, intenta más tarde.'], 500);
        }

        return [ 'rule' => $rule ];
    }

    function putSaveEditedRubric (Request $request) {
        $id = $request->get('id');
        $name = $request->get('name');
        $fields = $request->get('fields');

        try {
            DB::table('rubrics')->where('id', $id)->update([ 'name' => $name ]);

            foreach ($fields AS $item){
                switch ($item['type']) {
                    case 'i':
                        DB::table('rubrics_range')
                            ->insert([
                                'id_rubrics' => $id,
                                'description' => $item['desc'],
                                'score' => $item['val']
                            ]);
                        break;
                    case 'u':
                    case 'd':
                        $data = ($item['type'] === 'u')? [ 'description' => $item['desc'], 'score' => $item['val'] ] : ['status' => 0];

                        DB::table('rubrics_range')
                            ->where('id', $item['idE'])
                            ->update($data);
                        break;
                }

            }
        } catch (QueryException $e){
            return Response::json(['error' => 'Oops! Se detectó un problema, intenta más tarde.'], 500);
        }

        return Response::json(['message' => 'Exito! Se editó el Tema exitosamente!'], 200);
    }
}
