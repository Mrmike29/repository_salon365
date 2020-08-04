<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use Mail;

class UsuariosController extends Controller
{
    public function index()
    {
        $usarios = User::get();

        return view('usuarios.index',array('usuarios'=>$usarios));
    }

    public function created(Request $request)
    {
        dd(User::get());
    }
}