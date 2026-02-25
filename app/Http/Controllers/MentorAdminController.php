<?php

namespace App\Http\Controllers;

use App\Models\Bidang;
use App\Models\Pendaftaran;
use App\Models\ProfilMember;
use App\Models\ProfilMentor;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class MentorAdminController extends Controller
{
    function index()
    {

        $mentors = ProfilMentor::latest()->get();
        $data_peserta = Pendaftaran::join('profil_member', 'pendaftaran.id_profil', '=', 'profil_member.id')
            ->join('users', 'users.id', '=', 'profil_member.user_id')
            ->join('kuota_pendaftaran', 'kuota_pendaftaran.id', '=', 'pendaftaran.id_kuota')
            ->join('bidang', 'bidang.id', '=', 'kuota_pendaftaran.id_bidang')
            ->where('pendaftaran.status_pendaftaran', 'Lolos')
            ->whereNull('profil_member.id_profil_mentor')
            ->select('profil_member.id as id_member','profil_member.created_at as created_at_','profil_member.*', 'users.picture', 'bidang.nama_bidang as nama_bidang')->get();
        return view('dashboards.admins.page.mentor_belum', compact('mentors', 'data_peserta'));
    }

    function mentor_selesai()
    {

        $mentors = ProfilMentor::latest()->get();
        $data_peserta = Pendaftaran::join('profil_member', 'pendaftaran.id_profil', '=', 'profil_member.id')
            ->join('users', 'users.id', '=', 'profil_member.user_id')
            ->join('profil_mentor', 'profil_member.id_profil_mentor', '=', 'profil_mentor.id')
            ->join('kuota_pendaftaran', 'kuota_pendaftaran.id', '=', 'pendaftaran.id_kuota')
            ->join('bidang', 'bidang.id', '=', 'kuota_pendaftaran.id_bidang')
            ->where('pendaftaran.status_pendaftaran', 'Lolos')
            ->whereNotNull('profil_member.id_profil_mentor')
            ->select('profil_member.id as id_member','profil_member.created_at as created_at_','profil_member.*', 'profil_mentor.*','bidang.nama_bidang as nama_bidang')->get();
        return view('dashboards.admins.page.mentor_selesai', compact('mentors', 'data_peserta'));
    }

    function simpan_mentor(Request $request)
    {

        $query = ProfilMember::where('id', $request->id)->update([
            'id_profil_mentor' => $request->id_mentor
        ]);

        Alert::success('Congrats', 'Data Mentor Berhasil Disimpan');
        return response()->json(["status" => "success", "message" => "simpan mentor sukses"]);
    }

    function show_data_mentor()
    {
        $mentors = ProfilMentor::latest()->get();
        return view('dashboards.admins.page.show_data_mentor', compact('mentors'));
    }
    function create_mentor()
    {
        $bidangs = Bidang::latest()->get();
        return view('dashboards.admins.page.create_mentor', compact('bidangs'));
    }

    function register_mentor(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'nama_mentor' => 'required',
            'email' => 'required|email',
            'nip' => 'required',
            'jabatan' => 'required',
            'nama_bidang' => 'required'
        ]);
        if ($validator->passes()) {
            $check = User::where('email','=',$request->email)->count();
            if($check>0) {
                Alert::error('Oops', 'Data Email sudah ada');
                        return response()->json(["status" => "error", "message" => "Data Email sudah ada"]);
            }
            else {
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
                        'role' => 3,
                        'password' => Hash::make('12345678')
                    ]
                );
                if ($data) {
                    $data_mentor = ProfilMentor::create([
                        'nama' => $request->nama_mentor,
                        'nip' => $request->nip,
                        'jabatan' => $request->jabatan,
                        'user_id' => $data->id,
                        'id_bidang' => $request->nama_bidang
                    ]);
                    if ($data_mentor) {
                        Alert::success('Congrats', 'Data Mentor Berhasil Disimpan');
                        return response()->json(["status" => "success", "message" => "simpan mentor sukses"]);
                    } else {
                        Alert::error('Sorry', 'Data Mentor Gagal Disimpan');
                        return response()->json(["status" => "error", "message" => "simpan mentor gagal"]);
                    }
                }
            }
           
        }
        return response()->json(['error' => $validator->errors()->all()]);
    }


    function update_mentor(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'nama_mentor' => 'required',
            'email' => 'required|email',
            'nip' => 'required',
            'jabatan' => 'required',
        ]);
        if ($validator->passes()) {

            $query = ProfilMentor::where('id', $request->id_mentor)->update([
                'nama' => $request->nama_mentor,
                'nip' => $request->nip,
                'jabatan' => $request->jabatan,
            ]);

            $query2 = User::where('id', $request->id_user)->update([
                'email' => $request->email,
            ]);
            Alert::success('Congrats', 'Data Mentor Berhasil Diupdate');
            return response()->json(["status" => "success", "message" => "simpan mentor sukses"]);
        }
        return response()->json(['error' => $validator->errors()->all()]);
    }
    function delete_mentor($id)
    {

        $check = ProfilMember::where('id_profil_mentor', $id)->count();
        var_dump($check);
        if ($check != 0) {
            Alert::error('OOps', 'Data tidak Bisa dihapus');
            return redirect('/admin/show-data-mentor')
                ->with([
                    'error' => 'Data Gagal Dihapus'
                ]);
        } else {
            // $prodi->delete();
            $data_user = ProfilMentor::where('id', $id)->first();
            $hapus = ProfilMentor::where('id', $id)->delete();
            $hapus_user = User::where('id', $data_user->user_id)->forceDelete();
            if ($hapus_user) {
                Alert::success('Congrats', 'Data Mentor Berhasil Dihapus');
                return redirect('/admin/show-data-mentor')
                    ->with([
                        'success' => 'Data Berhasil Dihapus'
                    ]);
            } else {
                Alert::error('Oops', 'Data Mentor Gagal Dihapus,coba beberapa saat lagi');
                return redirect('/admin/show-data-mentor')
                    ->with([
                        'success' => 'Data Gagal Dihapus'
                    ]);
            }
        }
    }

    function edit_mentor(Request $request)
    {
        $check = ProfilMember::where('id_profil_mentor', $request->id)->count();
        if ($check != 0) {
            return response()->json(["status" => "error", "message" => "Edit mentor gagal"]);
        } else {
            return response()->json(["status" => "success", "message" => "Edit mentor sukses"]);
        }
    }

    function get_data_mentor($id)
    {
        $bidangs = Bidang::latest()->get();
        $data_mentor = ProfilMentor::where('id', $id)->first();
        $data_user = User::where('id', $data_mentor->user_id)->first();
        return view('dashboards.admins.page.edit_data_mentor', compact('data_mentor', 'data_user', 'bidangs'));
    }
}
