<?php

namespace App\Http\Controllers;

use App\Models\Bidang;
use Illuminate\Http\Request;
use App\Models\FileUpload;
use Response;

class WelcomeController extends Controller
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
        $bidangs = Bidang::where('status', 'Aktif')->latest()->get();
        $filesupload = FileUpload::where('jenis_file','=','Surat Edaran Senior Manager')->get();
        $fileupload = $filesupload[0]->nama_file;
        // Bidang::where('id', $id)->first();
        return view('welcome', compact('bidangs','fileupload'));
    }
    function download_se()
    {
        $checkdata = FileUpload::where('jenis_file','=','Surat Edaran Senior Manager')->get();
        $path_file = public_path()."/upload/".$checkdata[0]->lokasi_file;
        $headers = ['Content-Type: application/pdf'];
        $fileName = $checkdata[0]->nama_file . time() . '.pdf';
        // return Storage::disk('public')->download($filePath);

        return Response::download($path_file, $fileName);
    }
}
