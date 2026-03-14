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
use Illuminate\Support\Facades\DB;

class ProfilMemberController extends Controller
{
    function insert_pendaftaran(Request $request){ 
        try {  
           $data = ProfilMember::updateOrCreate(
             [
               'id' => $request->id,
             ],[
            'user_id'=>$request->user_id,
            'id_program_studi'=>$request->id_program_studi,
            'agama'=>$request->agama,
            'alamat'=>$request->alamat,
            'email_dosen_pembimbing'=>$request->email_dosen_pembimbing,
            'alamat_perguruan_tinggi'=>$request->alamat_perguruan_tinggi, 
            'jenis_kelamin'=>$request->jenis_kelamin,
            'jenis_kelamin_dosen_pembimbing'=>$request->jenis_kelamin_dosen_pembimbing,
            'nama_dosen_pembimbing'=>$request->nama_dosen_pembimbing,
            'nama_lengkap'=>$request->nama_lengkap,
            'nama_perguruan_tinggi'=>$request->nama_perguruan_tinggi,
            'nomor_handphone'=>$request->nomor_handphone,
            'nomor_handphone_dosen_pembimbing'=>$request->nomor_handphone_dosen_pembimbing,
            'tanggal_lahir'=>$request->tanggal_lahir,
            'tempat_lahir'=>$request->tempat_lahir,
            'nim'=>$request->nim,
            'program_studi'=>$request->program_studi,
            'fakultas'=>$request->fakultas,
            'kota_universitas'=>$request->kota_universitas,
          ]); 
            return response()->json(["status" => "success", "message" => "Pendaftaran sukses", 'data' => $data]);
          } 
          catch (Exception $e) {
            return response()->json(["status" => "error", "message" => $e->getMessage() ]); 
          } 
    } 

  function profil_member(Request $request){
      try{ 
        $data = ProfilMember::where('user_id',Auth::user()->id)->first();
        return response()->json(["status" => "success", "message" => "oke", "data" => $data ? $data : null]); 
      }
      catch (Exception $e) {
      return response()->json(["status" => "error", "message" => $e->getMessage() ]); 
    }
  } 

  function upload_berkas(Request $request){  
      try {
        $validatedData = $request->validate(['file' => 'required|mimes:pdf|max:5000',]); 
        $path = '/upload/berkas/';
        $file = $request->file('file');
        $extension = $file->getClientOriginalExtension();
        $new_name = microtime(true).".".$extension; 
        $upload = $file->move(public_path($path), $new_name);
        ProfilMember::where('user_id',Auth::user()->id)->update(['bekas_syarat_pendaftaran' => $path.$new_name]);
        return response()->json(["status" => "success", "message" => "File Berhasil Di Upload", "data" => $path.$new_name]);        
      } catch (Exception $e) {
        return response()->json(["status" => "error", "message" => $e->getMessage() ]);
      }
    }
 

  function upload_pasfoto(Request $request) {
      try {
        $validatedData = $request->validate(['file' => 'required|mimes:jpg,png|max:500',]);
        $dir = $request->dir;
        $path = '/upload/pasfoto/';
        $file = $request->file('file');
        $extension = $file->getClientOriginalExtension();
        $new_name =  microtime(true).".".$extension; 
        $upload = $file->move(public_path($path), $new_name); 
        ProfilMember::where('user_id',Auth::user()->id)->update(['berkas_pas_foto' => $path.$new_name]);
        return response()->json(["status" => "success", "message" => "File Berhasil Di Upload", "data" =>$path.$new_name]);
      } catch (Exception $e) {
        return response()->json(["status" => "error", "message" => $e->getMessage()]);
      } 
    }


    function list_priode_pendaftaran_aktif(Request $request) {
      try {
        $tgl_sekarang = date('Y-m-d');
        $data = Periode::where('tgl_mulai_pendaftaran','<=',$tgl_sekarang)->where('tgl_selesai_pendaftaran','>=',$tgl_sekarang)->get() ;
        return response()->json(["status" => "success", "message" => "sukses", "data" =>$data]);
      } catch (Exception $e) {
        return response()->json(["status" => "error", "message" => $e->getMessage()]);
      } 
    }

    function list_priode_pendaftaran_aktif_admin(Request $request) {
      try {
        $tgl_sekarang = date('Y-m-d');
        $data = Periode::get() ;
        return response()->json(["status" => "success", "message" => "sukses", "data" =>$data]);
      } catch (Exception $e) {
        return response()->json(["status" => "error", "message" => $e->getMessage()]);
      } 
    }


    function list_kuota(Request $request) {
      try {
        // $data = KuotaPendaftaran::leftJoin('bidang', 'kuota_pendaftaran.id_bidang','=','bidang.id')
        //         ->where('kuota_pendaftaran.id_periode',$request->id_periode)
        //         ->select('kuota_pendaftaran.*','bidang.nama_bidang')->get();
               $data = DB::table('kuota_pendaftaran')
        ->join('bidang', 'bidang.id', '=', 'kuota_pendaftaran.id_bidang')
        ->where('kuota_pendaftaran.id_periode', $request->id_periode)
        ->where('kuota_pendaftaran.id_unit_bidang', $request->unit)
        ->where('kuota_pendaftaran.jumlah_kuota', '>', 0)
        ->select(
            'kuota_pendaftaran.id',
            'bidang.nama_bidang',
            'kuota_pendaftaran.jumlah_kuota'
        )
        ->get();
        return response()->json(["status" => "success", "message" => "sukses", "data" =>$data]);
      } catch (Exception $e) {
        return response()->json(["status" => "error", "message" => $e->getMessage()]);
      } 
    }

    public function list_unit_kerja(Request $request)
{
    try {
        // $data = KuotaPendaftaran::leftJoin('bidang', 'kuota_pendaftaran.id_bidang','=','bidang.id')
        //         ->where('kuota_pendaftaran.id_periode',$request->id_periode)
        //         ->select('kuota_pendaftaran.*','bidang.nama_bidang')->get();
                 $data = DB::table('kuota_pendaftaran')
        ->join('unit_bidangs', 'unit_bidangs.id', '=', 'kuota_pendaftaran.id_unit_bidang')
        ->where('kuota_pendaftaran.id_periode', $request->id_periode)
        ->select('unit_bidangs.id', 'unit_bidangs.name')
        ->distinct()
        ->get();
        return response()->json(["status" => "success", "message" => "sukses", "data" =>$data]);
      } catch (Exception $e) {
        return response()->json(["status" => "error", "message" => $e->getMessage()]);
      } 
}

    function simpan_pendaftaran(Request $request){
      try { 
        $data = Pendaftaran::updateOrCreate(
          [
            'id_profil' => $request->id_profil,
          ],[
         'id_kuota'=>$request->id_kuota,
         'status_pendaftaran'=>'Proses'
       ]); 

       $data2 = Bidang::select('bidang.nama_bidang')
                            ->leftJoin('kuota_pendaftaran','bidang.id','=','kuota_pendaftaran.id_bidang')
                            ->where('kuota_pendaftaran.id',$request->id_kuota)
                            ->first();

        return response()->json(["status" => "success", "message" => "sukses", "data" =>$data2,"data1" =>$data]);
      } catch (Exception $e) {
        return response()->json(["status" => "error", "message" => $e->getMessage()]);
      } 
    }

    function simpan_pendaftaran_admin(Request $request){
      try { 
        $data = Pendaftaran::updateOrCreate(
          [
            'id_profil' => $request->id_profil,
          ],[
         'id_kuota'=>$request->id_kuota, 
       ]);  

        return response()->json(["status" => "success", "message" => "sukses" ,"data" =>$data]);
      } catch (Exception $e) {
        return response()->json(["status" => "error", "message" => $e->getMessage()]);
      } 
    }

    function validasi_pendaftaran(Request $request){
      try { 

        $id_pendaftaran =  ProfilMember::Join('pendaftaran','profil_member.id','=','pendaftaran.id_profil')
                          ->where('profil_member.user_id',Auth::user()->id)
                          ->select('pendaftaran.id as id_pendaftaran') 
                          ->first();
        $data = Pendaftaran::where('id', $id_pendaftaran->id_pendaftaran)->update(['status_pendaftaran'=>'Belum Verifikasi']);
       
        return response()->json(["status" => "success", "message" => "sukses", "data" =>$id_pendaftaran]);
      } catch (Exception $e) {
        return response()->json(["status" => "error", "message" => $e->getMessage()]);
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