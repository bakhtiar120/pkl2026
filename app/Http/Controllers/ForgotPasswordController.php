<?php

namespace App\Http\Controllers;

use App\Models\Bidang;
use App\Models\User;
use App\Models\ProfilMember;
use Illuminate\Support\Str;
use App\Mail\ResetPasswordMail;
use Illuminate\Http\Request;
use App\Models\FileUpload;
use Response;
use Illuminate\Support\Facades\Mail as Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Mail\Mailable;

class ForgotPasswordController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Bidang::where('id', $id)->first();
        return view('forgot_password');
    }

    public function store(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return redirect()->route('forgot-password')->with('error','Email tidak ditemukan');
        }
        $data_profile = ProfilMember::join('users', 'users.id', '=', 'profil_member.user_id')
            ->where('profil_member.id', $user->id)->first();
        $token = Str::random(64);
        DB::table('password_token')->updateOrInsert(
        ['email' => $request->email], // kondisi pencarian
        ['token' => $token, 'created_at' => now()] // data yang diupdate/insert
    );


        $details = [
            'link' => route('reset-password-user', ['token' => $token]),
        ];
        // ini_set('max_execution_time', 0); // atau 120

         Mail::to($request->email, $request->email)
            ->send(new ResetPasswordMail($details));
            return redirect()->route('forgot-password')->with('success','Silahkan cek email anda');

    }

    public function ubah_password($token) {
       $data = DB::table('password_token')->where('token', $token)->first();
       if ($data) {
        $user = User::where('email', $data->email)->first();
        $user->password =  bcrypt('12345678');
        $user->save();
        DB::table('password_token')
    ->where('email', $data->email)
    ->delete();
    $link = route('login');
        return view('password_reset_success',compact('link'));
       } else {
return view('password_reset_failed');
       }

    // return view('auth.auto-reset', compact('token'));
    }
}
