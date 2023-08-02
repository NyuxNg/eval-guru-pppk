<?php

namespace App\Http\Controllers;

use App\Models\Jenispegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JenispegawaiController extends Controller
{
    public function index()
    {
        $data = Jenispegawai::all();
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
        return view('owner.jenispegawai',compact('data'));
    }
    public function store(Request $request)
    {
        $rules = [
            'kode' => 'required',
            'nama' => 'required',

        ];

        $text = [
            'kode' => 'kode harus diisi',
            'nama' => 'nama harus diisi',

        ];
        $validasi = Validator::make($request->all(), $rules, $text);
        if ($validasi->fails()) {
            return response()->json(['success' => 0, 'text' => $validasi->errors()->first()], 422);
        }

        $datajenispegawai = [
            'kode' => $request->kode,
            'nama' => $request->nama,
            'keterangan' => $request->keterangan,
        ];
        if ($request->mode == 'save') {
            $jenispegawai = Jenispegawai::create($datajenispegawai);
        } else {
            $data = Jenispegawai::all()->where('kode', '=', $request->kode)->first();
            $jenispegawai = $data->update($datajenispegawai);
        }


        if ($jenispegawai) {
            return response()->json(['text' => 'Status kedudukan ditambahkan/diperbaharui'], 200);
        } else {
            return response()->json(['text' => 'Operasi gagal'], 422);
        }
    }
    public function hapus(Request $request)
    {
        $data = Jenispegawai::where('kode', '=', $request->kode)->first();
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
        $data = Jenispegawai::find($request->id);
        return response()->json($data, 200);
    }
}
