<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Response;

class ReportsController
{

    function getAnualReport() { return view('reports/reporte_anual'); }
    function getPeriodReport() { return view('reports/reporte_periodo'); }

    function getReports(Request $request) {
        $nxt = $request->get('nxt');
        $prev = $request->get('prev');
        $search = $request->get('search');
        $course = $request->get('course');

        $notes = DB::table('users')
            ->leftJoin('users_list_students AS ULS', 'ULS.id_users', '=', 'users.id')
            ->leftJoin('list_students AS LS', 'LS.id', '=', 'ULS.id_list_students')
            ->leftJoin('course AS C', 'C.id_list_students', '=', 'LS.id');

        $notesCounter = DB::table('users')
            ->leftJoin('users_list_students AS ULS', 'ULS.id_users', '=', 'users.id')
            ->leftJoin('list_students AS LS', 'LS.id', '=', 'ULS.id_list_students')
            ->leftJoin('course AS C', 'C.id_list_students', '=', 'LS.id');

        if ($search !== '' && $search !== null) {
            $notes = $notes->where('users.name', 'LIKE', '%' . $search . '%');
            $notes = $notes->orWhere('users.last_name', 'LIKE', '%' . $search . '%');
            $notesCounter = $notesCounter->where('users.name', 'LIKE', '%' . $search . '%');
            $notesCounter = $notesCounter->orWhere('users.last_name', 'LIKE', '%' . $search . '%');
        }

        if ($course !== '' && $course !== null) {
            $notes = $notes->where('C.id', $course);
            $notesCounter = $notesCounter->where('C.id', $course);
        }

        if (Auth::user()->id_rol==5) {
            $notes = $notes->select('users.id', 'LS.name AS course', 'users.name', 'last_name')->where('id_rol', 5)->where('users.id',Auth::user()->id)->skip($prev)->take(20)->get();
            $notesCounter = $notesCounter->where('id_rol', 5)->where('users.id',Auth::user()->id)->count();
        }else{
            $notes = $notes->select('users.id', 'LS.name AS course', 'users.name', 'last_name')->where('id_rol', 5)->skip($prev)->take(20)->get();
            $notesCounter = $notesCounter->where('id_rol', 5)->count();
        }

        return [ 'notes' => $notes, 'counter' => $notesCounter ];
    }

    function getReportsPeriod(Request $request) {
        $id = $request->get('id');
        $student = DB::table('users')->where('id', $id)->first();
        $nxt = $request->get('nxt');
        $prev = $request->get('prev');
        $search = $request->get('search');
        $teacher = $request->get('teacher');
        $subject = $request->get('subject');

        $periods = DB::table('times')->get();
        $subjects = DB::table('subjects As S')
            ->select( 'S.name')
            ->groupBy('S.id')
            ->get();


        $madafaka=DB::table('users')
        ->join('users_list_students as ULS','ULS.id_users','users.id')
        ->join('list_students as LS','LS.id','ULS.id_list_students')
        ->join('course as C','C.id_list_students','LS.id')
        ->join('teacher_course as TC','TC.id_course','C.id')
        ->join('subjects as S','S.id','TC.id_subjects')
        ->select('S.name')
        ->where('users.id',$id)
        ->get();


        $exam=DB::table('notes_exam as NE')
            ->join('parcial_notes as PN','PN.id','NE.id_parcial_notes')
            ->join('exam as EXAME','EXAME.id','NE.id_exam')
            ->join('themes_time AS TT', 'TT.id', 'EXAME.id_theme_time')
            ->join('times AS T', 'T.id', 'TT.id_time')
            ->join('subjects AS S', 'S.id', 'TT.id_subject')
            ->where('NE.id_student', $id)
            ->select(DB::raw('SUM(PN.value)/COUNT(PN.value)*(TT.exam_percentage/100) AS nota'),'S.name', 'T.id AS p_id', 'T.name AS periodo')
            ->groupBy('S.id','T.id')
            ->get();

        $homework=DB::table('notes_homework as NH')
            ->join('homework as HW','HW.id','NH.id_homework')
            ->join('parcial_notes as PN','PN.id','NH.id_parcial_notes')
            ->join('themes_time AS TT', 'TT.id', 'HW.id_theme_time')
            ->join('times AS T', 'T.id', 'TT.id_time')
            ->join('subjects AS S', 'S.id', 'TT.id_subject')
            ->where('NH.id_student', $id)
            ->select(DB::raw('SUM(PN.value)/COUNT(PN.value)*(TT.homework_percentage/100) AS nota'),'S.name', 'T.id AS p_id', 'T.name as periodo')
            ->groupBy('S.id','T.id')
            ->get();

        $notesPeriod = [];
        $notesAnual = [];
        $periodos=[];
        foreach ($homework as $key => $value) {
            $notesPeriod[$value->periodo][$value->name]=(isset($notesPeriod[$value->periodo][$value->name]))? $notesPeriod[$value->periodo][$value->name] + $value->nota : $value->nota;
        }

        foreach ($exam as $key => $value) {
        	$periodos[$value->periodo]=1;
            $notesPeriod[$value->periodo][$value->name]=(isset($notesPeriod[$value->periodo][$value->name]))? $notesPeriod[$value->periodo][$value->name] + $value->nota : $value->nota;
        }

        foreach ($madafaka as $key => $value) {
        	foreach ($periods as $k => $val) {
            	$notesPeriod[$val->name][$value->name]=(isset($notesPeriod[$val->name][$value->name]))? $notesPeriod[$val->name][$value->name]  : 0;
        	}
        }

        foreach ($notesPeriod as $npKey => $npValue) {          
            foreach ($npValue as $npvKey => $npvValue) {
                $notesAnual[$npvKey]=(isset($notesAnual[$npvKey]))? $notesAnual[$npvKey] + $npValue[$npvKey] : $npValue[$npvKey];
            }
        }
        $options="<option value=''>Todos Los Periodos</option>";
        foreach ($periodos as $key => $value) {
            $options.="<option value='".$key."'>".$key."</option>";
        }
        foreach ($notesAnual as $naKey => $naValue) { $notesAnual[$naKey] = $naValue / count($notesPeriod); }
        if (empty($request->get('tipo'))) {
        	$view=view('reports.table-reports',compact('student','notesPeriod'))->render();
        }else{
        	$tipo="anual";
        	$view=view('reports.table-reports',compact('student','notesAnual','tipo'))->render();
        }

        return [ 's' => $student,'notes' => $view,'periodos'=>$periodos,'options'=>$options ];
    }

    function getSubjectReport(Request $request){
    	extract($request->all());
    	$subjects = DB::table('users')
        ->join('users_list_students as ULS','ULS.id_users','users.id')
        ->join('list_students as LS','LS.id','ULS.id_list_students')
        ->join('course as C','C.id_list_students','LS.id')
        ->join('teacher_course as TC','TC.id_course','C.id')
        ->join('subjects as S','S.id','TC.id_subjects')
        ->select('S.name')
        ->where('users.id',$id)
        ->get();
        return [ 'subjects' => $subjects ];
    }
    
}
