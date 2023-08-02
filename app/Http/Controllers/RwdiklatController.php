<?php

namespace App\Http\Controllers;

use App\Models\Rwdiklat;
use App\Models\Pegawaipns;
use App\Models\Jenisdiklat;
use App\Models\Satuankerja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\PegawaipnsController;
use App\Models\Diklatstruktural;

class RwdiklatController extends Controller
{
    public function index()
    {
        $jenisdiklat = Jenisdiklat::orderBy('id_siasn', 'asc')->get();
        $diklatstruktural = Diklatstruktural::orderBy('id_siasn', 'asc')->get();
        return view('owner.rwdiklat', compact('jenisdiklat', 'diklatstruktural'));
    }

    public function datariwayat(Request $request)
    {
        $data = Rwdiklat::join()->orderBy('nip_baru', 'asc')->orderByDesc('tahun');
        $data = ($request->nip_baru) ? $data->where('nip_baru', '=', $request->nip_baru) : $data;
        $data = ($request->nama) ? $data->where('pegawaipns.nama', 'like', '%' .$request->nama. '%') : $data;


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
                    '" name= "edit" class="edit-diklat btn btn-warning" >Edit</button>';
                    $button.= ' <button id="'.$data->id.
                    '" name="hapus" class="hapus-diklat btn btn-danger">Hapus</button>';
                    return $button;
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }
    }

    public function store(Request $request)
    {
        $rules = [
            'diklat_nama' => 'required',
            'institusi_penyelenggara' => 'required',
            'tahun' => 'required',
        ];

        $text = [
            'diklat_nama.required' => 'Nama diklat harap dilengkapi.',
            'institusi_penyelenggara.required' => 'Institusi penyelenggara harap dilengkapi.',
            'tahun.required' => 'Tahun pelaksanaan harap dilengkapi.',
        ];

        $validasi = Validator::make($request->all(), $rules, $text);
        if ($validasi->fails()) {
            return response()->json(['success' => 0, 'text' => $validasi->errors()->first()], 422);
        }

        $datarwdiklat = [
            'diklat_nama' => $request->diklat_nama,
            'nomor_sertipikat' => $request->nomor_sertipikat,
            'tanggal_sertipikat' => $request->tanggal_sertipikat,
            'bobot_kompetensi' => $request->bobot_kompetensi,
            'jenis_kompetensi' => $request->jenis_kompetensi,
            'institusi_penyelenggara' => $request->institusi_penyelenggara,
            'jumlah_jam' => $request->jumlah_jam,
            'durasi_hari' => $request->durasi_hari,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'tahun' => $request->tahun,
            'jenis_kursus_id' => $request->jenis_kursus_id,
            'path' => $request->path,
            'tipe' => $request->tipe,
            'id_riwayat_update' => $request->id_riwayat_update,
            'jenis_kursus_sertipikat' => $request->jenis_kursus_sertipikat,
            'idOrang' => $request->idOrang,
            'jenis_diklat_id' => $request->jenis_diklat_id,
            'latihan_struktural_id' => $request->latihan_struktural_id,
            'instansi_id' => $request->instansi_id,
        ];

        if ($request->mode == 'save') {
            $rwdiklat = Rwdiklat::create($datarwdiklat);
        } else {
            $data = Rwdiklat::all()->where('id', '=', $request->id)->first();
            $rwdiklat = $data->update($datarwdiklat);
        }

        if ($rwdiklat) {
            return response()->json(['text' => 'Riwayat Diklat berhasil ditambahkan/diperbaharui'], 200);
        } else {
            return response()->json(['text' => 'Operasi gagal'], 422);
        }
    }

    public function hapus(Request $request)
    {
        $data = Rwdiklat::where('id', '=', $request->kode)->first();
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
        $data = Rwdiklat::find($request->id);
        $satuanKerja = Satuankerja::find($data['instansi_id']);
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
            $data['namaSatuanKerja'] = ($satuanKerja) ? $satuanKerja->nama : '';
        }
        return response()->json($data, 200);
    }
}
