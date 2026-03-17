<?php

namespace App\Http\Controllers;

use App\Mail\PklEmail;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\Bidang;
use App\Models\UnitBidang;
use App\Models\Periode;
use App\Models\KuotaPendaftaran;
use App\Models\Pendaftaran;
use App\Models\ProfilMember;
use App\Models\FileUpload;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
// use Barryvdh\DomPDF\Facade\Pdf;
use Dompdf\Dompdf;
use PDF;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail as Mail;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class AdminController extends Controller
{
    function index()
    {

        return view('dashboards.admins.page.home');
    }
    function test_email()
    {
      $details = [
	'title'=>'Pengumuman',
	'body'=>'ini body',
	'nama'=>'Dark System',
	'instansi'=>'Land of Dawn',
	'url'=>'https://study.indonesiapowerkmj.com/pdf/test/5/',
	'jenis'=>'Ditolak'
      ];
      Mail::to('oetjandra@gmail.com','Bakhtiar')->send(new PklEmail($details));
    }
    function home()
    {

        return view('dashboards.admins.page.home');
    }
   public function pendaftaran_berjalan()
{
    $periodes = DB::table('periode as pe')
        ->join('kuota_pendaftaran as kp', 'pe.id', '=', 'kp.id_periode')
        ->leftJoin('pendaftaran as p', function ($join) {
            $join->on('kp.id', '=', 'p.id_kuota')
                 ->where('p.status_pendaftaran', 'Lolos');
        })
        // ->leftJoin('unit_bidangs as u', 'p.id_unit_kerja', '=', 'u.id')
        ->where('pe.tgl_selesai_pendaftaran', '>=', now()->toDateString())
        ->groupBy(
            'pe.id',
            'pe.tgl_mulai_pendaftaran',
            'pe.tgl_selesai_pendaftaran',
            'pe.tgl_mulai_pelaksanaan',
            'pe.tgl_selesai_pelaksanaan'
        )
        ->select(
            'pe.id',
            'pe.tgl_mulai_pendaftaran',
            'pe.tgl_selesai_pendaftaran',
            'pe.tgl_mulai_pelaksanaan',
            'pe.tgl_selesai_pelaksanaan',
            DB::raw('COUNT(p.id) as jumlah_lolos'),
            DB::raw('SUM(kp.jumlah_kuota) as jumlah_kuota'),
        )
        ->whereNull('kp.deleted_at')
        ->orderBy('pe.tgl_mulai_pendaftaran', 'desc')
        ->get();

    return view('dashboards.admins.page.pendaftaran', compact('periodes'));
}
    function tugas_peserta()
    {
        // $periodes = Periode::latest()->get();
        //$periodes = DB::select("SELECT DISTINCT pe.tgl_mulai_pendaftaran as tgl_mulai_pendaftaran, pe.tgl_selesai_pendaftaran as tgl_selesai_pendaftaran, pe.tgl_mulai_pelaksanaan as tgl_mulai_pelaksanaan, pe.tgl_selesai_pelaksanaan as tgl_selesai_pelaksanaan,pe.id as id FROM periode pe, kuota_pendaftaran kp WHERE pe.id=kp.id_periode AND pe.tgl_selesai_pendaftaran>=CURDATE()");
        $periodes = DB::select("SELECT DISTINCT pe.tgl_mulai_pendaftaran as tgl_mulai_pendaftaran, pe.tgl_selesai_pendaftaran as tgl_selesai_pendaftaran, pe.tgl_mulai_pelaksanaan as tgl_mulai_pelaksanaan, pe.tgl_selesai_pelaksanaan as tgl_selesai_pelaksanaan,pe.id as id FROM periode pe, kuota_pendaftaran kp WHERE pe.id=kp.id_periode ORDER BY pe.tgl_mulai_pendaftaran DESC");
        foreach ($periodes as $periode) {
            $kuotas = KuotaPendaftaran::where('id_periode', $periode->id)
                ->get();
            $jumlah = 0;
            foreach ($kuotas as $kuota) {
                $jumlah = $jumlah + Pendaftaran::where('id_kuota', $kuota->id)->where('status_pendaftaran', 'Lolos')->count();
            }
            $periode->jumlah_lolos = $jumlah;
            $periode->jumlah_kuota = KuotaPendaftaran::where('id_periode', $periode->id)
                ->sum('jumlah_kuota');
        }
        return view('dashboards.admins.page.tugas_peserta', compact('periodes'));
    }
   public function pendaftaran_selesai()
{
    $periodes = DB::table('periode as pe')
        ->join('kuota_pendaftaran as kp', 'pe.id', '=', 'kp.id_periode')
        ->leftJoin('pendaftaran as p', function ($join) {
            $join->on('kp.id', '=', 'p.id_kuota')
                 ->where('p.status_pendaftaran', 'Lolos');
        })
        // ->leftJoin('unit_bidangs as u', 'p.id_unit_kerja', '=', 'u.id')
        ->where('pe.tgl_selesai_pendaftaran', '<=', now()->toDateString())
        ->groupBy(
            'pe.id',
            'pe.tgl_mulai_pendaftaran',
            'pe.tgl_selesai_pendaftaran',
            'pe.tgl_mulai_pelaksanaan',
            'pe.tgl_selesai_pelaksanaan'
        )
        ->select(
            'pe.id',
            'pe.tgl_mulai_pendaftaran',
            'pe.tgl_selesai_pendaftaran',
            'pe.tgl_mulai_pelaksanaan',
            'pe.tgl_selesai_pelaksanaan',
            DB::raw('COUNT(p.id) as jumlah_lolos'),
            DB::raw('SUM(kp.jumlah_kuota) as jumlah_kuota')
        )
        ->orderBy('pe.tgl_mulai_pendaftaran', 'DESC')
        ->get();

    return view('dashboards.admins.page.pendaftaran_selesai', compact('periodes'));
}
    function nilai_peserta()
    {
        // $periodes = DB::select("SELECT DISTINCT pe.tgl_mulai_pendaftaran as tgl_mulai_pendaftaran, pe.tgl_selesai_pendaftaran as tgl_selesai_pendaftaran, pe.tgl_mulai_pelaksanaan as tgl_mulai_pelaksanaan, pe.tgl_selesai_pelaksanaan as tgl_selesai_pelaksanaan,pe.id as id FROM periode pe, kuota_pendaftaran kp WHERE pe.id=kp.id_periode AND pe.tgl_selesai_pendaftaran<=CURDATE()");
        $periodes = DB::select("SELECT DISTINCT pe.tgl_mulai_pendaftaran as tgl_mulai_pendaftaran, pe.tgl_selesai_pendaftaran as tgl_selesai_pendaftaran, pe.tgl_mulai_pelaksanaan as tgl_mulai_pelaksanaan, pe.tgl_selesai_pelaksanaan as tgl_selesai_pelaksanaan,pe.id as id FROM periode pe, kuota_pendaftaran kp WHERE pe.id=kp.id_periode ORDER BY pe.tgl_mulai_pendaftaran  DESC");
        foreach ($periodes as $periode) {
            $kuotas = KuotaPendaftaran::where('id_periode', $periode->id)
                ->get();
            $jumlah = 0;
            foreach ($kuotas as $kuota) {
                $jumlah = $jumlah + Pendaftaran::where('id_kuota', $kuota->id)->where('status_pendaftaran', 'Lolos')->count();
            }
            $periode->jumlah_lolos = $jumlah;
            $periode->jumlah_kuota = KuotaPendaftaran::where('id_periode', $periode->id)
                ->sum('jumlah_kuota');
        }
        return view('dashboards.admins.page.nilai_peserta', compact('periodes'));
    }
    function buat_pendaftaran()
    {
        $bidangs = Bidang::latest()->get();
         $unit_bidangs = UnitBidang::latest()->get();
        return view('dashboards.admins.page.buat_pendaftaran', compact('bidangs','unit_bidangs'));
    }
    public function edit_kuota_pendaftaran($id)
{
    $id_periode = $id;

    // semua unit untuk dropdown
    
        $unit_bidangs = UnitBidang::select('id','name')->get();

    // semua bidang untuk template
    $bidangs = DB::table('bidang')
        ->select('id', 'nama_bidang')
        ->get();

    // data kuota yang sudah ada
    $kuotas = DB::table('kuota_pendaftaran as ku')
        ->join('unit_bidangs as ub', 'ub.id', '=', 'ku.id_unit_bidang')
        ->join('bidang as bd', 'bd.id', '=', 'ku.id_bidang')
        ->where('ku.id_periode', $id)
        ->select(
            'ub.id as id_unit',
            'ub.name as nama_unit',
            'bd.id as id_bidang',
            'bd.nama_bidang',
            'ku.jumlah_kuota'
        )
        ->get();

    // group per unit supaya gampang dibuat tab
    $units = $kuotas->groupBy('id_unit');

    return view(
        'dashboards.admins.page.edit_kuota_pendaftaran',
        compact(
            'unit_bidangs',
            'bidangs',
            'units',
            'id_periode'
        )
    );
}

    function edit_bidang(Request $request)
    {
        $where = array('id' => $request->id);
        $book  = Bidang::where($where)->first();

        return response()->json($book);
    }
    function detail_periode($id)
    {
        $periodes = DB::select("SELECT DISTINCT pe.tgl_mulai_pendaftaran as tgl_mulai_pendaftaran, pe.tgl_selesai_pendaftaran as tgl_selesai_pendaftaran, pe.tgl_mulai_pelaksanaan as tgl_mulai_pelaksanaan, pe.tgl_selesai_pelaksanaan as tgl_selesai_pelaksanaan,SUM(kp.jumlah_kuota) as jumlah_kuota,pe.id as id FROM periode pe, kuota_pendaftaran kp WHERE pe.id=kp.id_periode AND pe.id={$id}");

        // $lolos = DB::select("SELECT COUNT(pen.id) as jumlah_lolos FROM pendaftaran Pen,kuota_pendaftaran kp WHERE kp.id_periode={$id} AND Pen.id_kuota=kp.id AND Pen.status_pendaftaran={$kata} ");
        $lolos1 = KuotaPendaftaran::join('pendaftaran', 'pendaftaran.id_kuota', '=', 'kuota_pendaftaran.id')
            ->where('kuota_pendaftaran.id_periode', $id)
            ->where([
                'kuota_pendaftaran.id_periode' => $id,
                'pendaftaran.status_pendaftaran' => 'Lolos',
            ])
            ->get();
        $bidangs = KuotaPendaftaran::join('bidang', 'bidang.id', '=', 'kuota_pendaftaran.id_bidang')
    ->join('unit_bidangs', 'unit_bidangs.id', '=', 'kuota_pendaftaran.id_unit_bidang')
    ->where('kuota_pendaftaran.id_periode', $id)
    ->select(
        'kuota_pendaftaran.id',
        'bidang.nama_bidang',
        'unit_bidangs.name',
        'kuota_pendaftaran.jumlah_kuota'
    )
    ->get();
        foreach ($bidangs as $bidang) {
            $bidang->jumlah_lolos = Pendaftaran::where('id_kuota', $bidang->id)->where('status_pendaftaran', 'Lolos')
                ->count();
        }
        return view('dashboards.admins.page.detail_periode', compact('periodes', 'lolos1', 'bidangs'));
    }
    function detail_tugas_peserta($id)
    {
        $periodes = DB::select("SELECT DISTINCT pe.tgl_mulai_pendaftaran as tgl_mulai_pendaftaran, pe.tgl_selesai_pendaftaran as tgl_selesai_pendaftaran, pe.tgl_mulai_pelaksanaan as tgl_mulai_pelaksanaan, pe.tgl_selesai_pelaksanaan as tgl_selesai_pelaksanaan,SUM(kp.jumlah_kuota) as jumlah_kuota,pe.id as id FROM periode pe, kuota_pendaftaran kp WHERE pe.id=kp.id_periode AND pe.id={$id}");

        // $lolos = DB::select("SELECT COUNT(pen.id) as jumlah_lolos FROM pendaftaran Pen,kuota_pendaftaran kp WHERE kp.id_periode={$id} AND Pen.id_kuota=kp.id AND Pen.status_pendaftaran={$kata} ");
        $lolos1 = KuotaPendaftaran::join('pendaftaran', 'pendaftaran.id_kuota', '=', 'kuota_pendaftaran.id')
            ->where('kuota_pendaftaran.id_periode', $id)
            ->where([
                'kuota_pendaftaran.id_periode' => $id,
                'pendaftaran.status_pendaftaran' => 'Lolos',
            ])
            ->get();
        $bidangs = KuotaPendaftaran::join('bidang', 'bidang.id', '=', 'kuota_pendaftaran.id_bidang')
            ->where('kuota_pendaftaran.id_periode', $id)
            ->select('bidang.nama_bidang', 'kuota_pendaftaran.jumlah_kuota', 'kuota_pendaftaran.id')
            ->get();
        foreach ($bidangs as $bidang) {
            $bidang->jumlah_lolos = Pendaftaran::where('id_kuota', $bidang->id)->where('status_pendaftaran', 'Lolos')
                ->count();
        }
        return view('dashboards.admins.page.detail_tugas_peserta', compact('periodes', 'lolos1', 'bidangs'));
    }
    function detail_bidang_pendaftaran($id)
    {
        $member = Pendaftaran::join('profil_member', 'pendaftaran.id_profil', '=', 'profil_member.id')

            ->where([
                'pendaftaran.id_kuota' => $id,
                'pendaftaran.status_pendaftaran' => 'Lolos',
            ])
            ->select('pendaftaran.*', 'profil_member.id as id_member', 'profil_member.created_at as created_at_', 'profil_member.nama_lengkap as nama_lengkap')
            ->get();
      $member_not_verified = Pendaftaran::join(
        'profil_member',
        'pendaftaran.id_profil',
        '=',
        'profil_member.id'
    )
    ->join(
        'kuota_pendaftaran',
        'pendaftaran.id_kuota',
        '=',
        'kuota_pendaftaran.id'
    )
    ->where([
        'pendaftaran.id_kuota' => $id,
        'pendaftaran.status_pendaftaran' => 'Belum Verifikasi',
    ])
    ->select(
        'pendaftaran.*',
        'kuota_pendaftaran.id_periode',
        'kuota_pendaftaran.id_unit_bidang as id_unit_kerja',
        'profil_member.id as id_member',
        'profil_member.created_at as created_at_',
        'profil_member.nama_lengkap'
    )
    ->get();

        $member_not_lolos = Pendaftaran::join('profil_member', 'pendaftaran.id_profil', '=', 'profil_member.id')

            ->where([
                'pendaftaran.id_kuota' => $id,
                'pendaftaran.status_pendaftaran' => 'Tidak Lolos',
            ])
            ->select('pendaftaran.*', 'profil_member.id as id_member', 'profil_member.created_at as created_at_', 'profil_member.nama_lengkap as nama_lengkap')
            ->get();
        // var_dump($member);
        $query_pendaftaran = KuotaPendaftaran::join('periode', 'kuota_pendaftaran.id_periode', '=', 'periode.id')
    ->join('bidang', 'kuota_pendaftaran.id_bidang', '=', 'bidang.id')
    ->join('unit_bidangs', 'kuota_pendaftaran.id_unit_bidang', '=', 'unit_bidangs.id')
    ->where('kuota_pendaftaran.id', $id)
    ->select(
        'periode.*',
        'bidang.nama_bidang',
        'unit_bidangs.name',
        'kuota_pendaftaran.jumlah_kuota'
    )
    ->first();
        // var_dump($query_pendaftaran);
        $jumlah_lolos = Pendaftaran::where('id_kuota', $id)->where('status_pendaftaran', 'Lolos')
            ->count();
        return view('dashboards.admins.page.detail_bidang_pendaftaran', compact('member', 'member_not_verified', 'member_not_lolos', 'query_pendaftaran', 'jumlah_lolos'));
    }

    function detail_tugas_peserta_bidang_pendaftaran($id)
    {
        $member = Periode::join('kuota_pendaftaran', 'kuota_pendaftaran.id_periode', '=', 'periode.id')
            ->join('pendaftaran', 'pendaftaran.id_kuota', '=', 'kuota_pendaftaran.id')
            ->join('profil_member', 'pendaftaran.id_profil', '=', 'profil_member.id')
            ->where([
                'periode.id' => $id,
                'pendaftaran.status_pendaftaran' => 'Lolos',
            ])
            ->select('pendaftaran.*', 'profil_member.*', 'profil_member.id as id_member', 'profil_member.created_at as created_at_', 'profil_member.nama_lengkap as nama_lengkap')
            ->get();
        $member_not_verified = Pendaftaran::join('profil_member', 'pendaftaran.id_profil', '=', 'profil_member.id')

            ->where([
                'pendaftaran.id_kuota' => $id,
                'pendaftaran.status_pendaftaran' => 'Belum Verifikasi',
            ])
            ->select('pendaftaran.*', 'profil_member.id as id_member', 'profil_member.created_at as created_at_', 'profil_member.nama_lengkap as nama_lengkap')
            ->get();

        $member_not_lolos = Pendaftaran::join('profil_member', 'pendaftaran.id_profil', '=', 'profil_member.id')

            ->where([
                'pendaftaran.id_kuota' => $id,
                'pendaftaran.status_pendaftaran' => 'Tidak Lolos',
            ])
            ->select('pendaftaran.*', 'profil_member.id as id_member', 'profil_member.created_at as created_at_', 'profil_member.nama_lengkap as nama_lengkap')
            ->get();
        // var_dump($member);
        $query_pendaftaran = KuotaPendaftaran::join('periode', 'kuota_pendaftaran.id_periode', '=', 'periode.id')

            ->where([
                'periode.id' => $id,
            ])
            ->select('periode.*')
            ->first();
        // var_dump($query_pendaftaran);
        $jumlah_lolos = Pendaftaran::where('id_kuota', $id)->where('status_pendaftaran', 'Lolos')
            ->count();
        return view('dashboards.admins.page.detail_tugas_peserta_bidang_pendaftaran', compact('member', 'member_not_verified', 'member_not_lolos', 'query_pendaftaran', 'jumlah_lolos'));
    }

    function detail_periode_selesai($id)
    {
        $periodes = DB::select("SELECT DISTINCT pe.tgl_mulai_pendaftaran as tgl_mulai_pendaftaran, pe.tgl_selesai_pendaftaran as tgl_selesai_pendaftaran, pe.tgl_mulai_pelaksanaan as tgl_mulai_pelaksanaan, pe.tgl_selesai_pelaksanaan as tgl_selesai_pelaksanaan,SUM(kp.jumlah_kuota) as jumlah_kuota,pe.id as id FROM periode pe, kuota_pendaftaran kp WHERE pe.id=kp.id_periode AND pe.id={$id}");

        // $lolos = DB::select("SELECT COUNT(pen.id) as jumlah_lolos FROM pendaftaran Pen,kuota_pendaftaran kp WHERE kp.id_periode={$id} AND Pen.id_kuota=kp.id AND Pen.status_pendaftaran={$kata} ");
        $lolos1 = KuotaPendaftaran::join('pendaftaran', 'pendaftaran.id_kuota', '=', 'kuota_pendaftaran.id')
            ->where('kuota_pendaftaran.id_periode', $id)
            ->where([
                'kuota_pendaftaran.id_periode' => $id,
                'pendaftaran.status_pendaftaran' => 'Lolos',
            ])
            ->get();
           $bidangs = KuotaPendaftaran::join('bidang', 'bidang.id', '=', 'kuota_pendaftaran.id_bidang')
        ->join('unit_bidangs', 'unit_bidangs.id', '=', 'kuota_pendaftaran.id_unit_bidang')
        ->leftJoin('pendaftaran', function ($join) {
            $join->on('pendaftaran.id_kuota', '=', 'kuota_pendaftaran.id')
                 ->where('pendaftaran.status_pendaftaran', 'Lolos');
        })
        ->where('kuota_pendaftaran.id_periode', $id)
        ->groupBy(
            'kuota_pendaftaran.id',
            'bidang.nama_bidang',
            'unit_bidangs.name',
            'kuota_pendaftaran.jumlah_kuota'
        )
        ->select(
            'kuota_pendaftaran.id',
            'bidang.nama_bidang',
            'unit_bidangs.name',
            'kuota_pendaftaran.jumlah_kuota',
            DB::raw('COUNT(pendaftaran.id) as jumlah_lolos')
        )
        ->get();
        foreach ($bidangs as $bidang) {
            $bidang->jumlah_lolos = Pendaftaran::where('id_kuota', $bidang->id)->where('status_pendaftaran', 'Lolos')
                ->count();
        }
        return view('dashboards.admins.page.detail_periode_selesai', compact('periodes', 'lolos1', 'bidangs'));
    }
    function detail_nilai_peserta($id)
    {
        $periodes = DB::select("SELECT DISTINCT pe.tgl_mulai_pendaftaran as tgl_mulai_pendaftaran, pe.tgl_selesai_pendaftaran as tgl_selesai_pendaftaran, pe.tgl_mulai_pelaksanaan as tgl_mulai_pelaksanaan, pe.tgl_selesai_pelaksanaan as tgl_selesai_pelaksanaan,SUM(kp.jumlah_kuota) as jumlah_kuota,pe.id as id FROM periode pe, kuota_pendaftaran kp WHERE pe.id=kp.id_periode AND pe.id={$id}");

        // $lolos = DB::select("SELECT COUNT(pen.id) as jumlah_lolos FROM pendaftaran Pen,kuota_pendaftaran kp WHERE kp.id_periode={$id} AND Pen.id_kuota=kp.id AND Pen.status_pendaftaran={$kata} ");
        $lolos1 = KuotaPendaftaran::join('pendaftaran', 'pendaftaran.id_kuota', '=', 'kuota_pendaftaran.id')
            ->where('kuota_pendaftaran.id_periode', $id)
            ->where([
                'kuota_pendaftaran.id_periode' => $id,
                'pendaftaran.status_pendaftaran' => 'Lolos',
            ])
            ->get();
        $bidangs = KuotaPendaftaran::join('bidang', 'bidang.id', '=', 'kuota_pendaftaran.id_bidang')
            ->where('kuota_pendaftaran.id_periode', $id)
            ->select('bidang.nama_bidang', 'kuota_pendaftaran.jumlah_kuota', 'kuota_pendaftaran.id')
            ->get();
        foreach ($bidangs as $bidang) {
            $bidang->jumlah_lolos = Pendaftaran::where('id_kuota', $bidang->id)->where('status_pendaftaran', 'Lolos')
                ->count();
        }
        return view('dashboards.admins.page.detail_nilai_peserta', compact('periodes', 'lolos1', 'bidangs'));
    }
    function detail_bidang_pendaftaran_selesai($id)
    {
        $member = Pendaftaran::join('profil_member', 'pendaftaran.id_profil', '=', 'profil_member.id')

            ->where([
                'pendaftaran.id_kuota' => $id,
                'pendaftaran.status_pendaftaran' => 'Lolos',
            ])
            ->select('pendaftaran.*', 'profil_member.id as id_member', 'profil_member.created_at as created_at_', 'profil_member.nama_lengkap as nama_lengkap')
            ->get();
        $member_not_verified = Pendaftaran::join('profil_member', 'pendaftaran.id_profil', '=', 'profil_member.id')

            ->where([
                'pendaftaran.id_kuota' => $id,
                'pendaftaran.status_pendaftaran' => 'Belum Verifikasi',
            ])
            ->select('pendaftaran.*', 'profil_member.id as id_member', 'profil_member.created_at as created_at_', 'profil_member.nama_lengkap as nama_lengkap')
            ->get();

        $member_not_lolos = Pendaftaran::join('profil_member', 'pendaftaran.id_profil', '=', 'profil_member.id')

            ->where([
                'pendaftaran.id_kuota' => $id,
                'pendaftaran.status_pendaftaran' => 'Tidak Lolos',
            ])
            ->select('pendaftaran.*', 'profil_member.id as id_member', 'profil_member.created_at as created_at_', 'profil_member.nama_lengkap as nama_lengkap')
            ->get();
        // var_dump($member);
        
            $query_pendaftaran = KuotaPendaftaran::join('periode', 'kuota_pendaftaran.id_periode', '=', 'periode.id')
    ->join('bidang', 'kuota_pendaftaran.id_bidang', '=', 'bidang.id')
    ->join('unit_bidangs', 'kuota_pendaftaran.id_unit_bidang', '=', 'unit_bidangs.id')
    ->where('kuota_pendaftaran.id', $id)
    ->select(
        'periode.*',
        'bidang.nama_bidang',
        'unit_bidangs.name',
        'kuota_pendaftaran.jumlah_kuota'
    )
    ->first();
        $jumlah_lolos = Pendaftaran::where('id_kuota', $id)->where('status_pendaftaran', 'Lolos')
            ->count();
        return view('dashboards.admins.page.detail_bidang_pendaftaran_selesai', compact('member', 'member_not_verified', 'member_not_lolos', 'query_pendaftaran', 'jumlah_lolos'));
    }

    function detail_nilai_peserta_bidang_pendaftaran($id)
    {
        $member = Periode::join('kuota_pendaftaran', 'kuota_pendaftaran.id_periode', '=', 'periode.id')
            ->join('pendaftaran', 'pendaftaran.id_kuota', '=', 'kuota_pendaftaran.id')
            ->join('profil_member', 'pendaftaran.id_profil', '=', 'profil_member.id')
            ->where([
                'periode.id' => $id,
                'pendaftaran.status_pendaftaran' => 'Lolos',
            ])
            ->select('pendaftaran.*', 'profil_member.*', 'profil_member.id as id_member', 'profil_member.created_at as created_at_', 'profil_member.nama_lengkap as nama_lengkap')
            ->get();
        $member_not_verified = Pendaftaran::join('profil_member', 'pendaftaran.id_profil', '=', 'profil_member.id')

            ->where([
                'pendaftaran.id_kuota' => $id,
                'pendaftaran.status_pendaftaran' => 'Belum Verifikasi',
            ])
            ->select('pendaftaran.*', 'profil_member.id as id_member', 'profil_member.created_at as created_at_', 'profil_member.nama_lengkap as nama_lengkap')
            ->get();

        $member_not_lolos = Pendaftaran::join('profil_member', 'pendaftaran.id_profil', '=', 'profil_member.id')

            ->where([
                'pendaftaran.id_kuota' => $id,
                'pendaftaran.status_pendaftaran' => 'Tidak Lolos',
            ])
            ->select('pendaftaran.*', 'profil_member.id as id_member', 'profil_member.created_at as created_at_', 'profil_member.nama_lengkap as nama_lengkap')
            ->get();
        // var_dump($member);
        $query_pendaftaran = KuotaPendaftaran::join('periode', 'kuota_pendaftaran.id_periode', '=', 'periode.id')
            ->join('bidang', 'kuota_pendaftaran.id_bidang', '=', 'bidang.id')
            ->where([
                'kuota_pendaftaran.id' => $id,
            ])
            ->first();
        $jumlah_lolos = Pendaftaran::where('id_kuota', $id)->where('status_pendaftaran', 'Lolos')
            ->count();
        return view('dashboards.admins.page.detail_nilai_peserta_bidang_pendaftaran', compact('member', 'member_not_verified', 'member_not_lolos', 'query_pendaftaran', 'jumlah_lolos'));
    }

    function sertifikat()
    {
        $data_peserta = Pendaftaran::join('profil_member', 'pendaftaran.id_profil', '=', 'profil_member.id')
            ->join('users', 'users.id', '=', 'profil_member.user_id')
            ->join('kuota_pendaftaran', 'kuota_pendaftaran.id', '=', 'pendaftaran.id_kuota')
            ->join('bidang', 'bidang.id', '=', 'kuota_pendaftaran.id_bidang')
            ->where('pendaftaran.status_pendaftaran', 'Lolos')
            ->select('profil_member.id as id_member', 'profil_member.created_at as created_at_', 'profil_member.*', 'bidang.nama_bidang as nama_bidang')->get();
        return view('dashboards.admins.page.list_sertifikat', compact('data_peserta'));
    }

    function generate_sertifikat($id)
    {
        $data_peserta = Pendaftaran::join('profil_member', 'pendaftaran.id_profil', '=', 'profil_member.id')
            ->join('users', 'users.id', '=', 'profil_member.user_id')
            ->join('kuota_pendaftaran', 'kuota_pendaftaran.id', '=', 'pendaftaran.id_kuota')
            ->join('periode', 'kuota_pendaftaran.id_periode', '=', 'periode.id')
            ->join('bidang', 'bidang.id', '=', 'kuota_pendaftaran.id_bidang')
            ->where([
                'profil_member.id' => $id,
                'pendaftaran.status_pendaftaran' => 'Lolos',
            ])
            ->select('profil_member.id as id_member', 'profil_member.created_at as created_at_', 'profil_member.*', 'bidang.nama_bidang as nama_bidang', 'periode.*')->first();
        if ($data_peserta->skor_integritas == NULL && $data_peserta->skor_pengembangan_diri == NULL && $data_peserta->skor_kreatifitas == NULL && $data_peserta->skor_komunikasi == NULL && $data_peserta->skor_analisis == NULL && $data_peserta->skor_kerja_sama == NULL && $data_peserta->skor_pemahaman == NULL && $data_peserta->skor_presentasi == NULL) {

            Alert::error('Oops', 'Mahasiswa ini belum ada skor penilaian');
            return back();
        } else {
            $jumlah = 0;
            $temp = 0;
            if ($data_peserta->skor_integritas > 0) {
                $jumlah += 1;
                $temp += $data_peserta->skor_integritas;
            }
            if ($data_peserta->skor_pengembangan_diri > 0) {
                $jumlah += 1;
                $temp += $data_peserta->skor_pengembangan_diri;
            }
            if ($data_peserta->skor_kreatifitas > 0) {
                $jumlah += 1;
                $temp += $data_peserta->skor_kreatifitas;
            }
            if ($data_peserta->skor_komunikasi > 0) {
                $jumlah += 1;
                $temp += $data_peserta->skor_komunikasi;
            }
            if ($data_peserta->skor_analisis > 0) {
                $jumlah += 1;
                $temp += $data_peserta->skor_analisis;
            }
            if ($data_peserta->skor_kerja_sama > 0) {
                $jumlah += 1;
                $temp += $data_peserta->skor_kerja_sama;
            }
            if ($data_peserta->skor_pemahaman > 0) {
                $jumlah += 1;
                $temp += $data_peserta->skor_pemahaman;
            }
            if ($data_peserta->skor_presentasi > 0) {
                $jumlah += 1;
                $temp += $data_peserta->skor_presentasi;
            }
            $predikat = "";
            if ($temp > 80) {
                $predikat = "Baik Sekali - A ";
            } else if ($temp > 69) {
                $predikat = "Baik - B ";
            } else if ($temp > 55) {
                $predikat = "Cukup - C ";
            } else if ($temp > 44) {
                $predikat = "Kurang - D ";
            } else {
                $predikat = "Kurang Sekali - E ";
            }
            $tanggal_mulai = $this->tanggal_indonesia($data_peserta->tgl_mulai_pelaksanaan);
            $tanggal_selesai = $this->tanggal_indonesia($data_peserta->tgl_selesai_pelaksanaan);

            return view('pdf.sertifikat', compact('data_peserta', 'jumlah', 'temp', 'predikat', 'tanggal_mulai', 'tanggal_selesai'));
        }
    }

    public function upload_sertifikat(Request $request)
    {



        $post = ProfilMember::find($request->id);
        if ($request->hasFile('file')) {
            $request->validate([
                'file' => 'required|mimes:pdf|max:2048',
            ]);
            $path = '/upload/file_sertifikat/';
            $file = $request->file('file');
            $extension = $file->getClientOriginalExtension();
            $new_name = microtime(true) . "." . $extension;
            $upload = $file->move(public_path($path), $new_name);

            $post->file_sertifikat = $path . $new_name;
        }
        $post->save();
        // $post = Bidang::find($request->id)->update($input);
        // return response()->json(['success' => $post]);
        if ($post) {
            Alert::success('Congrats', 'Data Sertifikat Berhasil Diupload');
            return response()->json(['success' => true]);
        }
    }

    function tanggal_indonesia($tanggal)
    {

        $bulan = array(
            1 =>       'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        );

        $var = explode('-', $tanggal);

        return $var[2] . ' ' . $bulan[(int)$var[1]] . ' ' . $var[0];
        // var 0 = tanggal
        // var 1 = bulan
        // var 2 = tahun
    }

    function terima_magang($id)
    {
        $html = '<a href="localhost:8000/pendaftaran/hasil/" ' . $id . '>Berikut pengumumannya</a>';
        $data_profile = ProfilMember::join('users', 'users.id', '=', 'profil_member.user_id')
            ->where('profil_member.id', $id)->first();

        $details = [
            'title' => 'Pengumuman Penerimaan Peserta Praktek Kerja Lapangan',
            'body' => 'Berikut ini kami lampirkan pdf untuk pengumuman',
            'nama' => $data_profile->nama_lengkap,
            'instansi' => $data_profile->nama_perguruan_tinggi ,
            'url' => 'https://study.indonesiapowerkmj.com/pdf/test/' . $id,
            'jenis' => 'diterima'
        ];
        Mail::to($data_profile->email, $data_profile->nama_lengkap)
            ->send(new PklEmail($details));
        $query = Pendaftaran::where('id_profil', $id)->update([
            'status_pendaftaran' => 'Lolos',
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        if ($query) {
            Alert::success('Congrats', 'Perubahan Status Pendaftaran Berhasil');
            return back();
        } else {
            Alert::error('Oops', 'Perubahan Status Pendaftaran Gagal, Ulangi beberapa saat lagi');
        }
    }
    function tolak_magang($id)
    {
        $html = '<a href="localhost:8000/pendaftaran/hasil/" ' . $id . '>Berikut pengumumannya</a>';
        $data_profile = ProfilMember::join('users', 'users.id', '=', 'profil_member.user_id')
            ->where('profil_member.id', $id)->first();

        $details = [
            'title' => 'Pengumuman Penerimaan Peserta Praktek Kerja Lapangan',
            'body' => 'Berikut ini kami lampirkan pdf untuk pengumuman',
            'nama' => $data_profile->nama_lengkap,
            'instansi' => $data_profile->nama_perguruan_tinggi ,
            'url' => 'https://study.indonesiapowerkmj.com/pdf/test/' . $id,
            'jenis' => 'ditolak'
        ];
        Mail::to($data_profile->email, $data_profile->nama_lengkap)
            ->send(new PklEmail($details));
        $query = Pendaftaran::where('id_profil', $id)->update([
            'status_pendaftaran' => 'Tidak Lolos',
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        if ($query) {
            Alert::success('Congrats', 'Perubahan Status Pendaftaran Berhasil');
            return back();
        } else {
            Alert::error('Sorry', 'Perubahan Status Pendaftaran Gagal, Ulangi beberapa saat lagi');
        }
    }

    function show_data_admin()
    {
        $admins = User::where('role', '=', '1')->get();
        return view('dashboards.admins.page.show_data_admin', compact('admins'));
    }

    function show_form_dokumen()
    {
        return view('dashboards.admins.page.upload_dokumen');
    }

    function change_password()
    {
        return view('dashboards.admins.page.change_password');
    }

    public function changePasswordPost(Request $request)
    {
        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error", "Password tidak sesuai");
        }

        if (strcmp($request->get('current-password'), $request->get('new-password')) == 0) {
            // Current password and new password same
            return redirect()->back()->with("error", "Password baru tidak boleh sama dengan password sekarang");
        }
        if (strcmp($request->get('new-password'), $request->get('new-password-confirm')) != 0) {
            // Current password and new password same
            return redirect()->back()->with("error", "Konfirmasi password harus sama dengan password baru");
        }
        $validator = Validator::make($request->all(), [
            'current-password' => 'required',
            'new-password' => 'required|string|min:8|confirmed',
        ]);

        //Change Password
        $user = Auth::user();
        $user->password = bcrypt($request->get('new-password'));
        $user->save();

        return redirect()->back()->with("success", "Password berhasil diupdate!");
    }

    function register_admin(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);
        if ($validator->passes()) {
            $path = 'users/images/';
            $fontPath = public_path('fonts/Oliciy.ttf');
            $char = strtoupper(preg_replace('/[^A-Za-z0-9\-]/', '_', $request->email));
            $newAvatarName = rand(12, 34353) . time() . '_avatar.png';
            $dest = $path . $newAvatarName;

            $createAvatar = makeAvatar($fontPath, $dest, $char);
            $picture = $createAvatar == true ? $newAvatarName : '';

            $data = User::create(
                [
                    'picture' => $picture,
                    'email' => $request->email,
                    'role' => 1,
                    'password' => Hash::make('12345678')
                ]
            );
            if ($data) {
                Alert::success('Congrats', 'Data Admin Berhasil Disimpan');
                return response()->json(["status" => "success", "message" => "simpan admin sukses"]);
            } else {
                Alert::error('Sorry', 'Data Admin Berhasil Disimpan');
                return response()->json(["status" => "error", "message" => "simpan admin gagal"]);
            }
        }
        return response()->json(['error' => $validator->errors()->all()]);
    }

    function export_pdf($id)
    {
        $dompdf = new Dompdf();
        $data = [
            'member' => ProfilMember::where('id', $id)->get(),
        ];
        $html = view('dashboards.admins.page.pdf_template', $data);
        $dompdf->loadHtml($html);
        // PDF::loadView('welcome', ['data' => $data]);
        // (Optional) Setup the paper size and orientation
        $dompdf->getOptions()->setIsHtml5ParserEnabled(true);

        // $dompdf->setPaper('F4', 'landscape');

        // Render the HTML as PDF
        $dompdf->render();

        set_time_limit(300);
        $dompdf->stream();

        // // Output the generated PDF to Browser

        // $member = ProfilMember::all();
        // // $pdf = PDF::loadview('dashboards.admins.page.pdf_template')->setPaper('A4','potrait');
        // $pdf = PDF::loadView('dashboards.admins.page.pdf_template', compact('member'));
        // return $pdf->stream();
        //     $pdf = PDF::loadView('dashboards.admins.page.pdf_template', ['member' => $data]);

        //     return $pdf->stream();
    }
    function periode_bidang()
    {

        return view('dashboards.admins.page.periode_bidang');
    }
    function show_bidang()
    {

        return view('dashboards.admins.page.show_bidang');
    }
    function detail_profile($id)
    {
        $data_user = DB::table('users')->join('profil_member', 'users.id', '=', 'profil_member.user_id')
           ->join('pendaftaran', 'pendaftaran.id_profil', '=', 'profil_member.id')
            ->join('kuota_pendaftaran', 'kuota_pendaftaran.id', '=', 'pendaftaran.id_kuota')
            ->join('bidang', 'bidang.id', '=', 'kuota_pendaftaran.id_bidang')
            ->where('profil_member.id', $id)
            ->select('profil_member.*', 'profil_member.created_at as created_at_', 'users.picture as picture','users.email', 'bidang.nama_bidang as nama_bidang')->first();
        return view('dashboards.admins.page.profile_detail', compact('data_user'));
    }
  public function store_pendaftaran(Request $request)
{
    $request->validate([
        'tgl_mulai_pendaftaran' => 'required|date',
        'tgl_selesai_pendaftaran' => 'required|date|after_or_equal:tgl_mulai_pendaftaran',
        'tgl_mulai_pelaksanaan' => 'required|date',
        'tgl_selesai_pelaksanaan' => 'required|date|after_or_equal:tgl_mulai_pelaksanaan',

        'data_unit' => 'required|array|min:1',

        'data_unit.*.id_unit_bidang' => 'required|exists:unit_bidangs,id',

        'data_unit.*.bidang' => 'required|array|min:1',

        'data_unit.*.bidang.*.id_bidang' => 'required|exists:bidang,id',
        'data_unit.*.bidang.*.kuota_bidang' => 'required|integer'
    ]);

    DB::beginTransaction();

    try {

        $periode = Periode::create([
            'tgl_mulai_pendaftaran' => $request->tgl_mulai_pendaftaran,
            'tgl_selesai_pendaftaran' => $request->tgl_selesai_pendaftaran,
            'tgl_mulai_pelaksanaan' => $request->tgl_mulai_pelaksanaan,
            'tgl_selesai_pelaksanaan' => $request->tgl_selesai_pelaksanaan
        ]);

        foreach ($request->data_unit as $unit) {

            foreach ($unit['bidang'] as $bidang) {

                // hanya simpan kalau kuota > 0
                KuotaPendaftaran::create([
                        'id_periode' => $periode->id,
                        'id_unit_bidang' => $unit['id_unit_bidang'],
                        'id_bidang' => $bidang['id_bidang'],
                        'jumlah_kuota' => $bidang['kuota_bidang']
                    ]);

            }

        }

        DB::commit();

        return response()->json([
            "status" => "success",
            "message" => "Periode pendaftaran berhasil dibuat"
        ]);

    } catch (\Exception $e) {

        DB::rollBack();

        return response()->json([
            "status" => "error",
            "message" => $e->getMessage()
        ],500);

    }
}

public function update_kuota_pendaftaran(Request $request)
{
    $validated = $request->validate([
        'id_periode' => 'required|exists:periode,id',
        'data_unit' => 'required|array|min:1',

        'data_unit.*.id_unit_bidang' => 'required|exists:unit_bidangs,id',
        'data_unit.*.bidang' => 'required|array|min:1',

        'data_unit.*.bidang.*.id_bidang' => 'required|exists:bidang,id',
        'data_unit.*.bidang.*.kuota_bidang' => 'required|integer|min:0'
    ]);

    DB::beginTransaction();

    try {

        $idPeriode = $validated['id_periode'];

        // ambil semua kuota existing
        $existing = KuotaPendaftaran::where('id_periode', $idPeriode)
            ->get()
            ->keyBy(fn($q) => $q->id_unit_bidang.'-'.$q->id_bidang);

        foreach ($validated['data_unit'] as $unit) {

            foreach ($unit['bidang'] as $bidang) {

                $key = $unit['id_unit_bidang'].'-'.$bidang['id_bidang'];

                $kuota = $existing->get($key);

                if ($kuota) {

                    // cek jumlah pendaftar
                    $jumlahPendaftar = DB::table('pendaftaran')
                        ->where('id_kuota', $kuota->id)
                        ->count();

                    if ($bidang['kuota_bidang'] < $jumlahPendaftar) {
                        throw new \Exception(
                            "Kuota tidak boleh lebih kecil dari jumlah pendaftar ($jumlahPendaftar)"
                        );
                    }

                    // update
                    $kuota->update([
                        'jumlah_kuota' => $bidang['kuota_bidang']
                    ]);

                } else {

                    // insert baru
                    KuotaPendaftaran::create([
                        'id_periode' => $idPeriode,
                        'id_unit_bidang' => $unit['id_unit_bidang'],
                        'id_bidang' => $bidang['id_bidang'],
                        'jumlah_kuota' => $bidang['kuota_bidang']
                    ]);
                }
            }
        }

        DB::commit();

        return response()->json([
            "status" => "success",
            "message" => "Kuota berhasil diupdate"
        ]);

    } catch (\Exception $e) {

        DB::rollBack();

        return response()->json([
            "status" => "error",
            "message" => $e->getMessage()
        ], 500);
    }
}

    function chart()
    {
        return view('dashboards.admins.page.chart');
    }

    function profile()
    {
        return view('dashboards.admins.profile');
    }
    function settings()
    {
        return view('dashboards.admins.settings');
    }

    function updateInfo(Request $request)
    {

        $validator = \Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . Auth::user()->id,
        ]);

        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            $query = User::find(Auth::user()->id)->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);

            if (!$query) {
                return response()->json(['status' => 0, 'msg' => 'Something went wrong.']);
            } else {
                return response()->json(['status' => 1, 'msg' => 'Your profile info has been update successfuly.']);
            }
        }
    }

    function updatePicture(Request $request)
    {
        $path = 'users/images/';
        $file = $request->file('admin_image');
        $new_name = 'UIMG_' . date('Ymd') . uniqid() . '.jpg';

        //Upload new image
        $upload = $file->move(public_path($path), $new_name);

        if (!$upload) {
            return response()->json(['status' => 0, 'msg' => 'Something went wrong, upload new picture failed.']);
        } else {
            //Get Old picture
            $oldPicture = User::find(Auth::user()->id)->getAttributes()['picture'];

            if ($oldPicture != '') {
                if (\File::exists(public_path($path . $oldPicture))) {
                    \File::delete(public_path($path . $oldPicture));
                }
            }

            //Update DB
            $update = User::find(Auth::user()->id)->update(['picture' => $new_name]);

            if (!$upload) {
                return response()->json(['status' => 0, 'msg' => 'Something went wrong, updating picture in db failed.']);
            } else {
                return response()->json(['status' => 1, 'msg' => 'Your profile picture has been updated successfully']);
            }
        }
    }


    function changePassword(Request $request)
    {
        //Validate form
        $validator = \Validator::make($request->all(), [
            'oldpassword' => [
                'required', function ($attribute, $value, $fail) {
                    if (!\Hash::check($value, Auth::user()->password)) {
                        return $fail(__('The current password is incorrect'));
                    }
                },
                'min:8',
                'max:30'
            ],
            'newpassword' => 'required|min:8|max:30',
            'cnewpassword' => 'required|same:newpassword'
        ], [
            'oldpassword.required' => 'Enter your current password',
            'oldpassword.min' => 'Old password must have atleast 8 characters',
            'oldpassword.max' => 'Old password must not be greater than 30 characters',
            'newpassword.required' => 'Enter new password',
            'newpassword.min' => 'New password must have atleast 8 characters',
            'newpassword.max' => 'New password must not be greater than 30 characters',
            'cnewpassword.required' => 'ReEnter your new password',
            'cnewpassword.same' => 'New password and Confirm new password must match'
        ]);

        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
        } else {

            $update = User::find(Auth::user()->id)->update(['password' => \Hash::make($request->newpassword)]);

            if (!$update) {
                return response()->json(['status' => 0, 'msg' => 'Something went wrong, Failed to update password in db']);
            } else {
                return response()->json(['status' => 1, 'msg' => 'Your password has been changed successfully']);
            }
        }
    }

    function delete_pendaftaran($id)
    {


        $check = Periode::join('kuota_pendaftaran', 'periode.id', '=', 'kuota_pendaftaran.id_periode')
            ->join('pendaftaran', 'kuota_pendaftaran.id', '=', 'pendaftaran.id_kuota')
            ->where('periode.id', $id)->count();
        var_dump($check);
        if ($check != 0) {
            Alert::error('OOps', 'Data tidak Bisa dihapus');
            return redirect('/admin/pendaftaran_berjalan')
                ->with([
                    'error' => 'Data Gagal Dihapus'
                ]);
        } else {
            $prodi = Periode::find($id);
            $prodi->forceDelete();
            $delete_kuota = KuotaPendaftaran::where('kuota_pendaftaran.id_periode', $id)->forceDelete();
            Alert::success('Congrats', 'Data Pendaftaran Berhasil Dihapus');
            return redirect('/admin/pendaftaran_berjalan')
                ->with([
                    'success' => 'Data Berhasil Dihapus'
                ]);
        }
    }

    function reset_password($id)
    {
        $data = ProfilMember::where('id','=',$id)->first();
        $user =  User::find($data->user_id);
        $user->password =  bcrypt('12345678');
        $user->save();
                Alert::success('Congrats', 'Password berhasil direset');
                return redirect('/admin/detail-profile/'.$id)
                ->with([
                    'success' => 'Password berhasil direset'
                ]);
    }

    function store_dokumen(Request $request)
    {
        $checkdata = FileUpload::where('jenis_file','=',$request->jenis_file)->get();
        $countdata = $checkdata->count();
        $file = $request->file('file');
        $filename = time() . '_' . $file->getClientOriginalName();

        // File extension
        $extension = $file->getClientOriginalExtension();

        // File upload location
        $location = 'upload';

        // Upload file
        $file->move($location, $filename);

        // File path
        $filepath = url('upload/' . $filename);
        if($countdata>0) {
            $post = FileUpload::find($checkdata[0]->id);
            $post->nama_file = $request->nama_dokumen;
                 $post->lokasi_file = $filename;
                 $post->jenis_file = $request->jenis_file;
                 $post->save();
            $path_file = public_path()."/upload/".$checkdata[0]->lokasi_file;
            $delete_file=File::delete($path_file);
            if ($post) {
                Alert::success('Congrats', 'Upload Dokumen Berhasil');
                return response()->json(['success' => true, 'hasilnya' => $request->deskripsi]);
            } else {
                return response()->json(['success' => false, 'hasilnya' => $request->deskripsi]);
            }

        } else {
            $post = FileUpload::create([
                'id'     => $request->id,
                'nama_file'     => $request->nama_dokumen,
                'lokasi_file' => $filename,
                'jenis_file' => $request->jenis_file,
            ]);
            if ($post) {
                Alert::success('Congrats', 'Upload Dokumen Berhasil');
                return response()->json(['success' => true, 'hasilnya' => $request->deskripsi]);
            } else {
                return response()->json(['success' => false, 'hasilnya' => $request->deskripsi]);
            }
        }

    }


}