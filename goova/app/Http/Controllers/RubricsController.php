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
        $act = $request->get('act');
        $momtE = $request->get('momtE');
        $obj = $request->get('obj');

        try {
            $rubrics = DB::table('rubrics')
                ->insertGetId([
                    'id_entity' => $idEntity,
                    'name' => $name,
                    'activity' => $act,
                    'moment' => $momtE
                ]);

            foreach ($obj AS $item){
                DB::table('rubrics_range')
                    ->insert([
                        'id_rubrics' => $rubrics,
                        'to_value' => $item['to_value'],
                        'high_text' => $item['high_text'],
                        'medium_text' => $item['med_text'],
                        'low_text' => $item['low_text'],
                        'high_points' => $item['high_points'],
                        'medium_points' => $item['med_points'],
                        'low_points' => $item['low_points'],
                        'status' => 1
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

        $rubrics = DB::table('rubrics')
            ->join('entity AS E', 'E.id', '=', 'id_entity');

        $rubricsCounter = DB::table('rubrics')
            ->join('entity AS E', 'E.id', '=', 'id_entity');

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
        $act = $request->get('act');
        $momtE = $request->get('momtE');
        $fields = $request->get('fields');

        try {
            DB::table('rubrics')->where('id', $id)->update([ 'name' => $name, 'activity' => $act, 'moment' => $momtE ]);
            if(isset($fields)) {
                foreach ($fields as $item) {
                    switch ($item['type']) {
                        case 'i':
                            DB::table('rubrics_range')
                                ->insert([
                                    'id_rubrics' => $id,
                                    'to_value' => $item['to_value'],
                                    'high_text' => $item['high_text'],
                                    'medium_text' => $item['med_text'],
                                    'low_text' => $item['low_text'],
                                    'high_points' => $item['high_points'],
                                    'medium_points' => $item['med_points'],
                                    'low_points' => $item['low_points']
                                ]);
                            break;
                        case 'u':
                        case 'd':
                            $data = ($item['type'] === 'u') ? [
                                'to_value' => $item['to_value'],
                                'high_text' => $item['high_text'],
                                'medium_text' => $item['med_text'],
                                'low_text' => $item['low_text'],
                                'high_points' => $item['high_points'],
                                'medium_points' => $item['med_points'],
                                'low_points' => $item['low_points']
                            ] :
                                ['status' => 0];

                            DB::table('rubrics_range')
                                ->where('id', $item['idE'])
                                ->update($data);
                            break;
                    }

                }
            }
        } catch (QueryException $e){
            return Response::json(['error' => 'Oops! Se detectó un problema, intenta más tarde.'], 500);
        }

        return Response::json(['message' => 'Exito! Se editó el Tema exitosamente!'], 200);
    }
}
