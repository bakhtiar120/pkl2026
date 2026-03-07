<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\EmailOtp;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail as Mail;
use Illuminate\Mail\Mailable;
use App\Mail\OtpEmail;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;
      protected function redirectTo(){
          if( Auth()->user()->role == 1){
              return route('admin.dashboard');
          }
          if( Auth()->user()->role == 2){
              return route('user.dashboard');
          }
          elseif( Auth()->user()->role == 3){
            return route('mentor.dashboard');
        }
      }


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
{
    $request->validate([
        'email'=>'required|email',
        'password'=>'required'
    ]);

    if (!Auth::attempt($request->only('email','password'))) {
        return back()->withErrors([
            'email'=>'Email atau password salah'
        ]);
    }

    $user = Auth::user();

    // reset status OTP
     $user->is_2fa_verified = false;
$user->save();

    $otp = random_int(100000,999999);

   // simpan ke database dulu
EmailOtp::updateOrCreate(
    ['user_id'=>$user->id],
    [
        'otp'=>Hash::make($otp),
        'expires_at'=>now()->addMinutes(5),
        'attempts'=>0,
        'resend_count'=>0,
        'last_sent_at'=>now()
    ]
);
Log::info('OTP SAVED', ['user_id'=>$user->id]);

// baru kirim email
Mail::to($user->email)->send(new OtpEmail([
    'otp'=>$otp
]));

    return redirect()->route('otp.form');
}
    

}