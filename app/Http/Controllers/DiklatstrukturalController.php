<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Diklatstruktural;
use Illuminate\Support\Facades\Validator;

class DiklatstrukturalController extends Controller
{
    public function store(Request $request)
    {
        $rules = [
            'id_siasn' => 'required',
            'diklatstruktural' => 'required'
        ];

        $text = [
            'id_siasn.required' => 'ID SIASN harus diisi',
            'diklatstruktural.required' => 'Nama jenis diklat harus diisi'
        ];

        $validasi = Validator::make($request->all(), $rules, $text);
        if ($validasi->fails()) {
            return response()->json(['success' => 0, 'text' => $validasi->errors()->first()], 422);
        }

        $dataDiklatstruktural = [
            'id_siasn' => $request->id_siasn,
            'diklatstruktural' => $request->diklatstruktural,
        ];
        if ($request->mode == 'save') {
            $diklatstruktural = Diklatstruktural::create($dataDiklatstruktural);
        } else {
            $data = Diklatstruktural::all()->where('id_siasn', '=', $request->id_siasn)->first();
            $diklatstruktural = $data->update($dataDiklatstruktural);
        }


        if ($diklatstruktural) {
            return response()->json(['text' => 'Jenis diklat berhasil ditambahkan/diperbaharui'], 200);
        } else {
            return response()->json(['text' => 'Operasi gagal'], 422);
        }

    }

    public function hapus(Request $request)
    {
        $data = Diklatstruktural::where('id_siasn', '=', $request->id_siasn)->first();
        if ($data) {
            $delete = $data->delete($request->all());
            if ($delete) {
                return response()->json(['text' => 'Data berhasil dihapus'], 200);
            } else {
                return response()->json(['text' => 'Terjadi kesalahan'], 200);
            }
        } else {
            return response()->json(['text' => 'Data gagal dihapus'], 200);
        }
    }

    public function edit(Request $request)
    {
        $data = Diklatstruktural::find($request->id);
        return response()->json($data, 200);
    }

}
