<?php

namespace App\Http\Controllers;

use App\Models\Thl2023;
use App\Models\Presensi;
use Illuminate\Http\Request;
use App\Models\Perangkatdaerah;
use Illuminate\Support\Facades\Validator;

class Thl2023Controller extends Controller
{
    public function index()
    {
        $perangkatDaerah = Perangkatdaerah::join()->orderBy('nama', 'asc') ->get();
        return view('thl.thl2023', compact('perangkatDaerah'));
    }

    public function dataThl2023(Request $request)
    {
        ini_set('max_execution_time', 300);
        $cekStatus = ($request->cari_status == 'no-status') ? null:$request->cari_status;

        $data = Thl2023::join();
        $data = ($request->cari_thl) ? $data->where('thl2023.namaLengkap', 'like', '%'. $request->cari_thl . '%') : $data;
        $data = ($request->cari_perangkatdaerah != 'all') ? $data->where('idPerangkatDaerah', '=', $request->cari_perangkatdaerah) : $data;
        $data = ($request->cari_status != 'all') ? $data->where('status', '=', $cekStatus) : $data;

        $data = ($request->jumlahView != 'All') ? $data->take($request->jumlahView) : $data;
        // $data = $data->cursor();
        // $upt = $data->select('uptkelurahan')->get()->unique('uptkelurahan');

        if (request()->ajax()) {
            return datatables()
                ->of($data)
                ->addColumn('idPresensi', function($data){
                    $presensi = $data->idPresensi;
                    $cekPresensi = Presensi::all()->where('idTHL', '=', $data->idPresensi)->first();
                    if($cekPresensi) {
                        $presensi = '<a name="cek" data-toggle="modal" data-target="#modelDetailPresensi" href="#" role="button" class="lihat-presensi btn ';
                        if ($cekPresensi->status == 'AMAN') {
                            $presensi .= 'btn-success">'.$data->idPresensi.'</a>';
                        } else {
                            $presensi .= 'btn-danger">'.$data->idPresensi.'</a>' ;
                        }
                    }

                    return $presensi;
                })
                ->addColumn('status', function ($data) {
                    // $status = '';
                    $status = '<button title="Data presensi" type="button" id="'.$data->id. '" data="'.$data->namaLengkap.
                        '" name= "edit" class="presensi btn btn-success" data-toggle="modal" data-target="#modalPresensi"><i class="fas fa-server"></i></button> &nbsp;';
                    $status .= '<button id="'.$data->id.'  " ';
                    if($data->status == 'aktif') {
                        $status .= 'class="edit-status btn btn-outline-success" ><i class="fas fa-user-check"></i> Aktif';
                    } elseif ($data->status =='tidak aktif') {
                        $status .= 'class="edit-status btn btn-outline-danger"><i class="fas fa-user-alt-slash"></i> Tidak Aktif';

                    } elseif ($data->status =='pindahan') {
                        $status .= 'class="edit-status btn btn-outline-warning"><i class="fas fa-person-booth" title="Pindahan dari Perangkat daerah lain"></i> Pindahan';

                    } elseif ($data->status =='baru')   {
                        $status .= 'class="edit-status btn btn-outline-info" title="Sukarela berdisposisi" ><i class="fas fa-baby"></i> Baru';

                    } else {
                        $status .= 'class="edit-status btn btn-outline-secondary"><i class="far fa-question-circle"></i>';
                    }
                    $status .= '</button>';

                    return $status;
                })
                ->addColumn('namaLengkap', function ($data) {
                    $nama = mb_convert_encoding(strtoupper($data->namaLengkap),"UTF-8", "auto");
                    return $nama;
                })
                ->addColumn('aksi', function ($data) {

                        $button = '<button title="Edit Data" id="'.$data->id.
                        '" name= "edit" class="edit btn btn-warning " >Edit</button>';
                        $button .= ' <button title="Hapus Data" id="'.$data->id.
                        '" name="xhapus" disabled class="xhapus btn btn-danger ">Hapus</button>';
                        return $button;
                })
                ->rawColumns(['idPresensi','namaLengkap', 'status', 'aksi'])
                ->make(true);
        }


    }


    public function store(Request $request)
    {
        $rules = [
            'nomorUrut' => 'required',
            'namaLengkap' => 'required',
            'jabatan' => 'required',
            'idPerangkatDaerah' => 'required',
            'status' => 'required',
        ];

        $text = [
            'nomorUrut.required' => 'nomor urut harap dilengkapi!',
            'namaLengkap.required' => 'nama lengkap harap dilengkapi!',
            'jabatan.required' => 'jabatan harap dilengkapi!',
            'idPerangkatDaerah.required' => 'idPerangkatDaerah harap dilengkapi!',
            'status.required' => 'status harap dilengkapi!',
        ];

        $validasi = Validator::make($request->all(), $rules, $text);
        if ($validasi->fails()) {
            return response()->json(['success' => 0, 'text' => $validasi->errors()->first()], 422);
        }

        $dataThl2023 = [
            'id' => $request->id,
            'nomorUrut' => $request->nomorUrut,
            'nik' => $request->nik,
            'idPresensi' => $request->idPresensi,
            'namaLengkap' => $request->namaLengkap,
            'lahirTempat' => $request->lahirTempat,
            'lahirTanggal' => $request->lahirTanggal,
            'jenisKelamin' => $request->jenisKelamin,
            'pendidikanJurusan' => $request->pendidikanJurusan,
            'pendidikanLulus' => $request->pendidikanLulus,
            'jabatan' => $request->jabatan,
            'uraianTugas' => $request->uraianTugas,
            'honor' => $request->honor,
            'masukTahun' => $request->masukTahun,
            'masakerjaTahun' => $request->masakerjaTahun,
            'masakerjaBulan' => $request->masakerjaBulan,
            'keterangan' => $request->keterangan,
            'status' => $request->status,
            'idPerangkatDaerah' => $request->idPerangkatDaerah,
            'uptkelurahan' => $request->uptkelurahan,
        ];

        if ($request->mode == 'save') {
            $thl2023 = Thl2023::create($dataThl2023);
        } else {
            $data = Thl2023::all()->where('id', '=', $request->id)->first();
            $thl2023 = $data->update($dataThl2023);
        }

        if ($thl2023) {
            return response()->json(['text' => 'Data berhasil ditambahkan/diperbaharui'], 200);
        } else {
            return response()->json(['text' => 'Operasi gagal'], 422);
        }
    }

    public function hapus(Request $request)
    {
        $data = Thl2023::where('id', '=', $request->kode)->first();
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
        $data = Thl2023::find($request->id);
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
        $data = Thl2023::all()->where('id', '=', $request->id)->first();
        // $data->status = ($data->status != 'aktif') ? 'aktif' : 'tidak aktif';

        if ($data->status == 'aktif') {
            $data->status = 'tidak aktif';
        } elseif($data->status == 'tidak aktif') {
            $data->status = 'pindahan';
        } elseif($data->status == 'pindahan') {
            $data->status = 'baru';
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

    public function statusTHL(Request $request)
    {
        $cekupt = ($request->cari_upt !='all') ? $request->cari_upt:false;
        if($request->idPerangkatDaerah != 'all') {
            $thl2023 = Thl2023::all()->where('idPerangkatDaerah', '=', $request->idPerangkatDaerah);
            $thl2023 = ($cekupt) ? $thl2023->where('uptkelurahan', '=', $cekupt) : $thl2023;

            $data = [
                'status_aktif' =>$thl2023->where('status', '=', 'aktif')->count(),
                'status_tidakaktif' => $thl2023->where('status', '=', 'tidak aktif')->count(),
                'status_pindah' => $thl2023->where('status', '=', 'pindahan')->count(),
                'status_baru' => $thl2023->where('status', '=', 'baru')->count(),
                'status_null' => $thl2023->where('status', '=', null)->count(),
            ];
        } else {
            $data = [
                'status_aktif' => Thl2023::all()->where('status', '=', 'aktif')->count(),
                'status_tidakaktif' => Thl2023::all()->where('status', '=', 'tidak aktif')->count(),
                'status_pindah' => Thl2023::all()->where('status', '=', 'pindahan')->count(),
                'status_baru' => Thl2023::all()->where('status', '=', 'baru')->count(),
                'status_null' => Thl2023::all()->where('status', '=', null)->count(),
            ];
        }

        return response()->json($data, 200);
    }
}
