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
        $room=DB::table('room')
        ->join('list_students as ls','ls.id','room.id_list_students')
        ->join('users as u','u.id','room.id_teacher')
        ->join('subjects as s','s.id','room.id_subject')
        ->join('video_chat as vc','vc.id','room.id_video_chat')
        ->select('u.name as nombre','u.last_name as apellido','ls.name as listado','s.name as asignatura','vc.code',DB::raw('IF(vc.status=1,"HABILITADO","INHABILITADO") as status'),'vc.start_date as fecha','room.id')
        ->get();
        return view('sala.index',compact('room','tipo'));
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

    public function ingresarSala($id){
        extract($_POST);
        $id=decrypt($id);

        $room=DB::table('room')
        ->join('list_students as ls','ls.id','room.id_list_students')
        ->join('users as u','u.id','room.id_teacher')
        ->join('subjects as s','s.id','room.id_subject')
        ->join('video_chat as vc','vc.id','room.id_video_chat')
        ->where('room.id',$id)
        ->select('room.*','vc.start_date')
        ->first();


        if (date('Y-m-d',strtotime($room->start_date)) < date('Y-m-d') ) {
            return redirect()->back();
        }


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