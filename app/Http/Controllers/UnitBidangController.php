<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\UnitBidang;
use App\Models\KuotaPendaftaran;
use RealRashid\SweetAlert\Facades\Alert;

class UnitBidangController extends Controller
{
     function index()
    {

        $unitkerjas = UnitBidang::latest()->get();
        return view('dashboards.admins.page.show_unit_kerja', compact('unitkerjas'));
    }

    public function store_unit_kerja(Request $request)
{
    $this->validate($request, [
        'name' => 'required|string|max:155'
    ]);

    $post = UnitBidang::create([
        'name' => $request->name,
    ]);

    if ($post) {
        Alert::success('Congrats', 'Unit Kerja Berhasil Disimpan');

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil disimpan'
        ]);
    } else {
        return response()->json([
            'success' => false,
            'message' => 'Data gagal disimpan'
        ]);
    }
}

public function update_ajax(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string|max:155'
    ]);

    $data = UnitBidang::find($id);
    $data->update([
        'name' => $request->name
    ]);

    return response()->json([
        'success' => true
    ]);
}
public function edit_ajax($id)
{
    $data = UnitBidang::find($id);

    return response()->json($data);
}
    // }
    function delete_unit_kerja($id)
    {
     $unitkerja = UnitBidang::find($id);
            $unitkerja->delete();
            Alert::success('Congrats', 'Data Unit Kerja Berhasil Dihapus');
            return redirect('/admin/show-unit-kerja')
                ->with([
                    'success' => 'Data Berhasil Dihapus'
                ]);
    }
}