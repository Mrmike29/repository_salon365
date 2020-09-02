<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rol;
use App\User;
use DB;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function home()
    {
        $roles = ['students' => 0, 'teacher' => 0, 'parents' => 0, 'secretary' => 0];
        $rol = Rol::find(Auth::user()->id_rol);
        $usuarios = User::select(DB::raw('COUNT(*) as roles, id_rol'))->where('id_info_entity',Auth::user()->id_info_entity)->groupBy('id_rol')->get();
        foreach ($usuarios as $key => $val) {
            if($val->id_rol == 3){
                $roles['secretary'] = $val->roles;
            }
            if($val->id_rol == 4){
                $roles['teacher'] = $val->roles;
            }
            if($val->id_rol == 5){
                $roles['students'] = $val->roles;
            }
            if($val->id_rol == 6){
                $roles['parents'] = $val->roles;
            }
        }

        return view('welcome', array('rol'=>$rol, 'roles'=>$roles));
    }
}
