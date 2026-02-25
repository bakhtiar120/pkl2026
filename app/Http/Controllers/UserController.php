<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Storage;
use Closure;
use Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
class UserController extends Controller
{
    function index()
    {

        return view('dashboards.users.page.home');
    }

    function profile()
    {
        return view('dashboards.users.profile');
    }
    function settings()
    {
        return view('dashboards.users.settings');
    }

    function download_sertifikat()
    {
        $data = User::join('profil_member', 'users.id', '=', 'profil_member.user_id')
            ->where('users.id', Auth::user()->id)
            ->select('profil_member.*')
            ->first();
        if ($data->file_sertifikat == NULL) {
            Alert::error('Sorry', 'Data Sertifikat Belum diupload');
            return view('dashboards.users.page.home');
        } else {
            $folder = $data->file_sertifikat;
            $filePath = public_path($folder);
            $headers = ['Content-Type: application/pdf'];
            $fileName = "sertifikat_" . $data->nama_lengkap . time() . '.pdf';
            // return Storage::disk('public')->download($filePath);

            return Response::download($filePath, $fileName);
            // return $response()->download($filePath, $fileName, $headers);
        }
    }
    function change_password()
    {
        return view('dashboards.users.page.change_password');
    }
    public function changePassword(Request $request)
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
}
