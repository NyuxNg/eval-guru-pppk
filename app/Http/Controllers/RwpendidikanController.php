<?php

namespace App\Http\Controllers;

use App\Models\Pegawaipns;
use App\Models\Pendidikan;
use App\Models\Rwpendidikan;
use Illuminate\Http\Request;
use App\Models\Tkt_Pendidikan;
use Illuminate\Support\Facades\Validator;

class RwpendidikanController extends Controller
{
    public function index()
    {
        $tktPendidikan = Tkt_Pendidikan::orderBy('kode', 'asc')->get();
        return view('owner.rwpendidikan',compact('tktPendidikan'));
    }

    public function datariwayat(Request $request)
    {
        $data = Rwpendidikan::join()->orderBy('nip_baru', 'asc')->orderByDesc('thnLulus');
        $data = ($request->nip_baru) ? $data->where('nip_baru', '=', $request->nip_baru) : $data;
        $data = ($request->nama) ? $data->where('pegawaipns.nama', 'like', '%' .$request->nama. '%') : $data;


        $data = ($request->cari_idtktPendidikan) ? $data->where('tktPendidikan', '=', $request->cari_idtktPendidikan) : $data;
        $data = ($request->cariJurusan) ? $data->where('pendidikans.nama', 'like', '%' .$request->cariJurusan.'%') : $data;
        $data = ($request->cariSekolah) ? $data->where('namaSekolah', 'like', '%' .$request->cariSekolah.'%') : $data;
        $data = ($request->cariLokasi) ? $data->where('lokasi', 'like', '%' .$request->cariLokasi.'%') : $data;
        $data = ($request->cari_tglAwal != '') ? $data->whereBetween('tglLulus',[$request->cari_tglAwal, $request->cari_tglAkhir]) : $data;

        $data = ($request->jumlahView != 'All') ? $data->take($request->jumlahView) : $data;
        $data = $data->get();

        if (request()->ajax()) {
            return datatables()
             ->of($data)
                ->addColumn('nama', function($data){
                    $depan = $data->gelar_depan;
                    $belakang = $data->gelar_blk;
                    $nama = $data->nama;
                    $lengkap = PegawaipnsController::namaLengkap(
                        $depan,
                        $nama,
                        $belakang
                    );
                    return $lengkap;
                })
                ->addColumn('pendAwal', function($data){
                    $pendAwal = ($data->pendAwal) ? '<i class="fas fa-check"></i>' : '<i class="fas fa-times"></i>';
                    return $pendAwal;
                })
                ->addColumn('aksi', function ($data) {
                    $button = '<button id="'.$data->id.
                    '" name= "edit" class="edit-pendidikan btn btn-warning" >Edit</button>';
                    $button.= ' <button id="'.$data->id.
                    '" name="hapus" class="hapus-pendidikan btn btn-danger">Hapus</button>';
                    return $button;
                })
                ->rawColumns(['pendAwal', 'aksi'])
                ->make(true);
        }
    }

    public function store(Request $request)
    {
        $rules = [
            'tglLulus' => 'required',
            'thnLulus' => 'required',
            'noIjazah' => 'required',
            'lokasi' => 'required',
            'idOrang' => 'required',
            'idPendidikan' => 'required',
        ];

        $text = [
            'tglLulus' => 'tglLulus harap dilengkapi!',
            'thnLulus' => 'thnLulus harap dilengkapi!',
            'noIjazah' => 'noIjazah harap dilengkapi!',
            'namaSekolah' => 'namaSekolah harap dilengkapi!',
            'idOrang' => 'idOrang harap dilengkapi!',
            'idPendidikan' => 'idPendidikan harap dilengkapi!',
        ];

        $validasi = Validator::make($request->all(), $rules, $text);
        if ($validasi->fails()) {
            return response()->json(['success' => 0, 'text' => $validasi->errors()->first()], 422);
        }

        $datarwpendidikan = [
            'tglLulus' => $request->tglLulus,
            'thnLulus' => $request->thnLulus,
            'noIjazah' => $request->noIjazah,
            'namaSekolah' => $request->namaSekolah,
            'lokasi' => $request->lokasi,
            'glrDepan' => $request->glrDepan,
            'glrBelakang' => $request->glrBelakang,
            'pendAwal' => $request->pendAwal,
            'idOrang' => $request->idOrang,
            'idPendidikan' => $request->idPendidikan,
        ];

        if ($request->mode == 'save') {
            $rwpendidikan = Rwpendidikan::create($datarwpendidikan);
        } else {
            $data = Rwpendidikan::all()->where('id', '=', $request->id)->first();
            $rwpendidikan = $data->update($datarwpendidikan);
        }

        if ($rwpendidikan) {
            return response()->json(['text' => 'Riwayat pendidikan ditambahkan/diperbaharui'], 200);
        } else {
            return response()->json(['text' => 'Operasi gagal'], 422);
        }
    }

    public function hapus(Request $request)
    {
        $data = Rwpendidikan::where('id', '=', $request->kode)->first();
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
        $data = Rwpendidikan::find($request->id);
        $pegawai = Pegawaipns::where('pns_id', '=', $data['idOrang'])->get();
        $pendidikan = Pendidikan::where('id', '=', $data['idPendidikan'])->get();
        $tktpendidikan = Tkt_Pendidikan::where('kode', '=', $pendidikan[0]->tktPendidikan)->get();
        if($pegawai) {
            $depan = $pegawai[0]->gelar_depan;
            $belakang = $pegawai[0]->gelar_blk;
            $nama = $pegawai[0]->nama;
            $lengkap = PegawaipnsController::namaLengkap(
                $depan,
                $nama,
                $belakang
            );
            $data['nip_baru'] = $pegawai[0]->nip_baru;
            $data['namalengkap'] = $lengkap;
            $data['namaPendidikan'] = $pendidikan[0]->nama;
            $data['tktPendidikan'] = $tktpendidikan[0]->id;
        }
        return response()->json($data, 200);
    }
}
