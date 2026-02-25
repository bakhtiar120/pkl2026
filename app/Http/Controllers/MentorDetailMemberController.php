<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\Bidang;
use App\Models\ProfilMember; 
use Fakultas;
use File;
use Validator;
use Periode; 
use KuotaPendaftaran;
use Pendaftaran;

class MentorDetailMemberController extends Controller
{
  function profil_member(Request $request){
      try{ 
        $data = ProfilMember::where('id',$request->id)->first();
        return response()->json(["status" => "success", "message" => "oke", "data" => $data ? $data : null]); 
      }
      catch (Exception $e) {
      return response()->json(["status" => "error", "message" => $e->getMessage() ]); 
    }
  }  
  function get_pendaftaran(Request $request)
  {
    try {  
      $data = Pendaftaran::leftJoin('kuota_pendaftaran','pendaftaran.id_kuota','=','kuota_pendaftaran.id')
      ->leftJoin('bidang','kuota_pendaftaran.id_bidang','=','bidang.id')
      ->where('pendaftaran.id_profil',$request->id)
      ->select('pendaftaran.*','bidang.nama_bidang')
      ->first();
      
      return response()->json(["status" => "success", "message" => "sukses", "data" =>$data]);
    } catch (Exception $e) {
      return response()->json(["status" => "error", "message" => $e->getMessage()]);
    } 
  } 
}