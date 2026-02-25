<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use ProfilMember;

class AdminListUserController extends Controller
{

   
 

   function get_list_user(Request $r){
      try{ 
         $data = ProfilMember::join('pendaftaran','pendaftaran.id_profil','=','profil_member.id')->select('profil_member.*')->where('pendaftaran.status_pendaftaran',$r->status_pendaftaran)->get();
         return response()->json(["status" => "success", "message" => "oke", "data" => $data ? $data : null]); 
       }
       catch (Exception $e) {
       return response()->json(["status" => "error", "message" => $e->getMessage() ]); 
      }
     }
}

 
 
