<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Type_document;
use App\Rol;
use App\Entity;
use Hash;
use Auth;
use Mail;

class UsuariosController extends Controller
{
    public function index()
    {
        $usarios = User::join('rol','rol.id','users.id_rol')->join('type_document','type_document.id','users.id_type_document')->select('users.document','type_document.name as type_document','rol.name as rol','users.name','users.last_name','users.email','users.phone','users.address')->get();
        // dd(Hash::make('12345678'));

        return view('usuarios.index',array('usuarios'=>$usarios));
    }

    public function create(Request $request)
    {
        $roles = Rol::where('id','<>',1)->get();
        $type_document = Type_document::get();
        // $entity = Entity::get();

        return view('usuarios.create',array('roles'=>$roles,'type_document'=>$type_document));
    }

    public function store(Request $request)
    {
        dd($request);
        $usuario = new User($request->except(['c-password']));
    }
}