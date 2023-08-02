<?php

namespace App\Http\Controllers;

use App\Models\Golongan;
use Illuminate\Http\Request;
use App\Models\Tkt_Pendidikan;
use App\Models\Kategorijabatan;
use Illuminate\Support\Facades\Validator;

use function PHPUnit\Framework\isEmpty;

class KategorijabatanController extends Controller
{
    public function index()
    {
        $data = Kategorijabatan::all();
        // dd($data->all());
        $golongan = Golongan::orderBy('kode','asc')->get();
        $tktPendidikan = Tkt_Pendidikan::orderBy('kode','asc')->get();
        if (request()->ajax()) {
            return datatables()
             ->of($data)
                ->addColumn('pangkatDasar', function($data){
                    $gol = Golongan::where('kode','=',$data->pangkatDasar)->get();
                    $golru = ($gol->isNotEmpty()) ? $gol[0]->golPNS.' - '.$gol[0]->pangkatPNS : "Tidak diatur";
                    return $golru;
                })
                ->addColumn('pangkatPuncak', function($data){
                    $gol = Golongan::where('kode','=',$data->pangkatPuncak)->get();
                    $golru = ($gol->isNotEmpty()) ? $gol[0]->golPNS.' - '.$gol[0]->pangkatPNS : "Tidak diatur";
                    return $golru ;
                })
                ->addColumn('tktPendidikan', function($data){
                    $tkp = Tkt_Pendidikan::where('kode','=',$data->tktPendidikan)->get();
                    // dd($tkp);
                    $tktP = "Tidak diatur";
                    if($tkp->isNotEmpty()) {
                        $tktP = $tkp[0]->nama;
                    }
                    return $tktP;
                })
                ->addColumn('aksi', function ($data) {
                    $button = '<button id="'.$data->id.
                    '" name= "edit" class="edit btn btn-warning" >Edit</button>';
                    $button.= ' <button id="'.$data->kode.
                    '" name="hapus" class="hapus btn btn-danger">Hapus</button>';
                    return $button;
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }
        return view('owner.kategorijabatan',compact('data','golongan', 'tktPendidikan'));
    }

    public function store(Request $request)
    {
        $rules = [
            'kode' => 'required',
            'kategori' => 'required',
            'jenis' => 'required',
        ];

        $text = [
            'kode' => 'kode harus diisi.',
            'kategori' => 'kategori harus diisi.',
            'jenis' => 'jenis harus diisi.',
        ];

        $validasi = Validator::make($request->all(), $rules, $text);
        if ($validasi->fails()) {
            return response()->json(['success' => 0, 'text' => $validasi->errors()->first()], 422);
        }

        $dataKategorijabatan = [
            'kode' => $request->kode,
            'kategori' => $request->kategori,
            'jenis' => $request->jenis,
            'pangkatDasar' => $request->pangkatDasar,
            'pangkatPuncak' => $request->pangkatPuncak,
            'tktPendidikan' => $request->tktPendidikan,
            'keterangan' => $request->keterangan,
        ];

        if ($request->mode == 'save') {
            $kategoriJabatan = Kategorijabatan::create($dataKategorijabatan);
        } else {
            $data = Kategorijabatan::all()->where('kode', '=', $request->kode)->first();
            $kategoriJabatan = $data->update($dataKategorijabatan);
        }

        if ($kategoriJabatan) {
            return response()->json(['text' => 'Kategori jabatan ditambahkan/diperbaharui'], 200);
        } else {
            return response()->json(['text' => 'Operasi gagal'], 422);
        }
    }

    public function hapus(Request $request)
    {
        $data = Kategorijabatan::where('kode', '=', $request->kode)->first();
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
        $data = Kategorijabatan::find($request->id);
        return response()->json($data, 200);
    }

}
