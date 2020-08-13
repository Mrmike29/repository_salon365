<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Type_document;
use App\Rol;
use App\Entity;
use App\List_students;
use App\User_list_students;
use Hash;
use Auth;
use Mail;

class UsuariosController extends Controller
{
    public function index()
    {
        $usarios = User::join('rol','rol.id','users.id_rol')->join('type_document','type_document.id','users.id_type_document')->select('users.id','users.document','type_document.name as type_document','rol.name as rol','users.state','users.name','users.last_name','users.email','users.phone','users.address')->get();
        // dd(Hash::make('12345678'));

        return view('usuarios.index',array('usuarios'=>$usarios));
    }

    public function create(Request $request)
    {
        $roles = Rol::where('id','<>',1)->get();
        $type_document = Type_document::get();
        $list_students = List_students::get();
        // $entity = Entity::get();

        return view('usuarios.create',array('roles'=>$roles,'type_document'=>$type_document, 'list_students'=>$list_students));
    }

    public function store(Request $request)
    {
        $entity = Auth::user()->id_info_entity;
        $usuario = new User($request->except(['c-password','password','id_list_students']));
        $usuario->id_info_entity = $entity;
        $usuario->password = Hash::make($request->password);
        $usuario->save();

        if(isset($request->id_list_students) && !empty($request->id_list_students)){
            $lista = new User_list_students();
            $lista->id_users = $usuario->id;
            $lista->id_list_students = $request->id_list_students;
            $lista->save();
        }

        return redirect('/usuarios');
    }

    public function edit($id)
    {
        $usuario = User::find($id);
        $roles = Rol::where('id','<>',1)->get();
        $type_document = Type_document::get();
        $list_students = List_students::get();
        $user_list = User_list_students::where('id_users',$id)->first();

        return view('usuarios.edit',array('usuario'=>$usuario,'roles'=>$roles,'type_document'=>$type_document,'list_students'=>$list_students,'user_list'=>$user_list));
    }

    public function update(Request $request)
    {
        $usuario = User::find($request->id);
        if(!empty($request->password)){
            $usuario->password = Hash::make($request->password);
        }
        $usuario->update($request->except(['password','c-password','id_list_students']));

        $user_list = User_list_students::where('id_users',$request->id)->first();

        if(isset($user_list->id_users)){
            if(isset($request->id_list_students) && !empty($request->id_list_students)){
                $user_list->id_list_students = $request->id_list_students;
                $user_list->update();
            }
        }else{
            if(isset($request->id_list_students) && !empty($request->id_list_students)){
                $lista = new User_list_students();
                $lista->id_users = $usuario->id;
                $lista->id_list_students = $request->id_list_students;
                $lista->save();
            }
        }

        return redirect('/usuarios');
    }

    public function inhabilitar(Request $request)
    {
        User::where('id',$request->id)->update([
            'state' => 'INHABILITADO'
        ]);

        return redirect('/usuarios');
    }

    public function habilitar(Request $request)
    {
        User::where('id',$request->id)->update([
            'state' => 'HABILITADO'
        ]);

        return redirect('/usuarios');
    }
}