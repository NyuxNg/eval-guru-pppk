<?php

namespace App\Http\Controllers;

use App\Models\Pendidikan;
use Illuminate\Http\Request;
use App\Models\Tkt_Pendidikan;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;

class PendidikanController extends Controller
{
    public function index()
    {
        $tktpendidikan = Tkt_Pendidikan::orderBy('kode','asc')->get();
        return view('owner.pendidikan',compact('tktpendidikan'));
    }
    public function datariwayat(Request $request)
    {
        $data = Pendidikan::join();
        $data = ($request->cari_tktPendidikan) ? $data->where('tktPendidikan', '=', $request->cari_tktPendidikan) : $data;
        $data = ($request->cari_nama) ? $data->where('pendidikans.nama', 'like', '%' .$request->cari_nama. '%') : $data;
        $data = ($request->jumlahView != 'All') ? $data->take($request->jumlahView) : $data;
        $data = $data->get();

        if (request()->ajax()) {
            return datatables()
             ->of($data)
                ->addColumn('tktPendidikan', function($data){
                    $tkp = Tkt_Pendidikan::where('kode','=',$data->tktPendidikan)->get();
                    $tktP = $tkp[0]->kode.' - '.$tkp[0]->nama;
                    return $tktP;
                })
                ->addColumn('aksi', function ($data) {
                    $button = '<button id="'.$data->id.
                    '" name= "edit" class="edit btn btn-warning" >Edit</button>';
                    $button.= ' <button id="'.$data->id.
                    '" name="hapus" class="hapus btn btn-danger">Hapus</button>';
                    return $button;
                })
                ->rawColumns(['tktPendidikan', 'aksi'])
                ->make(true);
        }
    }

    public function store(Request $request)
    {
        $rules = [
            'nama' => 'required',
            'tktPendidikan' => 'required',
        ];

        $text = [
            'nama' => 'nama harus diisi',
            'tktPendidikan' => 'Tingkat pendidikan harus diisi',
        ];

        $validasi = Validator::make($request->all(), $rules, $text);
        if ($validasi->fails()) {
            return response()->json(['success' => 0, 'text' => $validasi->errors()->first()], 422);
        }

        $datapendidikan = [
            'nama' => $request->nama,
            'tktPendidikan' => $request->tktPendidikan,
        ];

        if ($request->mode == 'save') {
            $pendidikan = Pendidikan::create($datapendidikan);
        } else {
            $data = Pendidikan::where('id', '=', $request->id)->first();
            $pendidikan = $data->update($datapendidikan);
        }

        if ($pendidikan) {
            return response()->json(['text' => 'Tingkat Pendidikan ditambahkan/diperbaharui'], 200);
        } else {
            return response()->json(['text' => 'Operasi gagal'], 422);
        }
    }

    public function hapus(Request $request)
    {
        $data = Pendidikan::where('id', '=', $request->kode)->first();
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
        $data = Pendidikan::find($request->id);
        return response()->json($data, 200);
    }

    public function cariPendidikan(Request $request)
    {
        $tkt = Tkt_Pendidikan::where('id', '=', $request->kodeTKT)->get();
        $data = Pendidikan::join()
            ->where('tktPendidikan','=',$tkt[0]->kode);

        $data = ($request->cariPendidikan) ? $data->where('pendidikans.nama', 'like', '%' .$request->cariPendidikan. '%') : $data;
        $data = $data->take(20)->get();

        return $data->map(function ($item) {
            return [
                'value' => $item->id,
                'label' => $item->nama
            ];
        });
    }
}
