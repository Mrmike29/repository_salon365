<?php

namespace App\Http\Controllers;

//use Elibyy\TCPDF\Facades\TCPDF;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Response;

$u ="";

class PdfController {

    function getCryptData(Request $request) {
        $p = $request->get('p', null);
        $id = $request->get('id', null);

        if ($id === null || $p === null) { return Response::json(['error' => 'Oops! Se detectó un problema, intenta más tarde.'], 500); }

        $s = Crypt::encryptString($p) . '=' . Crypt::encryptString($id);

        return [ 's' => $s ];
    }

    function getBulletin (Request $request) {
        $o = '';

        foreach ($request->request AS $item){ $o = explode("=", $item); }

        $id = Crypt::decryptString($o[1]);
        $period = Crypt::decryptString($o[0]);

        if ($id === null || $period === null) { return Response::json(['error' => 'Oops! Se detectó un problema, intenta más tarde.'], 500); }

        global $u;

        $exam=DB::table('notes_exam as NE')
            ->join('parcial_notes as PN','PN.id','NE.id_parcial_notes')
            ->join('exam as EXAME','EXAME.id','NE.id_exam')
            ->join('themes_time AS TT', 'TT.id', 'EXAME.id_theme_time')
            ->join('times AS T', 'T.id', 'TT.id_time')
            ->join('subjects AS S', 'S.id', 'TT.id_subject')
            ->join('areas AS A', 'A.id', 'S.id_area')
            ->where('NE.id_student', $id)
            ->select('T.id AS p_id', 'A.name AS area', 'S.name', DB::raw('SUM(PN.value)/COUNT(PN.value)*(TT.exam_percentage/100) AS nota'))
            ->groupBy('S.id','T.id')
            ->get();



        $homework=DB::table('notes_homework as NH')
            ->join('homework as HW','HW.id','NH.id_homework')
            ->join('parcial_notes as PN','PN.id','NH.id_parcial_notes')
            ->join('themes_time AS TT', 'TT.id', 'HW.id_theme_time')
            ->join('times AS T', 'T.id', 'TT.id_time')
            ->join('subjects AS S', 'S.id', 'TT.id_subject')
            ->join('areas AS A', 'A.id', 'S.id_area')
            ->where('NH.id_student', $id)
            ->select('T.id AS p_id', 'A.name AS area', 'S.name', DB::raw('SUM(PN.value)/COUNT(PN.value)*(TT.homework_percentage/100) AS nota'))
            ->groupBy('S.id','T.id')
            ->get();

        $notesPeriod = [];
        $notesAnual = [];

        foreach ($homework as $key => $value) {
            $notesPeriod[$value->p_id][$value->area][$value->name] =
                (isset($notesPeriod[$value->p_id][$value->name]))?
                    $notesPeriod[$value->p_id][$value->name] + $value->nota :
                    $value->nota;
        }

        foreach ($exam as $key => $value) {
            $notesPeriod[$value->p_id][$value->area][$value->name] =
                (isset($notesPeriod[$value->p_id][$value->name]))? $notesPeriod[$value->p_id][$value->name] + $value->nota : $value->nota;
        }

        foreach ($notesPeriod as $npKey => $npValue) {
            foreach ($npValue as $npvKey => $npvValue) {
                foreach($npvValue AS $npvvKey => $npvvValue){
                    $notesAnual[$npvKey] = (isset($notesAnual[$npvKey]))? $notesAnual[$npvKey] + $npvvValue : $npvvValue;
                }
            }
        }

        foreach ($notesAnual as $naKey => $naValue) { $notesAnual[$naKey] = $naValue / count($notesPeriod); }

        $u = DB::table('users AS U')
            ->join('entity AS E', 'E.id', 'U.id_info_entity')
            ->join('users_list_students AS ULS', 'ULS.id_users', 'U.id')
            ->join('list_students AS LS', 'LS.id', 'ULS.id_list_students')
            ->where('U.id', $id)
            ->select(
                'E.name AS institution_name',
                'E.document AS institution_nit',
                'LS.name AS course_name',
                'U.name AS student_name',
                'U.last_name AS student_lastname'
            )
            ->first();

        $dataStudent = DB::table('users AS U')
            ->join('users_list_students AS ULS', 'ULS.id_users', 'U.id')
            ->join('list_students AS LS', 'LS.id', 'ULS.id_list_students')
            ->join('course AS C', 'C.id_list_students', 'LS.id')
            ->join('teacher_course AS TC', 'TC.id_course', 'C.id')
            ->join('subjects AS S', 'S.id', 'TC.id_subjects')
            ->join('users AS UT', 'UT.id', 'TC.id_users')
            ->where('U.id', $id)
            ->select('S.id', 'S.name AS subject', 'UT.name AS teacher_name', 'UT.last_name AS teacher_lastname', 'TC.hour_week AS hours')
            ->groupBy('S.id')
            ->get();

        $reports = [];

        foreach ($dataStudent AS $item) {
            $reports[$item->subject]['teacher_name'] = $item->teacher_name . ' ' . $item->teacher_lastname;
            $reports[$item->subject]['hours'] = $item->hours;
            $reports[$item->subject]['observations'] = DB::table('period_report_subject AS PRS')
                ->where('PRS.id_student', $id)
                ->where('PRS.id_subject', $item->id)
                ->where('PRS.id_time', $period)
                ->select('cognitive_observation', 'personal_observation', 'social_observation')
                ->first();
        }

        $personalReport = DB::table('period_report_student AS PRS')
            ->where('PRS.id_student', $id)
            ->where('PRS.id_time', $period)
            ->select('id', 'observation')
            ->first();

        $html =
            '<style>
                .l-header { font-size: 8px;}
                .l-body { font-size: 8px;}
                .l-content { font-size: 6px; }
                .img-container { width: 10%;}
                .upp { text-transform: uppercase; }
                .bt { border-top: 1px solid black; }
                .br { border-right: 1px solid black; }
                .bb { border-bottom: 1px solid black; }
                .bl { border-left: 1px solid black; }
            </style>
            <table cellpadding="0" cellspacing="0" class="br bb bl" style="width:600px;">';

        $usuario=DB::table('users')
            ->join('users_list_students as ULS','ULS.id_users','users.id')
            ->join('list_students as LS','LS.id','ULS.id_list_students')
            ->join('course as C','C.id_list_students','LS.id')
            ->join('teacher_course as TC','TC.id_course','C.id')
            ->join('subjects as S','S.id','TC.id_subjects')
            ->select('S.name','S.id')
            ->where('users.id',11)
            ->get();
        $faltas=[];
        foreach ($usuario as $key => $value) {
            $room=DB::table('room')
                ->join('themes_time as TT','TT.id','room.id_themes_time')
                ->join('times as T','T.id','TT.id_time')->where('room.id_subject',$value->id)
                ->join('subjects as S','S.id','room.id_subject')
                ->select('room.id','T.id as periodo','S.name')
                ->get();
            if (!empty($room[0])) {
                foreach ($room as $keys => $values) {
                    $rooms=DB::table('room')->join('themes_time as TT','TT.id','room.id_themes_time')->join('times as T','T.id','TT.id_time')->where('room.id_subject',$value->id)->count();
                    $assist=DB::table('class_assist')->where('id_room',$values->id)->where('id_users',$id)->count();
                    $faltas[$values->periodo][$values->name]=$rooms-$assist;
                }
            }
        }

        $faltasTotal = 0;

        foreach ($faltas AS $key => $item){
            foreach ($item AS $iKey => $iValue){
                $faltasTotal += $iValue;
            }
        }

        $c = 1;
        foreach ($notesPeriod[$period] AS $npKey => $npValue){
            $bt = (1 === $c)? '' : 'bt';
            $html .=
                '<tr>
                    <td class="l-body '. $bt .'" style="width: 90%;" align="left">
                        <b class="upp l-content">' . $npKey . '</b>
                    </td>
                </tr>';
            $c++;
            foreach ($npValue AS $npvKey => $npvValue){
                $html .=
                    '<tr>
                        <td class="l-body" style="width: 20%;" align="left">
                            <b class="upp l-content">' . $npvKey . '</b>
                        </td>
                        <td class="l-body" style="width: 7%;" align="left">
                            <b class="upp l-content">Docente:</b>
                        </td>
                        <td class="l-body" style="width: 28%;" align="center">
                            <b class="upp l-content">' . $reports[$npvKey]['teacher_name'] . '</b>
                        </td>
                        <td class="l-body" style="width: 3%;" align="left">
                            <b class="upp l-content">IHS:</b>
                        </td>
                        <td class="l-body" style="width: 8%;" align="center">
                            <b class="upp l-content">' . $reports[$npvKey]['hours'] . '</b>
                        </td>
                        <td class="l-body " style="width: 3%;" align="left">
                            <b class="upp l-content">FA:</b>
                        </td>
                        <td class="l-body" style="width: 8%;" align="left">
                            <b class="upp l-content">' . $faltas[$period][$npvKey] . '</b>
                        </td>
                        <td class="l-body" style="width: 3%;" align="left">
                            <b class="upp l-content">' . number_format($npvValue, 1) . '</b>
                        </td>
                        <td class="l-body" style="width: 2%;" align="left">
                            <b class="upp l-content">-</b>
                        </td>
                        <td class="l-body" style="width: 8%;" align="center">
                            <b class="upp l-content">superior</b>
                        </td>
                    </tr>
                    <tr>
                        <td class="l-body">
                            <b style="font-size: 6px">
                                &nbsp;&nbsp;&nbsp;
                                Desempeño Cognitivo
                            </b>
                        </td>
                    </tr>
                    <tr>
                        <td class="l-body" style="width:4%;" align="center">
                        </td>
                        <td class="l-body" style="width:82%;" colspan="10"><p style="font-weight: normal;font-size: 6px">' . str_replace("\n", "<br><br>", $reports[$npvKey]['observations']->cognitive_observation) . '</p>
                        </td>
                    </tr>
                    <tr>
                        <td class="l-body" colspan="10">
                            <b style="font-size: 6px">
                                &nbsp;&nbsp;&nbsp;
                                Desempeño Personal
                            </b>
                        </td>
                    </tr>
                    <tr>
                        <td class="l-body" style="width:4%;" align="center">
                        </td>
                        <td class="l-body" style="width:82%;" colspan="10"><p style="font-weight: normal;font-size: 6px">' . str_replace("\n", "<br><br>", $reports[$npvKey]['observations']->personal_observation) . '</p>
                        </td>
                    </tr>
                    <tr>
                        <td class="l-body bb" style="width:90%" colspan="10">
                            <b style="font-size: 6px">
                                &nbsp;&nbsp;&nbsp;
                                Desempeño Social
                            </b>
                        </td>
                    </tr>
                    <tr>
                        <td class="l-body" style="width:4%;" align="center">
                        </td>
                        <td class="l-body" style="width:82%;" colspan="10"><p style="font-weight: normal;font-size: 6px">' . str_replace("\n", "<br><br>", $reports[$npvKey]['observations']->social_observation) . '</p>
                        </td>
                    </tr>';
            }
        }

        $html .=
            '</table>
            <style>
                .l-header { font-size: 8px;}
                .l-body { font-size: 8px;}
                .l-content { font-size: 6px; }
                .img-container { width: 10%;}
                .upp { text-transform: uppercase; }
                .bt { border-top: 1px solid black; }
                .br { border-right: 1px solid black; }
                .bb { border-bottom: 1px solid black; }
                .bl { border-left: 1px solid black; }
            </style>
            <table>
                <tr>
                    <td class="l-body bl" style="width: 74%;" align="left">
                        <b class="upp l-content">EVALUACIÓN PERSONALIZADA</b>
                    </td>
                    <td class="l-body" style="width: 3%;" align="left">
                        <b class="upp l-content">FA:</b>
                    </td>
                    <td class="l-body" style="width: 9%;" align="left">
                        <b class="upp l-content">' . $faltasTotal . '</b>
                    </td>
                    <td class="l-body" style="width: 3%;" align="left">
                        <b class=" l-content"> </b>
                    </td>
                    <td class="l-body" style="width: 2%;" align="center">
                        <b class="upp l-content">-</b>
                    </td>
                    <td class="l-body br" style="width: 9.2%;" align="center">
                        <b class="l-content"> </b>
                    </td>
                </tr>
                <tr>
                    <td class="l-body br bl" style="width:100.2%">
                        <b class="upp l-content">RECOMENDACIÓN</b>
                    </td>
                </tr>
                <tr>
                    <td class="l-body bl" style="width:4%;" align="center"></td>
                    <td class="l-body br" style="width:96.2%;"><p style="font-weight: normal;font-size: 6px"></p></td>
                </tr>
                <tr>
                    <td class="l-body l-content bt br bl" style="width:100.2%">
                        REGISTRO DE VALORACIONES ACUMULADA DURANTE EL AÑO LECTIVO
                    </td>
                </tr>';

        $sizeAA = (9 - count($notesPeriod))*10;

        $html .=
            '<tr>
                <td class="l-body l-content bt br bl" style="width:'. $sizeAA . '.2%" rowspan="2">
                    <b style="font-size:10pt;">&nbsp;</b>
                    AREAS / ASIGNATURAS
                </td>
                <td class="bt br bb bl l-body" style="width:5%" rowspan="2" align="left">
                  <b style="font-size:10pt;">&nbsp;</b>
                  IHS
                </td>';
        foreach ($notesPeriod AS $key => $item){
        $html .=
                '<td class="bt br bb bl l-body l-content" style="width:10%" colspan="2" align="center">
                    <b class="upp l-content">P'. $key . ' ' . (100 / count($notesPeriod)) .' .0</b>
                </td>
                ';
        }
        $html .=
                '<td class="bt br bb bl l-body l-content" style="width:5%" rowspan="2" align="left">
                    <b style="font-size:10pt;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b>VAC
                </td>
            </tr>';

        $html .=
            '<tr>
                <td class="bt br bb l-body l-content" align="center">
                   Val
                </td>
                <td class="bt br bb l-body l-content" align="center">
                   Sup
                </td>
                <td class="bt br bb l-body l-content" align="center">
                   Val
                </td>
                <td class="bt br bb l-body l-content" align="center">
                   Sup
                </td>
            </tr>';

        foreach ($notesPeriod AS $key => $item){
            foreach ($item AS $iKey => $iValue){
//                dd($iKey);
            }
            $html .=
                '<tr>
                    <td class="bt br bb bl l-body l-content" style="width:'. $sizeAA . '.2%">
                        <b class="upp l-content">ÁREA DE MÁTEMATICAS</b>
                    </td>
                    <td class="br bb l-body l-content" style="width:5%" align="center"></td>
                    <td class="bt br bb l-body l-content" align="center">
                        <b>4.9</b>
                    </td>
                    <td class="bt br bb l-body l-content" align="center">

                    </td>
                    <td class="bt br bb l-body l-content" align="center">

                    </td>
                    <td class="bt br bb l-body l-content" align="center">

                    </td>
                    <td class="bt br bb bl l-body l-content" style="width:5%" align="center"></td>
                </tr>';


        $html .=
            '
                <tr>
                    <td class="bt br bb bl l-body l-content" style="width:'. $sizeAA . '.2%">
                        &nbsp;&nbsp;&nbsp;&nbsp;MÁTEMATICAS
                    </td>
                    <td class="bt br bb l-body l-content" style="width:5%" align="center"></td>
                    <td class="bt br bb l-body l-content" align="center">
                        <b>4.9</b>
                    </td>
                    <td class="bt br bb l-body l-content" align="center">

                    </td>
                    <td class="bt br bb l-body l-content" align="center">

                    </td>
                    <td class="bt br bb l-body l-content" align="center">

                    </td>
                    <td class="bt br bb bl l-body l-content" style="width:5%" align="center"></td>
                </tr>';
        }

        $html .=
                '<tr>
                    <td class="bt br bb bl l-body l-content" style="width:'. $sizeAA . '.2%" align="right">
                        Promedio del estudiante en el grupo &nbsp;
                    </td>
                    <td class="bt br bb l-body l-content" style="width:5%" align="center"></td>
                    <td class="bt br bb l-body l-content" align="center">
                        4.9
                    </td>
                    <td class="bt br bb l-body l-content" align="center">

                    </td>
                    <td class="bt br bb l-body l-content" align="center">

                    </td>
                    <td class="bt br bb l-body l-content" align="center">

                    </td>
                    <td class="bt br bb bl l-body l-content" style="width:5%" align="center"></td>
                </tr>
                <tr>
                    <td class="bt br bb bl l-body l-content" style="width:'. $sizeAA . '.2%" align="right">
                        Puesto del estudiante en el grupo &nbsp;
                    </td>
                    <td class="bt br bb l-body l-content" style="width:5%" align="center"></td>
                    <td class="bt br bb l-body l-content" align="center">
                        1
                    </td>
                    <td class="bt br bb l-body l-content" align="center">

                    </td>
                    <td class="bt br bb l-body l-content" align="center">

                    </td>
                    <td class="bt br bb l-body l-content" align="center">

                    </td>
                    <td class="bt br bb bl l-body l-content" style="width:5%" align="center"></td>
                </tr>
                <tr>
                    <td class="bt br bl l-body l-content" style="width:100.2%">
                        <b class="upp l-content">Información general:</b>
                    </td>
                </tr>
                <tr>
                    <td class="l-body bb bl" style="width:4%;" align="center">
                    </td>
                    <td class="l-body br bb" style="width:96.2%;"><p style="font-weight: normal;font-size: 6px">' . str_replace("\n", "<br><br>", $personalReport->observation) . '</p>
                    </td>
                </tr>
            </table>';

        PDF::setHeaderCallback(function($pdf) {
            $pdf->SetY(9);
            global $u;
            $header =
                '<style>
                    .l-header { font-size: 8px;}
                    .l-body { font-size: 8px;}
                    .l-content { font-size: 6px; }
                    .img-container { width: 10%;}
                    .upp { text-transform: uppercase; }
                    .bt { border-top: 1px solid black; }
                    .br { border-right: 1px solid black; }
                    .bb { border-bottom: 1px solid black; }
                    .bl { border-left: 1px solid black; }
                </style>
                <table>
                    <tr>
                        <td class="img-container bt br bb bl" rowspan="5">
                            <img style="width: 55px; height: 60px;" src="https://www.goova.co/img/logo.png" alt="">
                        </td>
                        <td class="l-header bt br bb bl" style=" width: 90.2%; font-size: 8px" colspan="3" align="center">
                            <b class="upp">Institución Educativa ' . $u->institution_name . '</b>
                        </td>
                    </tr>
                    <tr>
                        <td class="br bl" style="width: 90.2%; font-size: 6px" colspan="3" align="center">
                            Reconocimiento oficial según Resolucion No. 1688 del 3 de septiembre del 2002 expedida por la Secrataria de Educación Departamental
                        </td>
                    </tr>
                    <tr>
                        <td class="l-header bt br bb bl" style="width: 70.1%; " align="left">
                            <b>Estudiante: </b>' . $u->student_name . ' ' . $u->student_lastname . '
                        </td>
                        <td class="l-header bt br" style="width: 20.1%; " align="left">
                            <b>Periodo: </b>1 - 2020
                        </td>
                    </tr>
                    <tr>
                        <td class="l-header br bb bl" style="width: 70.1%; " align="left">
                            <b>Curso: </b>' . $u->course_name . '
                        </td>
                        <td class="l-header br bb" style="width: 20.1%;" align="left">
                            <b>Página: </b>'. PDF::getAliasNumPage() .'-'.PDF::getAliasNbPages() .'
                        </td>
                    </tr>
                    <tr>
                        <td class="l-header bt br bb bl" style="width: 90.2%;" align="left">
                            <b>NIT: </b>' . $u->institution_nit . '
                        </td>
                    </tr>
                </table>';

            $pdf->writeHTML($header, true, false, true, false, '');
        });

        PDF::SetAuthor('System');
        PDF::SetTitle('Boletín de Notas');
        PDF::SetAutoPageBreak(TRUE, 10);
        PDF::SetMargins(10, 30, 10);
        PDF::SetFontSubsetting(false);
//        PDF::SetFontSize('10px');
        PDF::AddPage();
        PDF::writeHTML($html, true, false, true, false, '');

        PDF::lastPage();
        PDF::Output('my_file.pdf'/*, 'D'*/);
//        PDF::SetSubject('Report of System');
    }
}
