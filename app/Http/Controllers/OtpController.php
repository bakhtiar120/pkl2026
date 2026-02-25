<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use App\Models\User;
use App\Models\EmailOtp;
// use App\Mail\OtpMail;

class OtpController extends Controller
{
    const MAX_ATTEMPTS = 5;
    const RESEND_COOLDOWN = 30; // detik
    const MAX_RESEND = 3;
    const BLOCK_MINUTES = 10;
public function show()
{
    if (!session()->has('2fa:user_id')) {
        return redirect('/login');
    }

    $otpData = EmailOtp::where('user_id', session('2fa:user_id'))->first();

    return view('auth.verify-otp', [
        'otpData' => $otpData,
        'cooldown' => $otpData
            ? max(0, self::RESEND_COOLDOWN - now()->diffInSeconds($otpData->last_sent_at))
            : 0,
        'isBlocked' => $otpData && $otpData->blocked_until && now()->lt($otpData->blocked_until),
    ]);
}


    

    public function verify(Request $request)
{
    $request->validate(['otp' => 'required|digits:6']);
    if ($otpData->blocked_until && now()->lt($otpData->blocked_until)) {
    $remaining = now()->diffInMinutes($otpData->blocked_until) + 1;

    return back()->withErrors([
        'otp' => "Your account is temporarily blocked. Try again in {$remaining} minutes."
    ]);
}

    $otpData = EmailOtp::where('user_id', session('2fa:user_id'))->first();

    if (!$otpData || now()->gt($otpData->expires_at)) {
        return back()->withErrors(['otp' => 'OTP expired']);
    }

    if ($otpData->attempts >= self::MAX_ATTEMPTS) {
        Auth::logout();
        session()->forget('2fa:user_id');
        $otpData->delete();

        return redirect('/login')->withErrors([
            'email' => 'Too many OTP attempts, please login again.'
        ]);
    }

    if (!Hash::check($request->otp, $otpData->otp)) {
        $otpData->increment('attempts');

        return back()->withErrors([
            'otp' => 'Invalid OTP'
        ]);
    }

    // ===== SUCCESS =====
    $user = User::findOrFail(session('2fa:user_id'));

    $user->update([
        'is_2fa_verified' => true
    ]);

    // Bersihkan OTP & cooldown
    $otpData->delete();

    session()->forget([
        '2fa:user_id',
        'otp_resend_available_at'
    ]);

    // Regenerate session (security)
    $request->session()->regenerate();

    Auth::login($user);

    // Redirect by role
    return match ($user->role) {
        1 => redirect()->route('admin.dashboard'),
        2 => redirect()->route('user.dashboard'),
        3 => redirect()->route('mentor.dashboard'),
        default => redirect('/'),
    };
}


  public function resend()
{
    $otpData = EmailOtp::where('user_id', session('2fa:user_id'))->firstOrFail();

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

    session([
        'otp_resend_available_at' => now()->addSeconds(self::RESEND_COOLDOWN)
    ]);

    return back()->with('success', 'OTP has been resent.');
}



}