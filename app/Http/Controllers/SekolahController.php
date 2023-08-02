<?php

namespace App\Http\Controllers;

use App\Models\Sekolah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SekolahController extends Controller
{
    public function index(Request $request) {
        $wilayah = Sekolah::show()->select('wilayah')->distinct()->get();
        $data = Sekolah::show();
        $data = ($request->cariWilayah != '') ? $data->where('wilayah','=',$request->cariWilayah) : $data;
        $data = ($request->cariJenjang != '') ? $data->where('jenjang','like','%'.$request->cariJenjang.'%') : $data;

        $data = ($request->jumlahView != 'All') ? $data->take($request->jumlahView) : $data;
        if(request()->ajax()) {
            return datatables()->of($data)
                ->addColumn('informasi', function($data){
                    $informasi = '<span class="small">Jumlah Siswa: '.$data->siswa .' Orang</span><br>
                                  <span class="small">Jumlah Rombel: '.$data->rombel .'</span><br>
                                  <span class="small">Jumlah ABK: '.$data->abk .' Orang</span><br>
                                  <span class="small">Jumlah ASN: '.$data->asn .' Orang</span><br>
                                  <span class="small">Jumlah Non-ASN: '.$data->nonASN .' Orang</span><br>
                    ';

                    return $informasi;
                })
                ->addColumn('aksi', function($data){
                    $button = '<button id="'.$data->npsn.
                    '" name="edit" class="edit btn btn-warning">Edit</button>';
                    $button.= ' <button id="'.$data->npsn.
                    '" name="hapus" class="hapus btn btn-danger">Hapus</button>';
                    return $button;
                })
            ->rawColumns(['aksi', 'informasi'])
            ->make(true);
        }


        return view('pppk.sekolah', compact('wilayah'));
    }

    public function store(Request $request)
    {
        // dd($request);
        $rules = [
            'npsn' => 'required',
            'namadapodik' => 'required',
            'namasekolah' => 'required',
            'wilayah' => 'required',
        ];

        $text = [
            'npsn.required' => 'npsn harus diisi!',
            'namadapodik.required' => 'namadapodik harus diisi!',
            'namasekolah.required' => 'namasekolah harus diisi!',
            'wilayah.required' => 'wilayah harus diisi!',
        ];
        $validasi = Validator::make($request->all(), $rules, $text);
        if ($validasi->fails()) {
            return response()->json(['success' => 0, 'text' => $validasi->errors()->first()], 422);
        }

        $datasekolah = [
            'npsn' => $request->npsn,
            'namadapodik' => $request->namadapodik,
            'namasekolah' => $request->namasekolah,
            'jenjang' => $request->jenjang,
            'wilayah' => $request->wilayah,
            'siswa' => $request->siswa,
            'abk' => $request->abk,
            'rombel' => $request->rombel,
            'asn' => $request->asn,
            'nonASN' => $request->nonASN,
            'catatan' => $request->catatan,
        ];
        // dd($datasekolah);
        if ($request->mode == 'save') {
            $sekolah = Sekolah::create($datasekolah);
        } else {
            $data = Sekolah::all()->where('npsn', '=', $request->npsn)->first();
            $sekolah = $data->update($datasekolah);
        }


        if ($sekolah) {
            return response()->json(['text' => 'Data Sekolah berhasil ditambahkan/diperbaharui'], 200);
        } else {
            return response()->json(['text' => 'Operasi gagal'], 422);
        }
    }

    public function hapus(Request $request)
    {
        $data = Sekolah::where('npsn', '=', $request->kode)->first();
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
        $data = Sekolah::find($request->id);
        return response()->json($data, 200);
    }

}
