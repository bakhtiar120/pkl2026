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
use DB;
use Response;

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

    public function chart(Request $request)
    {
      try {  
        $data['chart1'] =  DB::select("SELECT DATE_FORMAT(profil_member.created_at, '%M %Y') label, COUNT(CONCAT(YEAR(profil_member.created_at),'-',MONTH(profil_member.created_at))) as total
                                    FROM profil_member 
                                    JOIN pendaftaran ON profil_member.id = pendaftaran.id_profil
                                    GROUP BY CONCAT(YEAR(profil_member.created_at),'-',MONTH(profil_member.created_at)) ");




        $data['chart2'] =  DB::select("SELECT COUNT(*) total, fakultas FROM profil_member GROUP BY fakultas");
        $data['count']['Proses'] =  DB::select("SELECT COUNT(*) d  FROM pendaftaran WHERE status_pendaftaran = 'Proses'");
        $data['count']['BelumVerifikasi'] =  DB::select("SELECT COUNT(*) d  FROM pendaftaran WHERE status_pendaftaran = 'Belum Verifikasi'");
        $data['count']['Lolos'] =  DB::select("SELECT COUNT(*) d  FROM pendaftaran WHERE status_pendaftaran = 'Lolos'");
        $data['count']['TidakLolos'] =  DB::select("SELECT COUNT(*) d  FROM pendaftaran WHERE status_pendaftaran = 'Tidak Lolos'"); 

        return response()->json(["status" => "success", "message" => "sukses", "data" => $data]);
      } catch (Exception $e) {
        return response()->json(["status" => "error", "message" => $e->getMessage()]);
      } 
    } 

    
}


