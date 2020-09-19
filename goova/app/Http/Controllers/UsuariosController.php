<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Type_document;
use App\Rol;
use App\Entity;
use App\List_students;
use App\User_list_students;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Hash;
use Auth;
use Mail;

class UsuariosController extends Controller
{
    public function index()
    {
        $usuarios = User::join('rol','rol.id','users.id_rol')->join('type_document','type_document.id','users.id_type_document')->select('users.id','users.document','type_document.name as type_document','rol.name as rol','users.state','users.name','users.last_name','users.email','users.phone','users.address')->get();
        $type_document = Type_document::get();
        $roles = Rol::where('id','<>',1)->get();
        // dd(Hash::make('12345678'));

        return view('usuarios.index',compact('usuarios','type_document','roles'));
    }

    public function create(Request $request)
    {
        $roles = Rol::where('id','<>',1)->get();
        $type_document = Type_document::get();
        $list_students = List_students::get();
        $students = User::where('id_rol',5)->get();
        // $entity = Entity::get();

        return view('usuarios.create',array('roles'=>$roles,'type_document'=>$type_document, 'list_students'=>$list_students));
    }

    public function store(Request $request)
    {
        $rol = $request->get('id_rol');
        $entity = Auth::user()->id_info_entity;
        $except = ['c-password','password','id_list_students','picture'];

        if ($rol == 6) {
            $c = $request->get('c');
            array_push($except, 'c');
            for ($i = 1; $i <= $c; $i++) {
                array_push($except, 'course_' . $i);
                array_push($except, 'student_' . $i);
            }
        }

        $usuario = new User($request->except($except));
        $usuario->picture='/previsualizador/imagen_'.Auth::user()->document.'.png';
        $usuario->id_info_entity = $entity;
        $usuario->password = Hash::make($request->password);
        $usuario->save();

        if($request->id_rol == 5){
            if(isset($request->id_list_students) && !empty($request->id_list_students)){
                $lista = new User_list_students();
                $lista->id_users = $usuario->id;
                $lista->id_list_students = $request->id_list_students;
                $lista->save();
            }
        }
        // if($request->id_rol == 6){
        //     if(isset($request->id_students) && !empty($request->id_students)){
        //         foreach ($request->id_students as $key => $val) {
        //             # code...
        //         }
        //     }
        // }


        if ($rol == 6) {
            $c = $request->get('c');
            for ($i = 1; $i <= $c; $i++){
                DB::table('parent_student')->insert([ 'id_parent' => $usuario->id, 'id_student' => $request->get('student_' . $i) ]);
            }
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


    public function previsualizarImagen(){

      $nm2='';
      if(!empty($_FILES['picture']['tmp_name']))
      {
        $nm2='previsualizador/imagen_'.Auth::user()->document.'.png';
        if(move_uploaded_file($_FILES['picture']['tmp_name'], $nm2))
        {
          $nm2='/'.$nm2;
        }
      }

      return compact('nm2');
    }

    public function update(Request $request)
    {
        $usuario = User::find($request->id);
        if(!empty($request->password)){
            $usuario->password = Hash::make($request->password);
        }
        $usuario->picture='/previsualizador/imagen_'.Auth::user()->document.'.png';
        $usuario->update($request->except(['password','c-password','id_list_students','picture']));

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

    public function students_parents($id_course)
    {
        $students = User_list_students::join('users','users.id','users_list_students.id_users')
                                        ->where('users_list_students.id_list_students',$id_course)
                                        ->get();
        return $students;
    }

    public function changePassword(Request $request) {
        try {
            $valid = validator($request->only('old_password', 'new_password', 'confirm_password'), [
                'old_password' => 'required|string|min:6',
                'new_password' => 'required|string|min:6|different:old_password',
                'confirm_password' => 'required_with:new_password|same:new_password|string|min:6',
                    ], [
                'confirm_password.required_with' => 'Confirm password is required.'
            ]);
            if ($valid->fails()) {
                return response()->json([
                            'errors' => $valid->errors(),
                            'message' => 'Error al actualizar la contraseña.',
                            'status' => false
                                ], 200);
            }
            //  Hash::check("param1", "param2")
            //  param1 - user password that has been entered on the form
            //  param2 - old password hash stored in database
            if (Hash::check($request->get('old_password'), trim(Auth::user()->password))) {
                $user = User::find(Auth::user()->id);
                $user->password = Hash::make($request->get('new_password'));
                if ($user->save()) {
                    return response()->json([
                                'data' => [],
                                'message' => 'Su contraseña fue actualizada.',
                                'status' => true
                                    ], 200);
                }
            } else {
                return response()->json([
                            'errors' => ['bad'=>array('La contraseña anterior no coincide.')],
                            'message' => 'Contraseña incorrecta.',
                            'status' => false
                                ], 200);
            }
        } catch (Exception $e) {
            return response()->json([
                        'errors' => $e->getMessage(),
                        'message' => 'Por favor intentelo nuevamente',
                        'status' => false
                            ], 200);
        }
    }

    public function getFilteUser(Request $request){
        extract($request->all());
        $usuarios = User::join('rol','rol.id','users.id_rol')->join('type_document','type_document.id','users.id_type_document');
        if (!empty($tipo)) {
            $usuarios=$usuarios->where('type_document.name',$tipo);
        }
        if (!empty($rol)) {
            $usuarios=$usuarios->where('rol.name',$rol);
        }
        $usuarios=$usuarios->select('users.id','users.document','type_document.name as type_document','rol.name as rol','users.state','users.name','users.last_name','users.email','users.phone','users.address')->get();

        $view= view('usuarios.tables.user-table',compact('usuarios'))->render();
        return $view;
    }

    function getCoursesParents () { return [ 'courses' => DB::table('list_students')->select('id', 'name')->get() ]; }

    function getStudentsPerCourse (Request $request) {

        $id = $request->get('val', null);

        if ($id === null) { return Response::json(['error' => 'Oops! Se detectó un problema, intenta más tarde.'], 500); }

        $students = DB::table('users AS U')
            ->join('users_list_students AS ULS', 'ULS.id_users', 'U.id')
            ->join('list_students AS LS', 'LS.id', 'ULS.id_list_students')
            ->where('id_rol', 5)
            ->where('LS.id', $id)
            ->select('U.id', 'U.name', 'U.last_name')
            ->get();

        return [ 'students' => $students ];
    }
}
