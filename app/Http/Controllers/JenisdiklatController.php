<?php

namespace App\Http\Controllers;

use App\Models\Jenisdiklat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JenisdiklatController extends Controller
{
    public function store(Request $request)
    {
        $rules = [
            'id_siasn' => 'required',
            'jenisdiklat' => 'required'
        ];

        $text = [
            'id_siasn.required' => 'ID SIASN harus diisi',
            'jenisdiklat.required' => 'Nama jenis diklat harus diisi'
        ];

        $validasi = Validator::make($request->all(), $rules, $text);
        if ($validasi->fails()) {
            return response()->json(['success' => 0, 'text' => $validasi->errors()->first()], 422);
        }

        $dataJenisdiklat = [
            'id_siasn' => $request->id_siasn,
            'jenisdiklat' => $request->jenisdiklat,
        ];

        if ($request->mode == 'save') {
            $jenisdiklat = Jenisdiklat::create($dataJenisdiklat);
        } else {
            $data = Jenisdiklat::all()->where('id_siasn', '=', $request->id_siasn)->first();
            $jenisdiklat = $data->update($dataJenisdiklat);
        }


        if ($jenisdiklat) {
            return response()->json(['text' => 'Jenis diklat berhasil ditambahkan/diperbaharui'], 200);
        } else {
            return response()->json(['text' => 'Operasi gagal'], 422);
        }

    }

    public function hapus(Request $request)
    {
        $data = Jenisdiklat::where('id_siasn', '=', $request->id_siasn)->first();
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
        $data = Jenisdiklat::find($request->id);
        return response()->json($data, 200);
    }

}
