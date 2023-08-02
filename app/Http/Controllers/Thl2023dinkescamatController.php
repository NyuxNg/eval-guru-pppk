<?php

namespace App\Http\Controllers;

use App\Models\Thl2023;
use App\Models\Presensi;
use Illuminate\Http\Request;

class Thl2023dinkescamatController extends Controller
{
    public function index()
    {
        $upt = Thl2023::join()
            ->where('idPerangkatDaerah', '=', '4867ae3d')
            ->select('uptkelurahan')->get()->unique('uptkelurahan');

        return view('thl.thl2023dinkescamat', compact('upt'));
    }

    public function dataThl2023(Request $request)
    {
        ini_set('max_execution_time', 300);
        $cekStatus = ($request->cari_status == 'no-status') ? null:$request->cari_status;

        $data = Thl2023::join()
            ->where('idPerangkatDaerah', '=', '4867ae3d');

        $data = ($request->cari_thl) ? $data->where('thl2023.namaLengkap', 'like', '%'. $request->cari_thl . '%') : $data;
        $data = ($request->cari_upt != 'all') ? $data->where('uptkelurahan', 'like', '%'. $request->cari_upt. '%') : $data;
        $data = ($request->cari_status != 'all') ? $data->where('status', '=', $cekStatus) : $data;

        $data = ($request->jumlahView != 'All') ? $data->take($request->jumlahView) : $data;


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
}
