<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use ProfilMember;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Auth;

class MentorController extends Controller
{
   function index(){

    return view('dashboards.mentor.page.home');
   }


   function penugasan(){
    $member = ProfilMember::all();
    return view('dashboards.mentor.page.penugasan',['member'=>$member]);
   }

   function skor(){
    $member = ProfilMember::all();
    return view('dashboards.mentor.page.skor',['member'=>$member]);
   }

   function change_password()
   {
       return view('dashboards.mentor.page.change_password');
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
