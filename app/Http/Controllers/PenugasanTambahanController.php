<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use ProfilMember;
use PenugasanTambahan;
use Illuminate\Support\Facades\DB;

class PenugasanTambahanController extends Controller
{ 
   
     function get_penugasan_tambahan(Request $request){
      try{ 
         $data = PenugasanTambahan::where('id_profil',$request->id)->get();
         return response()->json(["status" => "success", "message" => "oke", "data" => $data ? $data : null]); 
       }
       catch (Exception $e) {
       return response()->json(["status" => "error", "message" => $e->getMessage() ]); 
      }
     }

     function get_profile_member(Request $request){
      try{ 
         $data = ProfilMember::find($request->id);
         return response()->json(["status" => "success", "message" => "oke", "data" => $data ? $data : null]); 
       }
       catch (Exception $e) {
       return response()->json(["status" => "error", "message" => $e->getMessage() ]); 
      }
     }

     function tambah_penugasan_tambahan(Request $request){
      try{ 
         $validatedData = $request->validate([ 
            'id_profil'=>'required',
            'nama'=>'required|string',
            'deskripsi'=> 'required|string',       
         ]);  
         $data = PenugasanTambahan::create([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            // 'file' => $path.$new_name,
            'id_profil' => $request->id_profil,
        ]);
         return response()->json(["status" => "success", "message" => "oke", "data" => $data ? $data : null]); 
       }
       catch (Exception $e) {
       return response()->json(["status" => "error", "message" => $e->getMessage() ]); 
      }
     } 
     function edit_penugasan_tambahan(Request $request){
      try{ 
         $validatedData = $request->validate([ 
            'id'=>'required',
            'nama'=>'required|string',
            'deskripsi'=> 'required|string',          
         ]);    
         $data = PenugasanTambahan::where('id', $request->id)->update([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi, 
            'id' => $request->id,
        ]);
         return response()->json(["status" => "success", "message" => "oke", "data" => $data ? $data : null]); 
       }
       catch (Exception $e) {
       return response()->json(["status" => "error", "message" => $e->getMessage() ]); 
      }
     }

     function hapus_penugasan_tambahan(Request $request){
      try{
         
         $validatedData = $request->validate([ 
            'id'=>'required',        
         ]);   
         $data = PenugasanTambahan::find($request->id);
         $data->delete();
         return response()->json(["status" => "success", "message" => "oke", "data" => null]); 
       }
       catch (Exception $e) {
       return response()->json(["status" => "error", "message" => $e->getMessage() ]); 
      }
     }  
}
