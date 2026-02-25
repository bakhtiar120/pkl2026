<?php

namespace App\Http\Controllers;

use App\Models\Artikel as ModelsArtikel;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\Bidang;
use App\Models\ProfilMember;
use Illuminate\Support\Facades\DB;
use Fakultas;
use File;
use Validator;
use Periode;
use KuotaPendaftaran;
use Pendaftaran;
use Artikel;
use RealRashid\SweetAlert\Facades\Alert;

class PengumumanController extends Controller
{
  function simpan_pengumuman(Request $request)
  {
    try {
      $data = Artikel::updateOrCreate(
        ['id' => $request->id],
        [
          'user_id' => $request->user_id,
          'isi' => $request->isi,
          'judul' => $request->judul,
        ]
      );
      return response()->json(["status" => "success", "message" => "oke", "data" => $data ? $data : null]);
    } catch (Exception $e) {
      return response()->json(["status" => "error", "message" => $e->getMessage()]);
    }
  }

  function get()
  {
    try {
      $data =  Artikel::select('id', 'user_id', 'judul', 'created_at')->get();
      return response()->json(["status" => "success", "message" => "oke", "data" => $data ? $data : null]);
    } catch (Exception $e) {
      return response()->json(["status" => "error", "message" => $e->getMessage()]);
    }
  }
  function list(Request $request)
  {
    try {
      $data =  Artikel::select('id', 'user_id', 'judul', 'created_at')->where('id', '!=', $request->id)->get();
      $data2 =  Artikel::where('id', $request->id)->get();
      return response()->json(["status" => "success", "message" => "oke", "data" => $data ? $data : null, "data2" => $data2 ? $data2 : null]);
    } catch (Exception $e) {
      return response()->json(["status" => "error", "message" => $e->getMessage()]);
    }
  }
  function get_detail(Request $request)
  {
    try {
      $data =  Artikel::where('id', $request->id)->get();
      return response()->json(["status" => "success", "message" => "oke", "data" => $data ? $data : null]);
    } catch (Exception $e) {
      return response()->json(["status" => "error", "message" => $e->getMessage()]);
    }
  }
  function get_4()
  {
    try {
      $data =  Artikel::where('deleted_at', NULL)->take(4)->get();
      return response()->json(["status" => "success", "message" => "oke", "data" => $data ? $data : null]);
    } catch (Exception $e) {
      return response()->json(["status" => "error", "message" => $e->getMessage()]);
    }
  }

  function delete_pengumuman($id)
  {
    $prodi = ModelsArtikel::find($id);
    $prodi->delete();
    Alert::success('Congrats', 'Data Pengumuman Berhasil Dihapus');
    return redirect('/admin/pengumuman')
      ->with([
        'success' => 'Data Berhasil Dihapus'
      ]);
  }
}
