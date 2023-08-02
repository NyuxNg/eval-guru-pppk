<?php

namespace App\Http\Controllers;

use App\Models\Jenishukuman;
use Illuminate\Http\Request;
use App\Models\Tingkathukdis;
use Illuminate\Support\Facades\Validator;

class JenishukumanController extends Controller
{
    public function index()
    {
        $data = Jenishukuman::all();
        $tingkathukdis = Tingkathukdis::orderBy('kode','asc')->get();
        if (request()->ajax()) {
            return datatables()
             ->of($data)
                ->addColumn('tingkat', function($data){
                    $tingkat = Tingkathukdis::where('id','=',$data->tingkat)->get();
                    $text = $tingkat[0]->nama;
                    return $text;
                })
                ->addColumn('aksi', function ($data) {
                    $button = '<button id="'.$data->id.
                    '" name= "edit" class="edit btn btn-warning" >Edit</button>';
                    $button.= ' <button id="'.$data->kode.
                    '" name="hapus" class="hapus btn btn-danger">Hapus</button>';
                    return $button;
                })
                ->rawColumns(['tingkat', 'aksi'])
                ->make(true);
        }
        return view('owner.jenishukuman',compact('data', 'tingkathukdis'));
    }

    public function store(Request $request)
    {
        $rules = [
            'kode' => 'required',
            'nama' => 'required',
            'tingkat' => 'required'

        ];

        $text = [
            'kode' => 'kode harus diisi',
            'nama' => 'nama harus diisi',
            'tingkat' => 'tingkat harus tentukan'

        ];
        $validasi = Validator::make($request->all(), $rules, $text);
        if ($validasi->fails()) {
            return response()->json(['success' => 0, 'text' => $validasi->errors()->first()], 422);
        }

        $datajenishukuman = [
            'kode' => $request->kode,
            'nama' => $request->nama,
            'keterangan' => $request->keterangan,
            'tingkat' => $request->tingkat,
        ];
        if ($request->mode == 'save') {
            $jenishukuman = Jenishukuman::create($datajenishukuman);
        } else {
            $data = Jenishukuman::all()->where('kode', '=', $request->kode)->first();
            $jenishukuman = $data->update($datajenishukuman);
        }


        if ($jenishukuman) {
            return response()->json(['text' => 'Status kedudukan ditambahkan/diperbaharui'], 200);
        } else {
            return response()->json(['text' => 'Operasi gagal'], 422);
        }
    }

    public function hapus(Request $request)
    {
        $data = Jenishukuman::where('kode', '=', $request->kode)->first();
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
        $data = Jenishukuman::find($request->id);
        return response()->json($data, 200);
    }
}
