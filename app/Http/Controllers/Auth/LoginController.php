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
          if( Auth()->user() == 2){
              return route('user.dashboard');
          }
          elseif( Auth()->user() == 3){
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

    public function login(Request $request){
       $input = $request->all();
       $this->validate($request,[
           'email'=>'required|email',
           'password'=>'required'
       ]);

        if (!auth()->attempt($request->only('email', 'password'))) {
        return redirect()->route('login')
            ->with('error', 'Email atau password salah');
    }
    $user = auth()->user();
      $user->update(['is_2fa_verified' => false]);

    $otp = random_int(100000, 999999);
Log::debug('OTP generated', [
    'otp' => $otp,
    'user_id' => $user->id,
]);
 $details = [
            'otp' => $otp
        ];
 Mail::to($user->email, $user->email)
            ->send(new OtpEmail($details));


    EmailOtp::updateOrCreate(
        ['user_id' => $user->id],
        [
            'otp' => Hash::make($otp),
            'expires_at' => now()->addMinutes(5),
            'resend_count' => 0,
            'attempts' => 0,
            'blocked_until' => null,
            'last_sent_at' => now(),
        ]
    );
    Auth::logout();
    session(['2fa:user_id' => $user->id]);

    return redirect()->route('otp.form');
    }
    

}