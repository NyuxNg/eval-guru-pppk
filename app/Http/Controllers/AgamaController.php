<?php

namespace App\Http\Controllers;

use App\Models\Agama;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AgamaController extends Controller
{
    public function store(Request $request)
    {
        $rules = [
            'kodeagama' => 'required',
            'agama' => 'required',

        ];

        $text = [
            'kodeagama.required' => 'kode harus diisi',
            'agama.required' => 'nama agama harus diisi',

        ];
        $validasi = Validator::make($request->all(), $rules, $text);
        if ($validasi->fails()) {
            return response()->json(['success' => 0, 'text' => $validasi->errors()->first()], 422);
        }

        $dataAgama = [
            'kode' => $request->kodeagama,
            'nama' => $request->agama,
        ];
        if ($request->mode == 'save') {
            $agama = Agama::create($dataAgama);
        } else {
            $data = Agama::all()->where('kode', '=', $request->kodeagama)->first();
            $agama = $data->update($dataAgama);
        }


        if ($agama) {
            return response()->json(['text' => 'Status kedudukan ditambahkan/diperbaharui'], 200);
        } else {
            return response()->json(['text' => 'Operasi gagal'], 422);
        }
    }

    public function hapus(Request $request)
    {
        $data = Agama::where('kode', '=', $request->kodeagama)->first();
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
        $data = Agama::find($request->id);
        return response()->json($data, 200);
    }

}
