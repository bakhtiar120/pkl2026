<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use ProfilMember;
use PenugasanTambahan;
use Illuminate\Support\Facades\DB;

class FileUploadControlle extends Controller
{ 
   
     

   function file_upload(Request $request){
      try{
 
         
         $validatedData = $request->validate([          
            'file'=>'required',          
         ]); 

         $path = '/upload/file_upload/';
         $file = $request->file('file');
         $extension = $file->getClientOriginalExtension();
         $new_name = microtime(true).".".$extension; 
         $upload = $file->move(public_path($path), $new_name);   

        return response()->json(['location'=>$path.$new_name]); 
       }
       catch (Exception $e) {
       return response()->json(["status" => "error", "message" => $e->getMessage() ]); 
      }
     }
}
