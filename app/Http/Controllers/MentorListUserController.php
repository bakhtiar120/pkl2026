<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use ProfilMember;

class MentorListUserController extends Controller
{

   function update_scor(Request $request){ 
      try {
        $validatedData = $request->validate([ 
           'id'=>'required',
           'skor_integritas'=>'required|numeric',
            'skor_pengembagan_diri'=> 'required|numeric',
            'skor_kreatifitas'=>'required|numeric',
            'skor_komunikasi'=>'required|numeric',
            'skor_analisis'=> 'required|numeric',
            'skor_kerja_sama'=> 'required|numeric',
            'skor_pemahaman'=> 'required|numeric',
            'skor_presentasi'=>'required|numeric',           
           ]); 
    
        ProfilMember::where('id',$request->id)->update([
            'skor_integritas'=> $request->skor_integritas,
            'skor_pengembagan_diri'=> $request->skor_pengembagan_diri,
            'skor_kreatifitas'=> $request->skor_kreatifitas,
            'skor_komunikasi'=> $request->skor_komunikasi,
            'skor_analisis'=> $request->skor_analisis,
            'skor_kerja_sama'=> $request->skor_kerja_sama,
            'skor_pemahaman'=> $request->skor_pemahaman,
            'skor_presentasi'=> $request->skor_presentasi,         
         ]);
        return response()->json(["status" => "success", "message" => "Update Berhasil ", "data" =>null]);        
      } catch (Exception $e) {
        return response()->json(["status" => "error", "message" => $e->getMessage() ]);
      }
    }
 

   function get_list_user(){
      try{ 
         $data = ProfilMember::join('pendaftaran','pendaftaran.id_profil','=','profil_member.id')->select('profil_member.*')->where('pendaftaran.status_pendaftaran','Lolos')->get();
         return response()->json(["status" => "success", "message" => "oke", "data" => $data ? $data : null]); 
       }
       catch (Exception $e) {
       return response()->json(["status" => "error", "message" => $e->getMessage() ]); 
      }
     }


   
 
}
