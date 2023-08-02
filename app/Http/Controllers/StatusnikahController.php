<?php

namespace App\Http\Controllers;

use App\Models\Statusnikah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StatusnikahController extends Controller
{
    public function store(Request $request)
    {
        $rules = [
            'kodestatus' => 'required',
            'status' => 'required',

        ];

        $text = [
            'kodestatus' => 'kode harus diisi',
            'status' => 'nama harus diisi',

        ];
        $validasi = Validator::make($request->all(), $rules, $text);
        if ($validasi->fails()) {
            return response()->json(['success' => 0, 'text' => $validasi->errors()->first()], 422);
        }

        $dataStatus = [
            'kode' => $request->kodestatus,
            'nama' => $request->status,
        ];
        if ($request->mode == 'save') {
            $status = Statusnikah::create($dataStatus);
        } else {
            $data = Statusnikah::all()->where('kode', '=', $request->kodestatus)->first();
            $status = $data->update($dataStatus);
        }


        if ($status) {
            return response()->json(['text' => 'Jenis status nikah ditambahkan/diperbaharui'], 200);
        } else {
            return response()->json(['text' => 'Operasi gagal'], 422);
        }
    }
    public function hapus(Request $request)
    {
        $data = Statusnikah::where('kode', '=', $request->kodestatus)->first();
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
        $data = Statusnikah::find($request->id);
        return response()->json($data, 200);
    }
}
