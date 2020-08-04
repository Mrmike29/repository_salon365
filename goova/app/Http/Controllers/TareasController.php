<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Mail;

class TareasController extends Controller
{
    public function store(Request $request)
    {
        $path = public_path().'/archives/';
        $files = $request->file('file');
        foreach($files as $file){
            $fileName = $file->getClientOriginalName();
            $file->move($path, $fileName);
        }
    }
}