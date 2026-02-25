<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\ProgramStudi;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Fakultas;

class ProgramStudiController extends Controller
{
    function index()
    {

        // $prodis = ProgramStudi::latest()->get();
        $prodis = ProgramStudi::join('fakultas', 'fakultas.id', '=', 'program_studi.id_fakultas')
            ->get(['fakultas.nama_fakultas', 'program_studi.nama_program_studi', 'program_studi.id']);

        return view('dashboards.admins.page.show_program_studi', compact('prodis'));
    }

    function create_prodi()
    {
        // var_dump("oke");
        $fakultas = Fakultas::latest()->get();
        return view('dashboards.admins.page.create_program_studi', compact('fakultas'));
    }

    function store_prodi(Request $request)
    {
        $this->validate($request, [
            'nama_program_studi' => 'required|string|max:155'
        ]);

        $post = ProgramStudi::create([
            'nama_program_studi' => $request->nama_program_studi,
            'id_fakultas' => $request->id_fakultas
        ]);

        if ($post) {
            Alert::success('Congrats', 'Data Program Studi Berhasil Disimpan');
            return redirect('/admin/show-prodi')
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
    function edit_prodi($id)
    {
        $post = ProgramStudi::findOrFail($id);
        $fakultas = Fakultas::latest()->get();
        return view('dashboards.admins.page.edit_program_studi', compact('post', 'fakultas'));
    }
    function update_prodi(Request $request, $id)
    {
        $post = ProgramStudi::find($id)->update($request->all());

        Alert::success('Congrats', 'Data Program Studi Berhasil Diupdate');
        return redirect('/admin/show-prodi')
            ->with([
                'success' => 'Data Berhasil Diupdate'
            ]);
    }
    function delete_prodi($id)
    {
        $prodi = ProgramStudi::find($id);

        $prodi->delete();
        Alert::success('Congrats', 'Data Program Studi Berhasil Dihapus');
        return redirect('/admin/show-prodi')
            ->with([
                'success' => 'Data Berhasil Dihapus'
            ]);
    }
}
