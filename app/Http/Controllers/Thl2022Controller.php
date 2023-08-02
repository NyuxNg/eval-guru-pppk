<?php

namespace App\Http\Controllers;

use App\Models\Perangkatdaerah;
use App\Models\Thl2022;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Thl2022Controller extends Controller
{
    public function index()
    {
        $perangkatDaerah = Perangkatdaerah::join()->orderBy('nama', 'asc') ->get();
        return view('thl.thl2022', compact('perangkatDaerah'));
    }

    public function dataThl2022(Request $request)
    {
        $data = Thl2022::join();
        $data = ($request->cari_thl) ? $data->where('thl2022.nama', 'like', '%'. $request->cari_thl . '%') : $data;
        $data = ($request->cari_perangkatdaerah != 'all') ? $data->where('idPerangkatDaerah', '=', $request->cari_perangkatdaerah) : $data;
        $data = ($request->cari_status != 'all') ? $data->where('status', '=', $request->cari_status) : $data;

        $data = ($request->jumlahView != 'All') ? $data->take($request->jumlahView) : $data;
        $data = $data->get();

        if (request()->ajax()) {
            return datatables()
                ->of($data)
                ->addColumn('status', function ($data) {
                    $status = '<button title="Data presensi" type="button" id="'.$data->id. '" data="'.$data->nama.
                        '" name= "edit" class="presensi btn btn-success" data-toggle="modal" data-target="#modalPresensi"><i class="fas fa-server"></i></button> &nbsp;';
                    $status .= '<button id="'.$data->id.'  " ';
                    if($data->status == 'aktif') {
                        $status .= 'class="edit-status btn btn-outline-success" ><i class="fas fa-user-check"></i> Aktif';
                    } elseif ($data->status =='tidak aktif') {
                        $status .= 'class="edit-status btn btn-outline-danger"><i class="fas fa-user-alt-slash"></i> Tidak Aktif';

                    } elseif ($data->status =='pindah') {
                        $status .= 'class="edit-status btn btn-outline-warning"><i class="fas fa-person-booth"></i> Pindah';

                    } else {
                        $status .= 'class="edit-status btn btn-outline-secondary"><i class="far fa-question-circle"></i>';
                    }
                    $status .= '</button>';

                    return $status;
                })
                ->addColumn('nama', function ($data) {
                    $nama = mb_convert_encoding(strtoupper($data->nama),"UTF-8", "auto");
                    return $nama;
                })
                ->addColumn('aksi', function ($data) {

                        $button = '<button title="Edit Data" id="'.$data->id.
                        '" name= "edit" class="edit btn btn-warning " >Edit</button>';
                        $button .= ' <button title="Hapus Data" id="'.$data->id.
                        '" name="hapus" disabled class="hapus btn btn-danger ">Hapus</button>';
                        return $button;
                })
                ->rawColumns(['nama', 'status', 'aksi'])
                ->make(true);
        }
    }

    public function store(Request $request)
    {
        $rules = [
            'nomor_urut' => 'required',
            'nama' => 'required',
            // 'pendidikan' => 'required',
            // 'jabatan' => 'required',
            // 'sumberHonor' => 'required',
            'status' => 'required',
            'idPerangkatDaerah' => 'required',
        ];

        $text = [
            'nomor_urut.required' => 'nomor_urut harap dilengkapi!',
            'nama.required' => 'nama harap dilengkapi!',
            // 'pendidikan.required' => 'pendidikan harap dilengkapi!',
            // 'jabatan.required' => 'jabatan harap dilengkapi!',
            // 'sumberHonor.required' => 'sumberHonor harap dilengkapi!',
            'status.required' => 'status harap dilengkapi!',
            'idPerangkatDaerah.required' => 'idPerangkatDaerah harap dilengkapi!',
        ];

        $validasi = Validator::make($request->all(), $rules, $text);
        if ($validasi->fails()) {
            return response()->json(['success' => 0, 'text' => $validasi->errors()->first()], 422);
        }

        $dataThl2022 = [
            'nomor_urut' => $request->nomor_urut,
            'nama' => $request->nama,
            'pendidikan' => $request->pendidikan,
            'jabatan' => $request->jabatan,
            'sumberHonor' => $request->sumberHonor,
            'status' => $request->status,
            'set_idabsensi' => $request->set_idabsensi,
            'set_nik' => $request->set_nik,
            'keterangan' => $request->keterangan,
            'idPerangkatDaerah' => $request->idPerangkatDaerah,
        ];

        if ($request->mode == 'save') {
            $thl2022 = Thl2022::create($dataThl2022);
        } else {
            $data = Thl2022::all()->where('id', '=', $request->id)->first();
            $thl2022 = $data->update($dataThl2022);
        }

        if ($thl2022) {
            return response()->json(['text' => 'Data berhasil ditambahkan/diperbaharui'], 200);
        } else {
            return response()->json(['text' => 'Operasi gagal'], 422);
        }
    }

    public function hapus(Request $request)
    {
        $data = Thl2022::where('id', '=', $request->kode)->first();
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
        $data = Thl2022::find($request->id);
        $perangkatDaerah = Perangkatdaerah::join()->where(
            'id',
            '=',
            $data['idPerangkatDaerah']
        )->get();
        $data['cariPerangkatDaerah'] = $perangkatDaerah[0]->nama;
        return response()->json($data, 200);
    }

    public function editStatus(Request $request)
    {
        $data = Thl2022::all()->where('id', '=', $request->id)->first();
        // $data->status = ($data->status != 'aktif') ? 'aktif' : 'tidak aktif';

        if ($data->status == 'aktif') {
            $data->status = 'tidak aktif';
        } elseif($data->status == 'tidak aktif') {
            $data->status = 'pindah';
        } else{
            $data->status = 'aktif';
        }

        $thl2022 = $data->update(array('data' => $data));

        if ($thl2022) {
            return response()->json(['text' => 'Status berhasil diubah'], 200);
        } else {
            return response()->json(['text' => 'Operasi gagal'], 422);
        }
    }

}
