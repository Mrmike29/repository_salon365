<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rol;
use App\User;
use App\Homework;
use App\Exam;
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
        $rol = Rol::find(Auth::user()->id_rol);
        if($rol->id == 2){
            $roles = ['students' => 0, 'teacher' => 0, 'parents' => 0, 'secretary' => 0];
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
        }elseif($rol->id == 3){

        }elseif($rol->id == 4){
            $roles = ['students' => 0, 'teacher' => 0, 'parents' => 0, 'secretary' => 0];
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
        }elseif($rol->id == 5){
            $hoy = date('Y-m-d 00:00:00');
            $estados = ['Calificado' => 0, 'Entregado' => 0, 'Vencido' => 0, 'Pendiente' => 0];
            $tareas = Homework::join('themes_time','themes_time.id','homework.id_theme_time')
                                ->leftJoin('archives_homework','archives_homework.id','homework.id')
                                ->join('course','course.id','homework.id_course')
                                ->join('teacher_course','teacher_course.id_course','course.id')
                                ->join('list_students','list_students.id','course.id_list_students')
                                ->leftJoin('users_list_students','users_list_students.id_list_students','list_students.id')
                                ->join('users','users.id','teacher_course.id_users')
                                ->leftJoin('homework_course', function ($join) {
                                    $join->on('homework_course.id_homework', '=', 'homework.id');
                                    $join->on('homework_course.id_student', '=', 'users_list_students.id_users');
                                })
                                ->leftJoin('notes_homework', function ($join) {
                                    $join->on('notes_homework.id_homework', '=', 'homework.id');
                                    $join->on('notes_homework.id_student', '=', 'users_list_students.id_users');
                                })
                                ->leftJoin('parcial_notes','parcial_notes.id','notes_homework.id_parcial_notes')
                                ->select('themes_time.name as name_theme','users.name as name_students','users.last_name as last_name_students','homework.id as id_homework','homework.limit_time','homework_course.id as id_homework_course','parcial_notes.value as nota')
                                ->where('users_list_students.id_users',Auth::user()->id)
                                ->where('homework.start_time','<=',$hoy)
                                ->groupBy('homework.id')
                                ->get();
            foreach ($tareas as $key => $val) {
                $val->limit_time = date('Y-m-d',strtotime($val->limit_time));
                if($val->nota != null){
                    $val->status = "Calificado";
                    $estados['Calificado'] += 1;
                }elseif($val->id_homework_course){
                    $val->status = "Entregado";
                    $estados['Entregado'] += 1;
                }elseif(date('Y-m-d',strtotime($val->limit_time)) < date('Y-m-d')){
                    $val->status = "Vencido";
                    $estados['Vencido'] += 1;
                }else{
                    $val->status = "Pendiente";
                    $estados['Pendiente'] += 1;
                }
            }

            return view('welcome', array('rol'=>$rol, 'estados'=>$estados));
        }elseif($rol->id == 6){
            
        }
    }
}
