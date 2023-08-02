<?php

namespace App\Http\Controllers;

use App\Models\Golongan;
use Illuminate\Http\Request;
use App\Models\Tkt_Pendidikan;
use Illuminate\Support\Facades\Validator;

class TktPendidikanController extends Controller
{
    public function index()
    {
        $data = Tkt_Pendidikan::all();
        $golongan = Golongan::orderBy('kode','asc')->get();
        if (request()->ajax()) {
            return datatables()
             ->of($data)
                ->addColumn('gol-awal', function($data){
                    $gol = Golongan::where('kode','=',$data->golAwal)->get();
                    $golru = $gol[0]->golPNS.' - '.$gol[0]->pangkatPNS;
                    return $golru;
                })
                ->addColumn('gol-akhir', function($data){
                    $gol = Golongan::where('kode','=',$data->golAkhir)->get();
                    $golru = $gol[0]->golPNS.' - '.$gol[0]->pangkatPNS;
                    return $golru;
                })
                ->addColumn('aksi', function ($data) {
                    $button = '<button id="'.$data->id.
                    '" name= "edit" class="edit btn btn-warning" >Edit</button>';
                    $button.= ' <button id="'.$data->kode.
                    '" name="hapus" class="hapus btn btn-danger">Hapus</button>';
                    return $button;
                })
                ->rawColumns(['gol-awal','gol-akhir' ,'aksi'])
                ->make(true);
        }
        return view('owner.tktPendidikan',compact('data', 'golongan'));
    }

    public function store(Request $request)
    {
        $rules = [
            'kode' => 'required',
            'nama' => 'required',
            'golAwal' => 'required',
            'golAkhir' => 'required',
        ];

        $text = [
            'kode.required' => 'kode harus diisi',
            'nama.required' => 'nama harus diisi',
            'golAwal.required' => 'golAwal harus diisi',
            'golAkhir.required' => 'golAkhir harus diisi',
        ];
        $validasi = Validator::make($request->all(), $rules, $text);
        if ($validasi->fails()) {
            return response()->json(['success' => 0, 'text' => $validasi->errors()->first()], 422);
        }

        $dataTKTPendidikan = [
            'kode' => $request->kode,
            'nama' => $request->nama,
            'golAwal' => $request->golAwal,
            'golAkhir' => $request->golAkhir,
        ];
        if ($request->mode == 'save') {
            $tktPendidikan = Tkt_Pendidikan::create($dataTKTPendidikan);
        } else {
            $data = Tkt_Pendidikan::all()->where('kode', '=', $request->kode)->first();
            $tktPendidikan = $data->update($dataTKTPendidikan);
        }


        if ($tktPendidikan) {
            return response()->json(['text' => 'Tingkat Pendidikan ditambahkan/diperbaharui'], 200);
        } else {
            return response()->json(['text' => 'Operasi gagal'], 422);
        }
    }

    public function hapus(Request $request)
    {
        $data = Tkt_Pendidikan::where('kode', '=', $request->kode)->first();
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
       $data = Tkt_Pendidikan::find($request->id);
       return response()->json($data, 200);
    }
}
