<?php

namespace App\Http\Controllers;

use App\Models\Jenisunor;
use Illuminate\Http\Request;
use App\Models\Kategorijabatan;
use Illuminate\Support\Facades\Validator;

class JenisunorController extends Controller
{
    public function index()
    {
        $jenisJab = Kategorijabatan::orderBy('kode','asc')->get();
        $data = Jenisunor::join();
        if (request()->ajax()) {
            return datatables()
             ->of($data)

                ->addColumn('aksi', function ($data) {
                    $button = '<button id="'.$data->id.
                    '" name= "edit" class="edit btn btn-warning" >Edit</button>';
                    $button.= ' <button id="'.$data->id.
                    '" name="hapus" class="hapus btn btn-danger">Hapus</button>';
                    return $button;
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }
        return view('owner.jenisunor',compact('data', 'jenisJab'));
    }

    public function store(Request $request)
    {
        $rules = [
            'nama' => 'required',
            'bup' => 'required',
            'idKategoriJabatan' => 'required',
        ];

        $text = [
            'nama.required' => 'Nama harus diisi',
            'bup.required' => 'BUP harus diisi',
            'idKategoriJabatan.required' => 'Kategori jabatan harus diisi',
        ];
        $validasi = Validator::make($request->all(), $rules, $text);
        if ($validasi->fails()) {
            return response()->json(['success' => 0, 'text' => $validasi->errors()->first()], 422);
        }

        $datajenisunor = [
            'id' => $request->id,
            'nama' => $request->nama,
            'bup' => $request->bup,
            'idKategoriJabatan' => $request->idKategoriJabatan,
        ];
        if ($request->mode == 'save') {
            $jenisunor = Jenisunor::create($datajenisunor);
        } else {
            $data = Jenisunor::all()->where('id', '=', $request->id)->first();
            $jenisunor = $data->update($datajenisunor);
        }


        if ($jenisunor) {
            return response()->json(['text' => 'Jenis Unor ditambahkan/diperbaharui'], 200);
        } else {
            return response()->json(['text' => 'Operasi gagal'], 422);
        }
    }

    public function hapus(Request $request)
    {
        $data = Jenisunor::where('id', '=', $request->kode)->first();
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
       $data = Jenisunor::find($request->id);
       return response()->json($data, 200);
    }
}
