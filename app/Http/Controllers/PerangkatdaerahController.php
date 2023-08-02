<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Perangkatdaerah;
use Illuminate\Support\Facades\Validator;

class PerangkatdaerahController extends Controller
{
    public function index()
    {
        return view('thl.perangkatdaerah');
    }

    public function dataPerangkatdaerah(Request $request)
    {
        $data = Perangkatdaerah::join();

        $data = ($request->cari_perangkatdaerah) ? $data->where('nama', 'like', '%'. $request->cari_perangkatdaerah . '%') : $data;
        $data = ($request->cari_jenis != 'all') ? $data->where('nama', 'like', $request->cari_jenis . '%') : $data;
        $data = ($request->jumlahView != 'All') ? $data->take($request->jumlahView) : $data;
        $data = $data->get();

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
                ->rawColumns(['keterangan', 'aksi'])
                ->make(true);
        }

    }


    public function store(Request $request)
    {
        $rules = [
            'nama' => 'required',
            'jabatanPimpinan' => 'required',
            'thl2022' => 'required',
            'usulthl2023' => 'required',
        ];

        $text = [
            'nama.required' => 'nama harap dilengkapi!',
            'jabatanPimpinan.required' => 'jabatanPimpinan harap dilengkapi!',
            'thl2022.required' => 'thl2022 harap dilengkapi!',
            'usulthl2023.required' => 'usulthl2023 harap dilengkapi!',
        ];

        $validasi = Validator::make($request->all(), $rules, $text);
        if ($validasi->fails()) {
            return response()->json(['success' => 0, 'text' => $validasi->errors()->first()], 422);
        }

        $dataperangkatdaerah = [
            'nama' => $request->nama,
            'jabatanPimpinan' => $request->jabatanPimpinan,
            'thl2022' => $request->thl2022,
            'usulthl2023' => $request->usulthl2023,
            'keterangan' => $request->keterangan,
        ];

        if ($request->mode == 'save') {
            $perangkatdaerah = Perangkatdaerah::create($dataperangkatdaerah);
        } else {
            $data = Perangkatdaerah::all()->where('id', '=', $request->id)->first();
            $perangkatdaerah = $data->update($dataperangkatdaerah);
        }

        if ($perangkatdaerah) {
            return response()->json(['text' => 'Data berhasil ditambahkan/diperbaharui'], 200);
        } else {
            return response()->json(['text' => 'Operasi gagal'], 422);
        }
    }

    public function hapus(Request $request)
    {
        $data = Perangkatdaerah::where('id', '=', $request->kode)->first();
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
        $data = Perangkatdaerah::find($request->id);
        return response()->json($data, 200);
    }

    public function cariPerangkatDaerah(Request $request)
    {
        $data = Perangkatdaerah::join()->where(
            'nama',
            'like',
            '%'. $request->cariPerangkatDaerah . '%')
            ->take(5)
            ->get();
        return $data->map(function ($item) {
            return [
                'value' => $item->id,
                'label' => $item->nama
            ];
        });

    }
}
