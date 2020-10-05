<?php


namespace App\Http\Controllers;
use Illuminate\Http\Request;


class UploadFile
{

    function getProgressBarView () { return view('upload-file/upload-file'); }

    function postUploadFile (Request $request) {

        $targetPath='prueba-upload/imagen_' . basename($_FILES["the_file"]['name']);
        if(move_uploaded_file($_FILES["the_file"]['tmp_name'], $targetPath)) {
//            dd("ok");
        }
    }
}
