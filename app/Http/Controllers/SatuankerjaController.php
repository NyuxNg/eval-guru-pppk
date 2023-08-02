<?php

namespace App\Http\Controllers;

use App\Models\Satuankerja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SatuankerjaController extends Controller
{
    public function index()
    {
        $data = Satuankerja::all();
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
                ->addColumn('jenis', function ($data) {
                    $jenis = ($data->jenis == 'D') ? "Instansi Daerah" : "Instansi Pusat";
                    return $jenis;
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }
        return view('owner.satuankerja');
    }

    public function store(Request $request)
    {
        $rules = [
            'nama' => 'required',
            'instansi' => 'required',
            'jenis' => 'required',

        ];

        $text = [
            'nama.required' => 'nama harus diisi',
            'instansi.required' => 'instansi harus diisi',
            'jenis.required' => 'jenis harus diisi',

        ];
        $validasi = Validator::make($request->all(), $rules, $text);
        if ($validasi->fails()) {
            return response()->json(['success' => 0, 'text' => $validasi->errors()->first()], 422);
        }

        $datasatuanKerja = [
            'id' => $request->id,
            'nama' => $request->nama,
            'instansi' => $request->instansi,
            'jenis' => $request->jenis,
        ];
        if ($request->mode == 'save') {
            $satuanKerja = Satuankerja::create($datasatuanKerja);
        } else {
            $data = Satuankerja::all()->where('kode', '=', $request->kode)->first();
            $satuanKerja = $data->update($datasatuanKerja);
        }


        if ($satuanKerja) {
            return response()->json(['text' => 'Satuan kerja ditambahkan/diperbaharui'], 200);
        } else {
            return response()->json(['text' => 'Operasi gagal'], 422);
        }
    }

    public function hapus(Request $request)
    {
        $data = Satuankerja::where('kode', '=', $request->kode)->first();
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
        $data = Satuankerja::find($request->id);
        return response()->json($data, 200);
    }

    public function cariSatuankerja(Request $request)
    {
        $data = Satuankerja::join();
        $data = ($request->cariSatuankerja) ? $data->where('satuankerja.nama', 'like', '%' .$request->cariSatuankerja. '%') : $data;
        $data = $data->take(20)->get();

        return $data->map(function ($item) {
            return [
                'value' => $item->id,
                'label' => $item->nama
            ];
        });
    }
}
