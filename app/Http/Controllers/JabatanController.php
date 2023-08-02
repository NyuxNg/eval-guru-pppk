<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use App\Models\Kategorijabatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JabatanController extends Controller
{
    public function index()
    {
        $kategoriJab = Kategorijabatan::orderBy('kode','asc')->get()->unique('kategori');
        $jenisJab = Kategorijabatan::orderBy('kode','asc')->get();
        return view('owner.jabatan', compact('kategoriJab', 'jenisJab'));
    }

    public function datajabatan(Request $request)
    {
        $data = Jabatan::join();

        $data = ($request->cari_nama) ? $data->where('jabatans.nama', 'like', '%' .$request->cari_nama. '%') : $data;
        $data = ($request->cari_jenistenaga) ? $data->where('jenisTenaga', '=', $request->cari_jenistenaga) : $data;
        $data = ($request->cari_kategorijab) ? $data->where('kategori', '=', $request->cari_kategorijab) : $data;
        $data = ($request->cari_jenisjab) ? $data->where('kategorijabatans.id', '=', $request->cari_jenisjab) : $data;
        $data = ($request->jumlahView != 'All') ? $data->take($request->jumlahView) : $data;
        $data = $data->orderBy('kategorijabatans.kode','asc');
        $data = $data->get();
        // dd($data);
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
            'jenisTenaga' => 'required',
            'bup' => 'required',
            'aktif' => 'required',
            'idKategorijabatan' => 'required',
        ];

        $text = [
            'nama' => 'nama harus diisi',
            'jenisTenaga' => 'jenis tenaga harus diisi',
            'bup' => 'bup harus diisi',
            'aktif' => 'keaktifan harus diisi',
            'idKategorijabatan' => 'kategori jabatan harus diisi',
        ];

        $validasi = Validator::make($request->all(), $rules, $text);
        if ($validasi->fails()) {
            return response()->json(['success' => 0, 'text' => $validasi->errors()->first()], 422);
        }

        $datajabatan = [
            'nama' => $request->nama,
            'aturan' => $request->aturan,
            'jenistenaga' => $request->jenistenaga,
            'bup' => $request->bup,
            'bup' => $request->bup,
            'aktif' => $request->aktif,
            'idKategorijabatan' => $request->idKategorijabatan,
        ];

        if ($request->mode == 'save') {
            $jabatan = Jabatan::create($datajabatan);
        } else {
            $data = Jabatan::where('id', '=', $request->id)->first();
            $jabatan = $data->update($datajabatan);
        }

        if ($jabatan) {
            return response()->json(['text' => 'Jabatan berhasil ditambahkan/diperbaharui'], 200);
        } else {
            return response()->json(['text' => 'Operasi gagal'], 422);
        }
    }

    public function hapus(Request $request)
    {
        $data = Jabatan::where('id', '=', $request->kode)->first();
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
        $data = Jabatan::find($request->id);
        return response()->json($data, 200);
    }

    public function cariJabatan(Request $request)
    {

        $data = Jabatan::join();

        $data = ($request->cariJabatan) ? $data->where('jabatans.nama', 'like', '%' .$request->cariJabatan. '%') : $data;
        $data = $data->take(20)->get();

        return $data->map(function ($item) {
            return [
                'value' => $item->id,
                'label' => $item->nama
            ];
        });
    }

}
