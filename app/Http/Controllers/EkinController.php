<?php

namespace App\Http\Controllers;

use App\Models\Ekin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EkinController extends Controller
{
    public function index()
    {
        $data = Ekin::join();
        if (request()->ajax()) {
            return datatables()
             ->of($data)
                ->addColumn('kirim', function ($data) {
                    $kirim = '<button id="'.$data->id.
                    '" name= "kirim" class="kirim btn btn-secondary" >Kirim</button>';
                    return $kirim;
                })
                ->addColumn('aksi', function ($data) {
                    $button = ' <button id="'.$data->id.
                    '" name= "edit" class="edit btn btn-warning" >Edit</button>';
                    $button.= ' <button id="'.$data->id.
                    '" name="hapus" class="hapus btn btn-danger">Hapus</button>';
                    return $button;
                })
                ->rawColumns(['kirim', 'aksi'])
                ->make(true);
        }
        return view('ekin.ekin',compact('data'));
    }

    public function store(Request $request)
    {
        $rules = [
            'tglRealisasi' => 'required',
            'fkKegiatanTahunan' => 'required',
            'uraianKegiatan' => 'required',
            'kualitas' => 'required',
            'waktu' => 'required',
        ];

        $text = [
            'tglRealisasi.required' => 'tglRealisasi harus dilengkapi',
            'fkKegiatanTahunan.required' => 'fkKegiatanTahunan harus dilengkapi',
            'uraianKegiatan.required' => 'uraianKegiatan harus dilengkapi',
            'kualitas.required' => 'kualitas harus dilengkapi',
            'waktu.required' => 'waktu harus dilengkapi',

        ];
        $validasi = Validator::make($request->all(), $rules, $text);
        if ($validasi->fails()) {
            return response()->json(['success' => 0, 'text' => $validasi->errors()->first()], 422);
        }

        $dataEkin = [
            'tglRealisasi' => $request->tglRealisasi,
            'fkKegiatanTahunan' => $request->fkKegiatanTahunan,
            'uraianKegiatan' => $request->uraianKegiatan,
            'kualitas' => $request->kualitas,
            'waktu' => $request->waktu,

        ];
        if ($request->mode == 'save') {
            $ekin = Ekin::create($dataEkin);
        } else {
            $data = Ekin::all()->where('id', '=', $request->id)->first();
            $ekin = $data->update($dataEkin);
        }


        if ($ekin) {
            return response()->json(['text' => 'Data E-Kinerja ditambahkan/diperbaharui'], 200);
        } else {
            return response()->json(['text' => 'Operasi gagal'], 422);
        }
    }

    public function hapus(Request $request)
    {
        $data = Ekin::where('id', '=', $request->kode)->first();
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
        $data = Ekin::find($request->id);
        return response()->json($data, 200);
    }

    public function kirim(Request $request)
    {

    }
}
