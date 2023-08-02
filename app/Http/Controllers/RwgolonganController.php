<?php

namespace App\Http\Controllers;

use App\Models\Jeniskp;
use App\Models\Golongan;
use App\Models\Pegawaipns;
use App\Models\Rwgolongan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RwgolonganController extends Controller
{
    public function index()
    {
        $jeniskp = Jeniskp::orderBy('kode','asc')->get();
        $golongan = Golongan::orderBy('kode','asc')->get();
        return view('owner.rwgolongan',compact('golongan','jeniskp'));
    }
    public function datariwayat(Request $request)
    {
        $data = Rwgolongan::join()->orderBy('nip_baru', 'asc')->orderByDesc('golPNS');
        $data = ($request->nip_baru) ? $data->where('nip_baru', '=', $request->nip_baru) : $data;
        $data = ($request->nama) ? $data->where('pegawaipns.nama', 'like', '%' .$request->nama. '%') : $data;
        $data = ($request->jeniskp != '') ? $data->where('idJeniskp', '=', $request->jeniskp) : $data;
        $data = ($request->cari_golAwal != '') ? $data->whereBetween('golongans.kode',[$request->cari_golAwal, $request->cari_golAkhir]) : $data;
        $data = ($request->cari_skAwal != '') ? $data->whereBetween('tmt',[$request->cari_skAwal, $request->cari_skAkhir]) : $data;
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
                    '" name= "edit" class="edit-gol btn btn-warning" >Edit</button>';
                    $button.= ' <button id="'.$data->id.
                    '" name="hapus" class="hapus-gol btn btn-danger">Hapus</button>';
                    return $button;
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }

    }

    public function store(Request $request)
    {
        $rules = [
            'skTanggal' => 'required',
            'pertekNomor' => 'required',
            'pertekTanggal' => 'required',
            'tmt' => 'required',
            'mkGolTahun' => 'required',
            'mkGolBulan' => 'required',
            'idOrang' => 'required',
            'idJeniskp' => 'required',
            'idGolongan' => 'required',
        ];

        $text = [
            'skTanggal.required' => 'skTanggal harap dilengkapi.',
            'pertekNomor.required' => 'pertekNomor harap dilengkapi.',
            'pertekTanggal.required' => 'pertekTanggal harap dilengkapi.',
            'tmt.required' => 'tmt harap dilengkapi.',
            'mkGolTahun.required' => 'mkGolTahun harap dilengkapi.',
            'mkGolBulan.required' => 'mkGolBulan harap dilengkapi.',
            'idOrang.required' => 'idOrang harap dilengkapi.',
            'idJeniskp.required' => 'idJeniskp harap dilengkapi.',
            'idGolongan.required' => 'idGolongan harap dilengkapi.',
        ];

        $validasi = Validator::make($request->all(), $rules, $text);
        if ($validasi->fails()) {
            return response()->json(['success' => 0, 'text' => $validasi->errors()->first()], 422);
        }

        $datarwgolongan = [
            'skNomor' => $request->skNomor,
            'skTanggal' => $request->skTanggal,
            'pertekNomor' => $request->pertekNomor,
            'pertekTanggal' => $request->pertekTanggal,
            'tmt' => $request->tmt,
            'akUtama' => $request->akUtama,
            'akTambahan' => $request->akTambahan,
            'mkGolTahun' => $request->mkGolTahun,
            'mkGolBulan' => $request->mkGolBulan,
            'idOrang' => $request->idOrang,
            'idJeniskp' => $request->idJeniskp,
            'idGolongan' => $request->idGolongan,
        ];

        if ($request->mode == 'save') {
            $rwgolongan = Rwgolongan::create($datarwgolongan);
        } else {
            $data = Rwgolongan::all()->where('id', '=', $request->id)->first();
            $rwgolongan = $data->update($datarwgolongan);
        }

        if ($rwgolongan) {
            return response()->json(['text' => 'Riwayat golongan ditambahkan/diperbaharui'], 200);
        } else {
            return response()->json(['text' => 'Operasi gagal'], 422);
        }
    }
    public function hapus(Request $request)
    {
        $data = Rwgolongan::where('id', '=', $request->kode)->first();
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
        $data = Rwgolongan::find($request->id);
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
