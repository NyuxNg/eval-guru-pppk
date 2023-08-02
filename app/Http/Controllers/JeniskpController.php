<?php

namespace App\Http\Controllers;

use App\Models\Jeniskp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JeniskpController extends Controller
{
    public function index()
    {
        $data = Jeniskp::all();
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
        return view('owner.jeniskp',compact('data'));
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

        $datajeniskp = [
            'kode' => $request->kode,
            'nama' => $request->nama,
            'keterangan' => $request->keterangan,
        ];
        if ($request->mode == 'save') {
            $jeniskp = Jeniskp::create($datajeniskp);
        } else {
            $data = Jeniskp::all()->where('kode', '=', $request->kode)->first();
            $jeniskp = $data->update($datajeniskp);
        }


        if ($jeniskp) {
            return response()->json(['text' => 'Jenis kenaikan pangkat ditambahkan/diperbaharui'], 200);
        } else {
            return response()->json(['text' => 'Operasi gagal'], 422);
        }
    }
    public function hapus(Request $request)
    {
        $data = Jeniskp::where('kode', '=', $request->kode)->first();
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
        $data = Jeniskp::find($request->id);
        return response()->json($data, 200);
    }

}
