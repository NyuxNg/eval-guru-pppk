<?php

namespace App\Http\Controllers;

use App\Models\Jabpelaksana;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JabpelaksanaController extends Controller
{
    public function index()
    {
        return view('owner.jabpelaksana');
    }

    public function dataJabatan(Request $request)
    {
        $data = Jabpelaksana::join();
        $data = ($request->cari_jenistenaga) ? $data->where('jenisTenaga', '=', $request->cari_jenistenaga) : $data;
        $data = ($request->cari_nama) ? $data->where('jabpelaksanas.nama', 'like', '%' .$request->cari_nama. '%') : $data;
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
                ->rawColumns(['aksi'])
                ->make(true);
        }
    }

    public function store(Request $request)
    {
        $rules = [
            'nama' => 'required',
            'aturan' => 'required',
            'jenistenaga' => 'required',
        ];

        $text = [
            'nama' => 'nama harus diisi',
            'aturan' => 'aturan harus diisi',
            'jenistenaga' => 'jenis tenaga harus diisi',
        ];

        $validasi = Validator::make($request->all(), $rules, $text);
        if ($validasi->fails()) {
            return response()->json(['success' => 0, 'text' => $validasi->errors()->first()], 422);
        }

        $datajabpelaksana = [
            'nama' => $request->nama,
            'aturan' => $request->aturan,
            'jenistenaga' => $request->jenistenaga,
            'bup' => $request->bup,
        ];

        if ($request->mode == 'save') {
            $jabpelaksana = Jabpelaksana::create($datajabpelaksana);
        } else {
            $data = Jabpelaksana::where('id', '=', $request->id)->first();
            $jabpelaksana = $data->update($datajabpelaksana);
        }

        if ($jabpelaksana) {
            return response()->json(['text' => 'Jabatan pelaksana berhasil ditambahkan/diperbaharui'], 200);
        } else {
            return response()->json(['text' => 'Operasi gagal'], 422);
        }
    }

    public function hapus(Request $request)
    {
        $data = Jabpelaksana::where('id', '=', $request->kode)->first();
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
        $data = Jabpelaksana::find($request->id);
        return response()->json($data, 200);
    }

    public function cariJabatan(Request $request)
    {
        $data = Jabpelaksana::join()
            ->where('jenistenaga', '=', $request->jenistenaga)
            ->take(20)->get();

        return $data->map(function ($item){
            return [
                'value' => $item->id,
                'label' => $item->nama
            ];
        });
    }
}
