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

    function getListReport(Request $request) {
        $t = $request->get('t');
    }
}
