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
        $room=DB::table('room')
        ->join('list_students as ls','ls.id','room.id_list_students')
        ->join('users as u','u.id','room.id_teacher')
        ->join('subjects as s','s.id','room.id_subject')
        ->join('video_chat as vc','vc.id','room.id_video_chat')
        ->select('u.name as nombre','u.last_name as apellido','ls.name as listado','s.name as asignatura','vc.code',DB::raw('IF(vc.status=1,"HABILITADO","INHABILITADO") as status'),'vc.start_date as fecha','room.id')
        ->get();
        return view('sala.index',compact('room'));
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
        $code=  md5(sha1(date('Y-m-d H:i:s')."-".Auth::user()->id));
        $id_video_chat=DB::table('video_chat')
        ->insertGetId([
            'code'=>$code,
            'start_date'=>date('Y-m-d H:i:s'),
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

    public function ingresarSala($id){
        extract($_POST);
        $id=decrypt($id);

        $room=DB::table('room')
        ->join('list_students as ls','ls.id','room.id_list_students')
        ->join('users as u','u.id','room.id_teacher')
        ->join('subjects as s','s.id','room.id_subject')
        ->join('video_chat as vc','vc.id','room.id_video_chat')
        ->where('room.id',$id)
        ->first();
        $tipo=DB::table('users')->join('rol','users.id_rol','rol.id')->where('users.id',Auth::user()->id)->first()->name;
        return view('sala.enter',compact('id','tipo','room'));
    }

    public function cambiarEstado(){
        extract($_POST);
        $id=decrypt($id);
        $id_video_chat=DB::table('room')->where('id',$id)->select('id_video_chat')->first()->id_video_chat;
        $status=DB::table('video_chat')->where('id',$id_video_chat)->first()->status;
        DB::table('video_chat')->where('id',$id_video_chat)->update(['status'=>(!$status)]);
        return redirect()->back();
    }

    public function getEditarSala(){

    }

    public function editarSala(){
        
    }

}