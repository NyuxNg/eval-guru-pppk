<?php

namespace App\Http\Controllers;

use App\Models\Golongan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
// use App\ Http\ Controllers\GolonganController;

class GolonganController extends Controller {
    public function index() {
        $data = Golongan::all();
        // dd($data);
        if (request()->ajax()) {
            return datatables()
             ->of($data)
                ->addColumn('aksi', function ($data) {
                    $button = '<button id="'.$data->id.
                    '" name= "edit" class="edit btn btn-warning" >Edit</button>';
                    $button.= ' <button id="'.$data->kode.
                    '" name="hapus" class="hapus btn btn-danger">Hapus</button>';
                    return $button;
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }
        return view('owner.golongan', compact('data'));
    }

    public function store(Request $request) {
        // dd($request->all());
        $rules = [
            'kode' => 'required',
            'golongan' => 'required',
            'ruang' => 'required',
            'pangkatPNS' => 'required',
        ];
        $text = [
            'kode' => 'Kode harus diisi.',
            'golongan' => 'Golongan harus ditentukan.',
            'ruang' => 'Ruang harus ditentukan.',
            'pangkatPNS' => 'Pangkat harus diisi.',
        ];

        $validasi = Validator::make($request->all(), $rules, $text);
        if ($validasi->fails()) {
            return response()->json(['success' => 0, 'text' => $validasi->errors()->first()], 422);
        }

        $dataGolongan = [
            'kode' => $request->kode,
            'golongan' => $request->golongan,
            'ruang' => $request->ruang,
            'golPNS' => $request->golPNS,
            'golPPPK' => $request->golPPPK,
            'pangkatPNS' => $request->pangkatPNS,
        ];
        // dd($dataGolongan);
        if ($request->mode == 'save') {
            $golongan = Golongan::create($dataGolongan);
        } else {
            $data = Golongan::all()->where('kode', '=', $request->kode)->first();
            $golongan = $data->update($dataGolongan);
        }


        if ($golongan) {
            return response()->json(['text' => 'Golongan ditambahkan/diperbaharui'], 200);
        } else {
            return response()->json(['text' => 'Operasi gagal'], 422);
        }

    }

    public function hapus(Request $request)
    {
        // dd($request->all());
        $data = Golongan::all()
            ->where('kode', '=', $request->kode)->first();
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
        $data = Golongan::find($request->id);
        return response()->json($data, 200);
    }

    public function getGolru(Request $request)
    {
        $data = Golongan::all()->where('kode','=', $request->kode)->first();
        return response()->json($data, 200);
    }
}
