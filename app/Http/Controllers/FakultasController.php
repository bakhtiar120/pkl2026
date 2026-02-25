<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Fakultas;
use App\Models\ProgramStudi;
use RealRashid\SweetAlert\Facades\Alert;

class FakultasController extends Controller
{
    function index()
    {

        $fakultas = Fakultas::latest()->get();
        return view('dashboards.admins.page.show_fakultas', compact('fakultas'));
    }

    function create_fakultas()
    {
        // var_dump("oke");
        return view('dashboards.admins.page.create_fakultas');
    }

    function store_fakultas(Request $request)
    {
        $this->validate($request, [
            'nama_fakultas' => 'required|string|max:155'
        ]);

        $post = Fakultas::create([
            'nama_fakultas' => $request->nama_fakultas
        ]);

        if ($post) {
            Alert::success('Congrats', 'Data Fakultas Berhasil Disimpan');
            return redirect('/admin/show-fakultas')
                ->with([
                    'success' => 'Data Berhasil Disimpan'
                ]);
        } else {
            return redirect()
                ->back()
                ->withInput()
                ->with([
                    'error' => 'Some problem occurred, please try again'
                ]);
        }
    }
    function edit_bidang($id)
    {
        // $post = ProgramStudi::findOrFail($id);
        $fakultas = Fakultas::latest()->get();
        return view('dashboards.admins.page.edit_program_studi', compact('fakultas'));
    }
    function update_bidang(Request $request, $id)
    {
        $post = Fakultas::find($id)->update($request->all());

        Alert::success('Congrats', 'Data Fakultas Berhasil Diupdate');
        return redirect('/admin/show-fakultas')
            ->with([
                'success' => 'Data Berhasil Diupdate'
            ]);
    }
    function delete_fakultas($id)
    {

        $fakultas = Fakultas::find($id);
        $check = ProgramStudi::where('id_fakultas', $id)->count();

        if ($check != 0) {
            return response()->json([
                'status' => 200,
                'result' => 'failed',
                'message' => 'Data Gagal Dihapus!'
            ]);
        } else {
            $fakultas->delete();
            return response()->json([
                'status' => 200,
                'result' => 'success',
                'message' => 'Data Berhasil Dihapus!'
            ]);
        }
    }
}
