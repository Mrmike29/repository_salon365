<?php

namespace App\Http\Controllers;

use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Response;

class PdfController {

    function getPdf () {
        $id = 3;
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

//        dd($u->e_name);

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
            <table cellpadding="0" cellspacing="0" style="width:600px; border: 1px solid black">
                <tr>
                    <td class="img-container bb" rowspan="5">
                        <img style="width: 55px; height: 45px;" src="https://www.goova.co/img/logo.png" alt="">
                    </td>
                    <td class="l-header bb bl" style=" width: 80%; font-size: 8px" colspan="3" align="center">
                        <b class="upp">Institución Educativa ' . $u->institution_name . '</b>
                    </td>
                </tr>
                <tr>
                    <td class="bl" style="width: 80%; font-size: 6px" colspan="3" align="center">
                        Reconocimiento oficial según Resolucion No. 1688 del 3 de septiembre del 2002 expedida por la Secrataria de Educación Departamental
                    </td>
                </tr>
                <tr>
                    <td class="l-header bt br bb bl" style="width: 65%; " align="left">
                        <b>Estudiante: </b>' . $u->student_name . ' ' . $u->student_lastname . '
                    </td>
                    <td class="l-header bt" style="width: 15%; " align="left">
                        <b>Periodo: </b>1 - 2020
                    </td>
                </tr>
                <tr>
                    <td class="l-header br bb bl" style="width: 65%; " align="left">
                        <b>Curso: </b>' . $u->course_name . '
                    </td>
                    <td class="l-header bb" style="width: 15%;" align="left">
                        <b>Página: </b>1
                    </td>
                </tr>
                <tr>
                    <td class="l-header" style="width: 80%; border: 1px solid black;" align="left">
                        <b>NIT: </b>' . $u->institution_nit . '
                    </td>
                </tr>
                <tr>
                    <td class="l-body" style="width: 20%;" align="left">
                        <b class="upp l-content">Matemáticas</b>
                    </td>
                    <td class="l-body" style="width: 7%;" align="left">
                        <b class="upp l-content">Docente:</b>
                    </td>
                    <td class="l-body" style="width: 28%;" align="center">
                        <b class="upp l-content">pnombre snombre papellido sapellido</b>
                    </td>
                    <td class="l-body" style="width: 3%;" align="left">
                        <b class="upp l-content">IHS:</b>
                    </td>
                    <td class="l-body" style="width: 8%;" align="center">
                        <b class="upp l-content">4</b>
                    </td>
                    <td class="l-body" style="width: 3%;" align="left">
                        <b class="upp l-content">FA:</b>
                    </td>
                    <td class="l-body" style="width: 8%;" align="left">
                        <b class="upp l-content">0</b>
                    </td>
                    <td class="l-body" style="width: 3%;" align="left">
                        <b class="upp l-content">4.7</b>
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
                    <td class="l-body" style="width:82%;" colspan="10"><p style="font-weight: normal;font-size: 6px">Casi siempre consulta a través de recursos tecnológicos los principales eventos biológicos y geológicos que han ocurrido desde la formación del planeta hasta nuestros días.
                    <br><br>Diferencia cada una de las estructuras y organelos que constituyen las células animal y vegetal. con su respectiva función.
                    <br><br>Identifica los tipos de transporte de sustancias a través de la membrana según su función.
                    <br><br>Casi siempre conoce las hipótesis y teorías que explican el origen de la vida y, comprendo en qué consiste la evolución de los organismos.</p>
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
                    <td class="l-body" colspan="10">
                        <b style="font-size: 6px">
                            &nbsp;&nbsp;&nbsp;
                            Desempeño Social
                        </b>
                    </td>
                </tr>
                <tr>
                    <td class="l-body bt" style="width: 20%;" align="left">
                        <b class="upp l-content">Matemáticas</b>
                    </td>
                    <td class="l-body bt" style="width: 7%;" align="left">
                        <b class="upp l-content">Docente:</b>
                    </td>
                    <td class="l-body bt" style="width: 28%;" align="center">
                        <b class="upp l-content">pnombre snombre papellido sapellido</b>
                    </td>
                    <td class="l-body bt" style="width: 3%;" align="left">
                        <b class="upp l-content">IHS:</b>
                    </td>
                    <td class="l-body bt" style="width: 8%;" align="center">
                        <b class="upp l-content">4</b>
                    </td>
                    <td class="l-body bt" style="width: 3%;" align="left">
                        <b class="upp l-content">FA:</b>
                    </td>
                    <td class="l-body bt" style="width: 8%;" align="left">
                        <b class="upp l-content">0</b>
                    </td>
                    <td class="l-body bt" style="width: 3%;" align="left">
                        <b class="upp l-content">4.7</b>
                    </td>
                    <td class="l-body bt" style="width: 2%;" align="left">
                        <b class="upp l-content">-</b>
                    </td>
                    <td class="l-body bt" style="width: 8%;" align="center">
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
                    <td class="l-body" style="width:82%;" colspan="10"><p style="font-weight: normal;font-size: 6px">Casi siempre consulta a través de recursos tecnológicos los principales eventos biológicos y geológicos que han ocurrido desde la formación del planeta hasta nuestros días.
                    <br><br>Diferencia cada una de las estructuras y organelos que constituyen las células animal y vegetal. con su respectiva función.
                    <br><br>Identifica los tipos de transporte de sustancias a través de la membrana según su función.
                    <br><br>Casi siempre conoce las hipótesis y teorías que explican el origen de la vida y, comprendo en qué consiste la evolución de los organismos.</p>
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
                    <td class="l-body" colspan="10">
                        <b style="font-size: 6px">
                            &nbsp;&nbsp;&nbsp;
                            Desempeño Social
                        </b>
                    </td>
                </tr>
                <tr>
                    <td class="l-body bt" style="width: 20%;" align="left">
                        <b class="upp l-content">Matemáticas</b>
                    </td>
                    <td class="l-body bt" style="width: 7%;" align="left">
                        <b class="upp l-content">Docente:</b>
                    </td>
                    <td class="l-body bt" style="width: 28%;" align="center">
                        <b class="upp l-content">pnombre snombre papellido sapellido</b>
                    </td>
                    <td class="l-body bt" style="width: 3%;" align="left">
                        <b class="upp l-content">IHS:</b>
                    </td>
                    <td class="l-body bt" style="width: 8%;" align="center">
                        <b class="upp l-content">4</b>
                    </td>
                    <td class="l-body bt" style="width: 3%;" align="left">
                        <b class="upp l-content">FA:</b>
                    </td>
                    <td class="l-body bt" style="width: 8%;" align="left">
                        <b class="upp l-content">0</b>
                    </td>
                    <td class="l-body bt" style="width: 3%;" align="left">
                        <b class="upp l-content">4.7</b>
                    </td>
                    <td class="l-body bt" style="width: 2%;" align="left">
                        <b class="upp l-content">-</b>
                    </td>
                    <td class="l-body bt" style="width: 8%;" align="center">
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
                    <td class="l-body" style="width:82%;" colspan="10"><p style="font-weight: normal;font-size: 6px">Casi siempre consulta a través de recursos tecnológicos los principales eventos biológicos y geológicos que han ocurrido desde la formación del planeta hasta nuestros días.
                    <br><br>Diferencia cada una de las estructuras y organelos que constituyen las células animal y vegetal. con su respectiva función.
                    <br><br>Identifica los tipos de transporte de sustancias a través de la membrana según su función.
                    <br><br>Casi siempre conoce las hipótesis y teorías que explican el origen de la vida y, comprendo en qué consiste la evolución de los organismos.</p>
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
                    <td class="l-body" colspan="10">
                        <b style="font-size: 6px">
                            &nbsp;&nbsp;&nbsp;
                            Desempeño Social
                        </b>
                    </td>
                </tr>
                <tr>
                    <td class="l-body bt" style="width: 20%;" align="left">
                        <b class="upp l-content">Matemáticas</b>
                    </td>
                    <td class="l-body bt" style="width: 7%;" align="left">
                        <b class="upp l-content">Docente:</b>
                    </td>
                    <td class="l-body bt" style="width: 28%;" align="center">
                        <b class="upp l-content">pnombre snombre papellido sapellido</b>
                    </td>
                    <td class="l-body bt" style="width: 3%;" align="left">
                        <b class="upp l-content">IHS:</b>
                    </td>
                    <td class="l-body bt" style="width: 8%;" align="center">
                        <b class="upp l-content">4</b>
                    </td>
                    <td class="l-body bt" style="width: 3%;" align="left">
                        <b class="upp l-content">FA:</b>
                    </td>
                    <td class="l-body bt" style="width: 8%;" align="left">
                        <b class="upp l-content">0</b>
                    </td>
                    <td class="l-body bt" style="width: 3%;" align="left">
                        <b class="upp l-content">4.7</b>
                    </td>
                    <td class="l-body bt" style="width: 2%;" align="left">
                        <b class="upp l-content">-</b>
                    </td>
                    <td class="l-body bt" style="width: 8%;" align="center">
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
                    <td class="l-body" style="width:82%;" colspan="10"><p style="font-weight: normal;font-size: 6px">Casi siempre consulta a través de recursos tecnológicos los principales eventos biológicos y geológicos que han ocurrido desde la formación del planeta hasta nuestros días.
                    <br><br>Diferencia cada una de las estructuras y organelos que constituyen las células animal y vegetal. con su respectiva función.
                    <br><br>Identifica los tipos de transporte de sustancias a través de la membrana según su función.
                    <br><br>Casi siempre conoce las hipótesis y teorías que explican el origen de la vida y, comprendo en qué consiste la evolución de los organismos.</p>
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
                    <td class="l-body" colspan="10">
                        <b style="font-size: 6px">
                            &nbsp;&nbsp;&nbsp;
                            Desempeño Social
                        </b>
                    </td>
                </tr>
                <tr>
                    <td class="l-body bt" style="width: 20%;" align="left">
                        <b class="upp l-content">Matemáticas</b>
                    </td>
                    <td class="l-body bt" style="width: 7%;" align="left">
                        <b class="upp l-content">Docente:</b>
                    </td>
                    <td class="l-body bt" style="width: 28%;" align="center">
                        <b class="upp l-content">pnombre snombre papellido sapellido</b>
                    </td>
                    <td class="l-body bt" style="width: 3%;" align="left">
                        <b class="upp l-content">IHS:</b>
                    </td>
                    <td class="l-body bt" style="width: 8%;" align="center">
                        <b class="upp l-content">4</b>
                    </td>
                    <td class="l-body bt" style="width: 3%;" align="left">
                        <b class="upp l-content">FA:</b>
                    </td>
                    <td class="l-body bt" style="width: 8%;" align="left">
                        <b class="upp l-content">0</b>
                    </td>
                    <td class="l-body bt" style="width: 3%;" align="left">
                        <b class="upp l-content">4.7</b>
                    </td>
                    <td class="l-body bt" style="width: 2%;" align="left">
                        <b class="upp l-content">-</b>
                    </td>
                    <td class="l-body bt" style="width: 8%;" align="center">
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
                    <td class="l-body" style="width:82%;" colspan="10"><p style="font-weight: normal;font-size: 6px">Casi siempre consulta a través de recursos tecnológicos los principales eventos biológicos y geológicos que han ocurrido desde la formación del planeta hasta nuestros días.
                    <br><br>Diferencia cada una de las estructuras y organelos que constituyen las células animal y vegetal. con su respectiva función.
                    <br><br>Identifica los tipos de transporte de sustancias a través de la membrana según su función.
                    <br><br>Casi siempre conoce las hipótesis y teorías que explican el origen de la vida y, comprendo en qué consiste la evolución de los organismos.</p>
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
                    <td class="l-body" colspan="10">
                        <b style="font-size: 6px">
                            &nbsp;&nbsp;&nbsp;
                            Desempeño Social
                        </b>
                    </td>
                </tr>
                <tr>
                    <td class="l-body bt" style="width: 20%;" align="left">
                        <b class="upp l-content">Matemáticas</b>
                    </td>
                    <td class="l-body bt" style="width: 7%;" align="left">
                        <b class="upp l-content">Docente:</b>
                    </td>
                    <td class="l-body bt" style="width: 28%;" align="center">
                        <b class="upp l-content">pnombre snombre papellido sapellido</b>
                    </td>
                    <td class="l-body bt" style="width: 3%;" align="left">
                        <b class="upp l-content">IHS:</b>
                    </td>
                    <td class="l-body bt" style="width: 8%;" align="center">
                        <b class="upp l-content">4</b>
                    </td>
                    <td class="l-body bt" style="width: 3%;" align="left">
                        <b class="upp l-content">FA:</b>
                    </td>
                    <td class="l-body bt" style="width: 8%;" align="left">
                        <b class="upp l-content">0</b>
                    </td>
                    <td class="l-body bt" style="width: 3%;" align="left">
                        <b class="upp l-content">4.7</b>
                    </td>
                    <td class="l-body bt" style="width: 2%;" align="left">
                        <b class="upp l-content">-</b>
                    </td>
                    <td class="l-body bt" style="width: 8%;" align="center">
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
                    <td class="l-body" style="width:82%;" colspan="10"><p style="font-weight: normal;font-size: 6px">Casi siempre consulta a través de recursos tecnológicos los principales eventos biológicos y geológicos que han ocurrido desde la formación del planeta hasta nuestros días.
                    <br><br>Diferencia cada una de las estructuras y organelos que constituyen las células animal y vegetal. con su respectiva función.
                    <br><br>Identifica los tipos de transporte de sustancias a través de la membrana según su función.
                    <br><br>Casi siempre conoce las hipótesis y teorías que explican el origen de la vida y, comprendo en qué consiste la evolución de los organismos.</p>
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
                    <td class="l-body" colspan="10">
                        <b style="font-size: 6px">
                            &nbsp;&nbsp;&nbsp;
                            Desempeño Social
                        </b>
                    </td>
                </tr>
                <tr>
                    <td class="l-body bt" style="width: 20%;" align="left">
                        <b class="upp l-content">Matemáticas</b>
                    </td>
                    <td class="l-body bt" style="width: 7%;" align="left">
                        <b class="upp l-content">Docente:</b>
                    </td>
                    <td class="l-body bt" style="width: 28%;" align="center">
                        <b class="upp l-content">pnombre snombre papellido sapellido</b>
                    </td>
                    <td class="l-body bt" style="width: 3%;" align="left">
                        <b class="upp l-content">IHS:</b>
                    </td>
                    <td class="l-body bt" style="width: 8%;" align="center">
                        <b class="upp l-content">4</b>
                    </td>
                    <td class="l-body bt" style="width: 3%;" align="left">
                        <b class="upp l-content">FA:</b>
                    </td>
                    <td class="l-body bt" style="width: 8%;" align="left">
                        <b class="upp l-content">0</b>
                    </td>
                    <td class="l-body bt" style="width: 3%;" align="left">
                        <b class="upp l-content">4.7</b>
                    </td>
                    <td class="l-body bt" style="width: 2%;" align="left">
                        <b class="upp l-content">-</b>
                    </td>
                    <td class="l-body bt" style="width: 8%;" align="center">
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
                    <td class="l-body" style="width:82%;" colspan="10"><p style="font-weight: normal;font-size: 6px">Casi siempre consulta a través de recursos tecnológicos los principales eventos biológicos y geológicos que han ocurrido desde la formación del planeta hasta nuestros días.
                    <br><br>Diferencia cada una de las estructuras y organelos que constituyen las células animal y vegetal. con su respectiva función.
                    <br><br>Identifica los tipos de transporte de sustancias a través de la membrana según su función.
                    <br><br>Casi siempre conoce las hipótesis y teorías que explican el origen de la vida y, comprendo en qué consiste la evolución de los organismos.</p>
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
                    <td class="l-body bb" style="width: 90%" colspan="15">
                        <b style="font-size: 6px">
                            &nbsp;&nbsp;&nbsp;
                            Desempeño Social
                        </b>
                    </td>
                </tr>
                <tr>
                    <td class="l-body bt" style="width: 20%;" align="left">
                        <b class="upp l-content">Matemáticas</b>
                    </td>
                    <td class="l-body bt" style="width: 7%;" align="left">
                        <b class="upp l-content">Docente:</b>
                    </td>
                    <td class="l-body bt" style="width: 28%;" align="center">
                        <b class="upp l-content">pnombre snombre papellido sapellido</b>
                    </td>
                    <td class="l-body bt" style="width: 3%;" align="left">
                        <b class="upp l-content">IHS:</b>
                    </td>
                    <td class="l-body bt" style="width: 8%;" align="center">
                        <b class="upp l-content">4</b>
                    </td>
                    <td class="l-body bt" style="width: 3%;" align="left">
                        <b class="upp l-content">FA:</b>
                    </td>
                    <td class="l-body bt" style="width: 8%;" align="left">
                        <b class="upp l-content">0</b>
                    </td>
                    <td class="l-body bt" style="width: 3%;" align="left">
                        <b class="upp l-content">4.7</b>
                    </td>
                    <td class="l-body bt" style="width: 2%;" align="left">
                        <b class="upp l-content">-</b>
                    </td>
                    <td class="l-body bt" style="width: 8%;" align="center">
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
                    <td class="l-body" style="width:82%;" colspan="10"><p style="font-weight: normal;font-size: 6px">Casi siempre consulta a través de recursos tecnológicos los principales eventos biológicos y geológicos que han ocurrido desde la formación del planeta hasta nuestros días.
                    <br><br>Diferencia cada una de las estructuras y organelos que constituyen las células animal y vegetal. con su respectiva función.
                    <br><br>Identifica los tipos de transporte de sustancias a través de la membrana según su función.
                    <br><br>Casi siempre conoce las hipótesis y teorías que explican el origen de la vida y, comprendo en qué consiste la evolución de los organismos.</p>
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
                    <td class="l-body" colspan="10">
                        <b style="font-size: 6px">
                            &nbsp;&nbsp;&nbsp;
                            Desempeño Social
                        </b>
                    </td>
                </tr>
                <tr>
                    <td class="l-body bt" style="width: 20%;" align="left">
                        <b class="upp l-content">Matemáticas</b>
                    </td>
                    <td class="l-body bt" style="width: 7%;" align="left">
                        <b class="upp l-content">Docente:</b>
                    </td>
                    <td class="l-body bt" style="width: 28%;" align="center">
                        <b class="upp l-content">pnombre snombre papellido sapellido</b>
                    </td>
                    <td class="l-body bt" style="width: 3%;" align="left">
                        <b class="upp l-content">IHS:</b>
                    </td>
                    <td class="l-body bt" style="width: 8%;" align="center">
                        <b class="upp l-content">4</b>
                    </td>
                    <td class="l-body bt" style="width: 3%;" align="left">
                        <b class="upp l-content">FA:</b>
                    </td>
                    <td class="l-body bt" style="width: 8%;" align="left">
                        <b class="upp l-content">0</b>
                    </td>
                    <td class="l-body bt" style="width: 3%;" align="left">
                        <b class="upp l-content">4.7</b>
                    </td>
                    <td class="l-body bt" style="width: 2%;" align="left">
                        <b class="upp l-content">-</b>
                    </td>
                    <td class="l-body bt" style="width: 8%;" align="center">
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
                    <td class="l-body" style="width:82%;" colspan="10"><p style="font-weight: normal;font-size: 6px">Casi siempre consulta a través de recursos tecnológicos los principales eventos biológicos y geológicos que han ocurrido desde la formación del planeta hasta nuestros días.
                    <br><br>Diferencia cada una de las estructuras y organelos que constituyen las células animal y vegetal. con su respectiva función.
                    <br><br>Identifica los tipos de transporte de sustancias a través de la membrana según su función.
                    <br><br>Casi siempre conoce las hipótesis y teorías que explican el origen de la vida y, comprendo en qué consiste la evolución de los organismos.</p>
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
                    <td class="l-body" colspan="10">
                        <b style="font-size: 6px">
                            &nbsp;&nbsp;&nbsp;
                            Desempeño Social
                        </b>
                    </td>
                </tr>
                <tr>
                    <td class="l-body bt" style="width: 20%;" align="left">
                        <b class="upp l-content">Matemáticas</b>
                    </td>
                    <td class="l-body bt" style="width: 7%;" align="left">
                        <b class="upp l-content">Docente:</b>
                    </td>
                    <td class="l-body bt" style="width: 28%;" align="center">
                        <b class="upp l-content">pnombre snombre papellido sapellido</b>
                    </td>
                    <td class="l-body bt" style="width: 3%;" align="left">
                        <b class="upp l-content">IHS:</b>
                    </td>
                    <td class="l-body bt" style="width: 8%;" align="center">
                        <b class="upp l-content">4</b>
                    </td>
                    <td class="l-body bt" style="width: 3%;" align="left">
                        <b class="upp l-content">FA:</b>
                    </td>
                    <td class="l-body bt" style="width: 8%;" align="left">
                        <b class="upp l-content">0</b>
                    </td>
                    <td class="l-body bt" style="width: 3%;" align="left">
                        <b class="upp l-content">4.7</b>
                    </td>
                    <td class="l-body bt" style="width: 2%;" align="left">
                        <b class="upp l-content">-</b>
                    </td>
                    <td class="l-body bt" style="width: 8%;" align="center">
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
                    <td class="l-body" style="width:82%;" colspan="10"><p style="font-weight: normal;font-size: 6px">Casi siempre consulta a través de recursos tecnológicos los principales eventos biológicos y geológicos que han ocurrido desde la formación del planeta hasta nuestros días.
                    <br><br>Diferencia cada una de las estructuras y organelos que constituyen las células animal y vegetal. con su respectiva función.
                    <br><br>Identifica los tipos de transporte de sustancias a través de la membrana según su función.
                    <br><br>Casi siempre conoce las hipótesis y teorías que explican el origen de la vida y, comprendo en qué consiste la evolución de los organismos.</p>
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
                    <td class="l-body" colspan="10">
                        <b style="font-size: 6px">
                            &nbsp;&nbsp;&nbsp;
                            Desempeño Social
                        </b>
                    </td>
                </tr>
            </table>';

        PDF::SetTitle('Boletín de Notas');
        PDF::AddPage();
        PDF::writeHTML($html, true, false, true, false, '');
        PDF::Output('hello_world.pdf');
    }
}
