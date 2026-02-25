<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use ProfilMember;
use User;
use Auth;
use PenugasanTambahan;

class UsersPenugasanController extends Controller
{
 
   function get(){
      try{ 

         $data = User::join('profil_member','users.id', '=', 'profil_member.user_id')
         ->where('users.id',Auth::user()->id)
         ->select('profil_member.*')
         ->first();          
         return response()->json(["status" => "success", "message" => "oke", "data" => $data ? $data : null]); 
       }
       catch (Exception $e) {
       return response()->json(["status" => "error", "message" => $e->getMessage() ]); 
      }
     }

     function get_tambahan(){
      try{ 

         $data = PenugasanTambahan::join('profil_member','profil_member.id','=','penugasan_tambahan.id_profil')
         ->where('profil_member.user_id',Auth::user()->id)->select('penugasan_tambahan.*')->get();
         return response()->json(["status" => "success", "message" => "oke", "data" => $data ? $data : null]); 
       }
       catch (Exception $e) {
       return response()->json(["status" => "error", "message" => $e->getMessage() ]); 
      }
     }

     function upload_file_penugasan_tambahan(Request $request){
      try{
 
         
         $validatedData = $request->validate([  
            // 'file'=>'required|max:10240',           
            'file'=>'required',           
            'id'=>'required',           
         ]); 

         $path = '/upload/file_penugasan_tambahan/';
         $file = $request->file('file');
         $extension = $file->getClientOriginalExtension();
         $new_name = microtime(true).".".$extension; 
         $upload = $file->move(public_path($path), $new_name);   

         $data = PenugasanTambahan::where('id',$request->id)->update([ 
            'file' => $path.$new_name, 
        ]);
         return response()->json(["status" => "success", "message" => "oke", "data" => $data ? $data : null]); 
       }
       catch (Exception $e) {
       return response()->json(["status" => "error", "message" => $e->getMessage() ]); 
      }
     }

     function upload_file_penugasan(Request $request){
      try{
 
         
         $validatedData = $request->validate([  
            // 'file'=>'required|max:10240',           
            'file'=>'required',           
            'id_profil'=>'required',           
            'col'=>'required|in:presentasi_akhir_pelaksanaan,penugasan_laporan_akhir,penugasan_paper,penugasan_poster,penugasan_ringkasan_bidang_mentor,penugasan_vidio_budaya_perusahaan',           
         ]); 

         $path = '/upload/file_penugasan/';
         $file = $request->file('file');
         $extension = $file->getClientOriginalExtension();
         $new_name = microtime(true).".".$extension; 
         $upload = $file->move(public_path($path), $new_name);   

         $data = ProfilMember::find($request->id_profil)->update([  
            $request->col => $path.$new_name
        ]);
         return response()->json(["status" => "success", "message" => "oke", "data" => $data ? $data : null]); 
       }
       catch (Exception $e) {
       return response()->json(["status" => "error", "message" => $e->getMessage() ]); 
      }
     }

   
 
}
