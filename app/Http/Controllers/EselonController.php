<?php

namespace App\Http\Controllers;

use App\Models\Eselon;
use Illuminate\Http\Request;
use App\Models\Kategorijabatan;
use Illuminate\Support\Facades\Validator;

class EselonController extends Controller
{
    public function index()
    {
        $jenisJab = Kategorijabatan::orderBy('kode','asc')->get();
        $data = Eselon::join();
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
        return view('owner.eselon',compact('data', 'jenisJab'));
    }

    public function store(Request $request)
    {
        $rules = [
            'nama' => 'required',
            'idKategoriJabatan' => 'required',
        ];

        $text = [
            'nama.required' => 'Nama harus diisi',
            'idKategoriJabatan.required' => 'Kategori jabatan harus diisi',
        ];
        $validasi = Validator::make($request->all(), $rules, $text);
        if ($validasi->fails()) {
            return response()->json(['success' => 0, 'text' => $validasi->errors()->first()], 422);
        }

        $dataEselon = [
            'id' => $request->id,
            'kode' => $request->kode,
            'nama' => $request->nama,
            'keterangan' => $request->keterangan,
            'idKategoriJabatan' => $request->idKategoriJabatan,
        ];
        if ($request->mode == 'save') {
            $eselon = Eselon::create($dataEselon);
        } else {
            $data = Eselon::all()->where('id', '=', $request->id)->first();
            $eselon = $data->update($dataEselon);
        }


        if ($eselon) {
            return response()->json(['text' => 'Data Eselon ditambahkan/diperbaharui'], 200);
        } else {
            return response()->json(['text' => 'Operasi gagal'], 422);
        }
    }

    public function hapus(Request $request)
    {
        $data = Eselon::where('id', '=', $request->kode)->first();
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
        $data = Eselon::find($request->id);
        return response()->json($data, 200);
    }


}
