<?php

namespace App\Http\Controllers;

use App\Models\Presensi;
use Illuminate\Http\Request;
use Illuminate\View\ViewName;
use App\Models\Perangkatdaerah;

use function PHPUnit\Framework\isEmpty;
use Illuminate\Support\Facades\Validator;

class PresensiController extends Controller
{
    public function index()
    {
        $perangkatDaerah = Perangkatdaerah::join()->orderBy('nama', 'asc') ->get();
        return view('thl.presensi', compact('perangkatDaerah'));
    }

    public function dataPresensi(Request $request)
    {
        $data = Presensi::join();
        $data = ($request->cari_thl) ? $data->where('nama', 'like', '%'. $request->cari_thl . '%') : $data;
        $data = ($request->cari_perangkatdaerah != 'all') ? $data->where('idPerangkatDaerah', '=', $request->cari_perangkatdaerah) : $data;
        $data = ($request->cari_Juli != 'all' ) ? $data->where('presensiJuli', 'like', '%' . $request->cari_Juli . '%') : $data;
        $data = ($request->cari_Agustus != 'all') ? $data->where('presensiAgustus', 'like', '%' . $request->cari_Agustus . '%') : $data;
        $data = ($request->cari_September != 'all') ? $data->where('presensiSeptember', 'like', '%' . $request->cari_September . '%') : $data;
        $data = ($request->cari_Oktober != 'all') ? $data->where('presensiOktober', 'like', '%' . $request->cari_Oktober . '%') : $data;
        $data = ($request->cari_November != 'all') ? $data->where('presensiNovember', 'like', '%' . $request->cari_November . '%') : $data;
        $data = ($request->cari_Desember != 'all') ? $data->where('presensiDesember', 'like', '%' . $request->cari_Desember . '%') : $data;
        $data = ($request->jumlahView != 'All') ? $data->take($request->jumlahView) : $data;
        $data = $data->get();

        if (request()->ajax()) {
            return datatables()
                ->of($data)

                ->addColumn('nama', function ($data) {
                    $nama = strtoupper($data->nama);
                return $nama;
                })
                ->addColumn('aksi', function ($data) {
                    $button = '<button id="' . $data->id .
                        '" name="edit" class="edit btn btn-warning">Edit</button>';
                    $button .= ' <button id="' . $data->id .
                        '" name="hapus" class="hapus btn btn-danger">Hapus</button>';
                return $button;
                })
                ->rawColumns(['status','aksi'])
                ->make(true);
        }
    }

    public function store(Request $request)
    {
        $rules = [
            'idTHL' => 'required',
            'nama' => 'required',
            // 'perangkatDaerah' => 'required',
            'presensiGrandTotal' => 'required',
            'status' => 'required',
        ];

        $text = [
            'idTHL.required' => 'idTHL harap dilengkapi!',
            'nama.required' => 'nama harap dilengkapi!',
            // 'perangkatDaerah.required' => 'perangkatDaerah harap dilengkapi!',
            'presensiGrandTotal.required' => 'presensiGrandTotal harap dilengkapi!',
            'status.required' => 'status harap dilengkapi!',
        ];

        $validasi = Validator::make($request->all(), $rules, $text);
        if ($validasi->fails()) {
            return response()->json(['success' => 0, 'text' => $validasi->errors()->first()], 422);
        }

        $dataPresensi = [
            'idTHL'=>$request->idTHL,
            'nama'=>$request->nama,
            'perangkatDaerah'=>$request->perangkatDaerah,
            'presensiJuli'=>$request->presensiJuli,
            'presensiAgustus'=>$request->presensiAgustus,
            'presensiSeptember'=>$request->presensiSeptember,
            'presensiOktober'=>$request->presensiOktober,
            'presensiNovember'=>$request->presensiNovember,
            'presensiDesember'=>$request->presensiDesember,
            'presensiGrandTotal'=>$request->presensiGrandTotal,
            'status'=>$request->status,

        ];

        if ($request->mode == 'save') {
            $Presensi = Presensi::create($dataPresensi);
        } else {
            $data = Presensi::all()->where('id', '=', $request->id)->first();
            $Presensi = $data->update($dataPresensi);
        }

        if ($Presensi) {
            return response()->json(['text' => 'Data berhasil ditambahkan/diperbaharui'], 200);
        } else {
            return response()->json(['text' => 'Operasi gagal'], 422);
        }
    }

    public function hapus(Request $request)
    {
        $data = Presensi::where('id', '=', $request->kode)->first();
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
        if($request->idTHL) {
            $data = Presensi::all()->where('idTHL', '=', $request->idTHL)->first();
        } else {
            $data = Presensi::find($request->id);
        }

        return response()->json($data, 200);
    }


}
