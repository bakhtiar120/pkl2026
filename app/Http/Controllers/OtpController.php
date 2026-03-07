<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Models\User;
use App\Models\EmailOtp;
use Illuminate\Support\Facades\Mail as Mail;
use Illuminate\Mail\Mailable;
use App\Mail\OtpEmail;
// use App\Mail\OtpMail;

class OtpController extends Controller
{
    const MAX_ATTEMPTS = 5;
    const RESEND_COOLDOWN = 30; // detik
    const MAX_RESEND = 3;
    const BLOCK_MINUTES = 10;
public function show()
{
    $user = auth()->user();

    $otpData = EmailOtp::where('user_id',$user->id)->first();
    $cooldown = 0;

    if ($otpData && $otpData->last_sent_at) {
        $cooldown = max(0, 60 - now()->diffInSeconds($otpData->last_sent_at));
    }
    return view('auth.verify-otp',[
        'email'=>$user->email,
        'otpData'=>$otpData,
        'cooldown' => $cooldown
    ]);
}

public function verify(Request $request)
{
    $request->validate([
        'otp' => 'required|digits:6'
    ]);

    $user = auth()->user();

    $otpData = EmailOtp::where('user_id', $user->id)->first();

    if(!$otpData){
        return back()->withErrors([
            'otp' => 'OTP not found'
        ]);
    }

    if(now()->gt($otpData->expires_at)){
        return back()->withErrors([
            'otp' => 'OTP expired'
        ]);
    }

    if(!Hash::check($request->otp, $otpData->otp)){
        $otpData->increment('attempts');

        return back()->withErrors([
            'otp' => 'Invalid OTP'
        ]);
    }

    // SUCCESS
    $user->is_2fa_verified = true;
$user->save();
    $user->refresh();
    // dd($user->is_2fa_verified);

    $otpData->delete();
Auth::login($user);
    return match ($user->role) {
        1 => redirect()->route('admin.dashboard'),
        2 => redirect()->route('user.dashboard'),
        3 => redirect()->route('mentor.dashboard'),
        default => redirect('/')
    };
}


  public function resend()
{
    $otpData = EmailOtp::where('user_id', auth()->id())->first();

    // 0. Cek apakah sedang diblokir
    if ($otpData->blocked_until && now()->lt($otpData->blocked_until)) {
        $remaining = now()->diffInMinutes($otpData->blocked_until) + 1;

        return back()->withErrors([
            'otp' => "Your account is temporarily blocked. Try again in {$remaining} minutes."
        ]);
    }

    // 1. Cek max resend
    if ($otpData->resend_count >= self::MAX_RESEND) {
        // Set block
        $otpData->update([
            'blocked_until' => now()->addMinutes(self::BLOCK_MINUTES)
        ]);

        return back()->withErrors([
            'otp' => 'Too many OTP resend attempts. Your account has been temporarily blocked for 10 minutes.'
        ]);
    }

    // 2. Cek cooldown
    if ($otpData->last_sent_at) {
        $availableAt = $otpData->last_sent_at->addSeconds(self::RESEND_COOLDOWN);

        if (now()->lt($availableAt)) {
            $remaining = now()->diffInSeconds($availableAt);

            session([
                'otp_resend_available_at' => $availableAt
            ]);

            return back()->withErrors([
                'otp' => "Please wait {$remaining} seconds before requesting another OTP."
            ]);
        }
    }

    // 3. Generate OTP baru
    $otp = random_int(100000, 999999);

    $otpData->update([
        'otp' => Hash::make($otp),
        'expires_at' => now()->addMinutes(5),
        'attempts' => 0,
        'last_sent_at' => now(),
        'resend_count' => $otpData->resend_count + 1,
    ]);
    $details = [
            'otp' => $otp
        ];
    $user = User::findOrFail($otpData->user_id);
    Mail::to($user->email, $user->email)
            ->send(new OtpEmail($details));

    session([
        'otp_resend_available_at' => now()->addSeconds(self::RESEND_COOLDOWN)
    ]);

    return back()->with('success', 'OTP has been resent.');
}



}