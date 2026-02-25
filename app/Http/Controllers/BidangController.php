<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Bidang;
use App\Models\KuotaPendaftaran;
use RealRashid\SweetAlert\Facades\Alert;

class BidangController extends Controller
{
    function index()
    {

        $bidangs = Bidang::latest()->get();
        return view('dashboards.admins.page.show_bidang', compact('bidangs'));
    }

    function create_bidang()
    {
        // var_dump("oke");
        return view('dashboards.admins.page.create_bidang');
    }

    function store_bidang(Request $request)
    {
        $this->validate($request, [
            'nama_bidang' => 'required|string|max:155'
        ]);

        $file = $request->file('file');
        $filename = time() . '_' . $file->getClientOriginalName();

        // File extension
        $extension = $file->getClientOriginalExtension();

        // File upload location
        $location = 'upload';

        // Upload file
        $file->move($location, $filename);

        // File path
        $filepath = url('upload/' . $filename);
        // return response()->json(['success' => $filename]);
        $post = Bidang::create([
            'id'     => $request->id,
            'nama_bidang'     => $request->nama_bidang,
            'deskripsi'   => $request->deskripsi,
            'icon' => $filename,
            'jurusan' => $request->jurusan,
            'status' => $request->status,
        ]);
        if ($post) {
            Alert::success('Congrats', 'Data Bidang Berhasil Disimpan');
            return response()->json(['success' => true, 'hasilnya' => $request->deskripsi]);
        } else {
            return response()->json(['success' => false, 'hasilnya' => $request->deskripsi]);
        }
    }
    function edit_bidang(Request $request)
    {
        $where = array('id' => $request->id);
        $book  = Bidang::where($where)->first();

        return response()->json($book);
    }

    function edit_data_bidang($id)
    {
        $data_bidangs  = Bidang::where('id', $id)->first();
        return view('dashboards.admins.page.edit_bidang', compact('data_bidangs'));
    }
    public function update_bidang(Request $request)
    {
        $request->validate([
            'nama_bidang' => 'required',
            'deskripsi' => 'required',
            'jurusan' => 'required'
        ]);


        $post = Bidang::find($request->id);
        if ($request->hasFile('file')) {
            $request->validate([
                'file' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            ]);
            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $location = 'upload';

            // Upload file
            $file->move($location, $filename);
            $post->icon = $filename;
        }
        $post->status = $request->status;
        $post->nama_bidang = $request->nama_bidang;
        $post->deskripsi = $request->deskripsi;
        $post->jurusan = $request->jurusan;
        $post->save();
        // $post = Bidang::find($request->id)->update($input);
        // return response()->json(['success' => $post]);
        if ($post) {
            Alert::success('Congrats', 'Data Bidang Berhasil Diupdate');
            return response()->json(['success' => true]);
        }
    }
    // function update_bidang(Request $request, $id)
    // {
    //     $post = Bidang::find($id)->update($request->all());

    //     Alert::success('Congrats', 'Data Bidang Berhasil Diupdate');
    //     return redirect('/admin/show-bidang')
    //         ->with([
    //             'success' => 'Data Berhasil Diupdate'
    //         ]);
    // }
    function delete_bidang($id)
    {


        $check = KuotaPendaftaran::where('id_bidang', $id)->count();
        var_dump($check);
        if ($check != 0) {
            Alert::error('OOps', 'Data tidak Bisa dihapus');
            return redirect('/admin/show-bidang')
                ->with([
                    'error' => 'Data Gagal Dihapus'
                ]);
        } else {
            $prodi = Bidang::find($id);
            $prodi->delete();
            Alert::success('Congrats', 'Data Bidang Berhasil Dihapus');
            return redirect('/admin/show-bidang')
                ->with([
                    'success' => 'Data Berhasil Dihapus'
                ]);
        }
    }
}
