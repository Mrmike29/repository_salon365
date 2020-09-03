<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Hash;
use Auth;
use Mail;
class SalaController extends Controller
{
    public function index()
    {


        $tipo=DB::table('users')->join('rol','users.id_rol','rol.id')->where('users.id',Auth::user()->id)->first()->name;
        if ($tipo=="Estudiante") {
            $users_list_students=DB::table('users')->join('rol','users.id_rol','rol.id')->join('users_list_students','users.id','users_list_students.id_users')->where('users.id',Auth::user()->id)->select('users_list_students.id_list_students')->first()->id_list_students ;
        }
        $room=DB::table('room')
        ->join('list_students as ls','ls.id','room.id_list_students')
        ->join('users as u','u.id','room.id_teacher')
        ->join('subjects as s','s.id','room.id_subject')
        ->join('video_chat as vc','vc.id','room.id_video_chat');
       
        if ($tipo=="Estudiante") {
            $room=$room->where('room.id_list_students',$users_list_students);
        }
        $asignatura=DB::table('subjects')->get();
        $curso=DB::table('list_students')->get();
        $teacher=DB::table('users')->where('id_rol',4)->get();
        $room=$room->select('u.name as nombre','u.last_name as apellido','ls.name as listado','s.name as asignatura','vc.code',DB::raw('IF(vc.status=1,"HABILITADO","INHABILITADO") as status'),'vc.start_date as fecha','room.id')
        ->get();
        return view('sala.index',compact('room','tipo','asignatura','curso','teacher'));
    }

    public function getCrearSala(){
        $lista=DB::table('list_students')
        ->get();

        $asignatura=DB::table('subjects')
        ->get();

        return view('sala.create',compact('lista','asignatura'));
    }

    public function crearSala(){
        extract($_POST);
        $code= md5(sha1(date('Y-m-d H:i:s')."-".Auth::user()->id));
        $fecha_videochat=date('Y-m-d H:i:s',strtotime($start_date." ".$hora));
        
        $id_video_chat=DB::table('video_chat')
        ->insertGetId([
            'code'=>$code,
            'start_date'=>$start_date." ".$hora,
            'time_stop'=>40,
            'status'=>1
        ]);
        DB::table('room')
        ->insert([
            'id_teacher'=>Auth::user()->id,
            'id_list_students'=>$id_list_students,
            'id_subject'=>$id_subject,
            'id_video_chat'=>$id_video_chat,
            'description'=>$description,
            'time'=>'30'

        ]);
        return redirect()->back();
    }

    public function room_filter(){
        extract($_GET);
        $tipo=DB::table('users')->join('rol','users.id_rol','rol.id')->where('users.id',Auth::user()->id)->first()->name;
        if ($tipo=="Estudiante") {
            $users_list_students=DB::table('users')->join('rol','users.id_rol','rol.id')->join('users_list_students','users.id','users_list_students.id_users')->where('users.id',Auth::user()->id)->select('users_list_students.id_list_students')->first()->id_list_students ;
        }
        $room=DB::table('room')
        ->join('list_students as ls','ls.id','room.id_list_students')
        ->join('users as u','u.id','room.id_teacher')
        ->join('subjects as s','s.id','room.id_subject')
        ->join('video_chat as vc','vc.id','room.id_video_chat');
        if (!empty($id_teacher)) {
            $room=$room->where('room.id_teacher',$id_teacher);
        }
        if (!empty($id_curso)) {
            $room=$room->where('room.id_list_students',$id_curso);
        }
        if (!empty($id_subjects)) {
            $room=$room->where('room.id_subject',$id_subjects);
        }
        if ($tipo=="Estudiante") {
            // $teacher=DB::table('room')->where('room.id_list_students',$users_list_students)->get();
            $room=$room->where('room.id_list_students',$users_list_students);
        }
        $room=$room->select('u.name as nombre','u.last_name as apellido','ls.name as listado','s.name as asignatura','vc.code',DB::raw('IF(vc.status=1,"HABILITADO","INHABILITADO") as status'),'vc.start_date as fecha','room.id')
        ->get();
        return view('sala.filter_room',compact('room','tipo'));
    }

    public function ingresarSala($id){
        extract($_POST);
        $id=decrypt($id);
        unset($_SESSION['sala']);
        $room=DB::table('room')
        ->join('list_students as ls','ls.id','room.id_list_students')
        ->join('users as u','u.id','room.id_teacher')
        ->join('subjects as s','s.id','room.id_subject')
        ->join('video_chat as vc','vc.id','room.id_video_chat')
        ->where('room.id',$id)
        ->select('room.*','vc.start_date','vc.code')
        ->first();
        $code=$room->code;
        if (date('Y-m-d',strtotime($room->start_date)) < date('Y-m-d') ) {
            return redirect()->back();
        }


        $tipo=DB::table('users')->join('rol','users.id_rol','rol.id')->where('users.id',Auth::user()->id)->first()->name;
        return view('sala.enter',compact('id','tipo','room','code'));
    }

    public function cambiarEstado(){
        extract($_POST);
        $id=decrypt($id);
        $id_video_chat=DB::table('room')->where('id',$id)->select('id_video_chat')->first()->id_video_chat;
        $status=DB::table('video_chat')->where('id',$id_video_chat)->first()->status;
        DB::table('video_chat')->where('id',$id_video_chat)->update(['status'=>(!$status)]);
        return redirect()->back();
    }

    public function getEditarSala($id){
        $lista=DB::table('list_students')
        ->get();

        $asignatura=DB::table('subjects')
        ->get();
        $id=decrypt($id);
        $room=DB::table('room')
        ->join('video_chat as vc','vc.id','room.id_video_chat')
        ->where('room.id',$id)
        ->select('room.*','vc.start_date','vc.id as id_video_chat')
        ->get();

        return view('sala.edit',compact('lista','asignatura','room'));
    }

    public function editarSala(){
        extract($_POST);
        $id_room=decrypt($id_room);
        $id_video_chat=decrypt($id_video_chat);
        // $code=  md5(sha1(date('Y-m-d H:i:s')."-".Auth::user()->id));
        DB::table('video_chat')
        ->where('id',$id_video_chat)
        ->update([
            'start_date'=>$start_date." ".$hora,
            'time_stop'=>40,
            'status'=>1
        ]);

        DB::table('room')
        ->where('id',$id_room)
        ->update([
            'id_list_students'=>$id_list_students,
            'id_subject'=>$id_subject,
            'id_video_chat'=>$id_video_chat,
            'description'=>$description,
            'time'=>'30'
        ]);
        return redirect()->back();
    }


}