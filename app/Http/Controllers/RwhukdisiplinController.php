<?php

namespace App\Http\Controllers;

use App\Models\Golongan;
use App\Models\Pegawaipns;
use App\Models\Jenishukuman;
use Illuminate\Http\Request;
use App\Models\Rwhukdisiplin;
use App\Models\Tingkathukdis;
use Illuminate\Support\Facades\Validator;

class RwhukdisiplinController extends Controller
{
    public function index()
    {
        $golongan = Golongan::orderBy('kode','asc')->get();
        $tingkatHukdis = Tingkathukdis::orderBy('kode','asc')->get();
        $jenishukuman = Jenishukuman::join()->orderBy('kode_tkt','desc')->get();
        return view('owner.rwhukdisiplin',compact(
            'golongan',
            'jenishukuman',
            'tingkatHukdis'
        ));
    }

    public function datariwayat(Request $request)
    {
        $data = Rwhukdisiplin::join()->orderBy('nip_baru', 'asc')->orderByDesc('skTanggal');
        $data = ($request->nip_baru) ? $data->where('nip_baru', '=', $request->nip_baru) : $data;
        $data = ($request->nama) ? $data->where('pegawaipns.nama', 'like', '%' .$request->nama. '%') : $data;

        $data = ($request->cari_tktHukdisiplin) ? $data->where('tingkathukdis.id', '=', $request->cari_tktHukdisiplin) : $data;
        $data = ($request->cari_jenisHukdisiplin) ? $data->where('jenishukuman.id', '=', $request->cari_jenisHukdisiplin) : $data;
        $data = ($request->cari_golAwal != '') ? $data->whereBetween('golongans.kode',[$request->cari_golAwal, $request->cari_golAkhir]) : $data;
        $data = ($request->cari_tglAwal != '') ? $data->whereBetween('tmt',[$request->cari_tglAwal, $request->cari_tglAkhir]) : $data;

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
                ->addColumn('aksi', function ($data) {
                    $button = '<button id="'.$data->id.
                    '" name= "edit" class="edit-hukdis btn btn-warning" >Edit</button>';
                    $button.= ' <button id="'.$data->id.
                    '" name="hapus" class="hapus-hukdis btn btn-danger">Hapus</button>';
                    return $button;
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }
    }
    public function store(Request $request)
    {
        $rules = [
            'idOrang' => 'required',
            'idHukdis' => 'required',
            'idGolongan' => 'required',
            'skNomor' => 'required',
            'skTanggal' => 'required',
        ];

        $text = [
            'idOrang' => 'idOrang harap dilengkapi!',
            'idHukdis' => 'idHukdis harap dilengkapi!',
            'idGolongan' => 'idGolongan harap dilengkapi!',
            'skNomor' => 'skNomor harap dilengkapi!',
            'skTanggal' => 'skTanggal harap dilengkapi!',
        ];

        $validasi = Validator::make($request->all(), $rules, $text);
        if ($validasi->fails()) {
            return response()->json(['success' => 0, 'text' => $validasi->errors()->first()], 422);
        }

        $datarwhukdisiplin = [
            'skNomor' => $request->skNomor,
            'skTanggal' => $request->skTanggal,
            'tglMulai' => $request->tglMulai,
            'masaTahun' => $request->masaTahun,
            'masaBulan' => $request->masaBulan,
            'tglAkhir' => $request->tglAkhir,
            'ppNomor' => $request->ppNomor,
            'skPembatalan' => $request->skPembatalan,
            'tglSkbatal' => $request->tglSkbatal,
            'idOrang' => $request->idOrang,
            'idHukdis' => $request->idHukdis,
            'idGolongan' => $request->idGolongan,
        ];

        if ($request->mode == 'save') {
            $rwhukdisiplin = Rwhukdisiplin::create($datarwhukdisiplin);
        } else {
            $data = Rwhukdisiplin::all()->where('id', '=', $request->id)->first();
            $rwhukdisiplin = $data->update($datarwhukdisiplin);
        }

        if ($rwhukdisiplin) {
            return response()->json(['text' => 'Riwayat hukuman disiplin ditambahkan/diperbaharui'], 200);
        } else {
            return response()->json(['text' => 'Operasi gagal'], 422);
        }
    }
    public function hapus(Request $request)
    {
        $data = Rwhukdisiplin::where('id', '=', $request->kode)->first();
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
        $data = Rwhukdisiplin::find($request->id);
        $pegawai = Pegawaipns::where('pns_id', '=', $data['idOrang'])->get();

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
        }
        return response()->json($data, 200);
    }

}
