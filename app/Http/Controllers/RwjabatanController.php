<?php

namespace App\Http\Controllers;

use App\Models\Unor;
use App\Models\Eselon;
use App\Models\Jabatan;
use App\Models\Rwjabatan;
use App\Models\Pegawaipns;
use Illuminate\Http\Request;
use App\Models\Kategorijabatan;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\PegawaipnsController;
use App\Models\Satuankerja;

class RwjabatanController extends Controller
{
    public function index()
    {
        $kategoriJabatan = Kategorijabatan::orderBy('kode', 'asc')->get();
        $eselon = Eselon::orderBy('kode', 'asc')->get();
        return view('owner.rwjabatan', compact('kategoriJabatan', 'eselon'));
    }

    public function datariwayat(Request $request)
    {
        $data = Rwjabatan::join()->orderBy('nip_baru', 'asc')->orderByDesc('tmtJabatan');
        $data = ($request->nip_baru) ? $data->where('nip_baru', '=', $request->nip_baru) : $data;
        $data = ($request->nama) ? $data->where('pegawaipns.nama', 'like', '%' .$request->nama. '%') : $data;

        $data = ($request->id) ? $data->where('idJabatan', '=', $request->id) : $data;

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
                ->addColumn('jabatan', function($data){
                    return $this->getjabatan($data->idJabatan);
                })
                ->addColumn('aksi', function ($data) {
                    $button = '<button id="'.$data->id.
                    '" name= "edit" class="edit-jab btn btn-warning" >Edit</button>';
                    $button.= ' <button id="'.$data->id.
                    '" name="hapus" class="hapus-jab btn btn-danger">Hapus</button>';
                    return $button;
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }
    }

    public function store(Request $request)
    {
        $rules = [
            'unitKerjaText' => 'required',
            'tmtJabatan' => 'required',
            'idOrang' => 'required',
        ];

        $text = [
            'unitKerjaText.required' => 'unitKerjaText harap dilengkapi.',
            'tmtJabatan.required' => 'tmtJabatan harap dilengkapi.',
            'idOrang.required' => 'idOrang harap dilengkapi.',
        ];

        $validasi = Validator::make($request->all(), $rules, $text);
        if ($validasi->fails()) {
            return response()->json(['success' => 0, 'text' => $validasi->errors()->first()], 422);
        }

        $datarwjabatan = [
            // 'id' => $request->id,
            'idOrang' => $request->idOrang,
            'idUnor' => $request->idUnor,
            'unitKerjaText' => $request->unitKerjaText,
            'idKategoriJabatan' => $request->idKategoriJabatan,
            'idJabatan' => $request->idJabatan,
            'idEselon' => $request->idEselon,
            'tmtJabatan' => $request->tmtJabatan,
            'skNomor' => $request->skNomor,
            'skTanggal' => $request->skTanggal,
            'idSatuanKerja' => ($request->idSatuanKerja) ? $request->idSatuanKerja: "A5EB03E242A8F6A0E040640A040252AD",
            'tmtPelantikan' => $request->tmtPelantikan,
        ];

        if ($request->mode == 'save') {
            $rwjabatan = Rwjabatan::create($datarwjabatan);
        } else {
            $data = Rwjabatan::all()->where('id', '=', $request->id)->first();
            $rwjabatan = $data->update($datarwjabatan);
        }

        if ($rwjabatan) {
            return response()->json(['text' => 'Riwayat jabatan ditambahkan/diperbaharui'], 200);
        } else {
            return response()->json(['text' => 'Operasi gagal'], 422);
        }
    }

    public function hapus(Request $request)
    {
        $data = Rwjabatan::where('id', '=', $request->kode)->first();
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

    static function getjabatan($id = '')
    {
        $jabatan = Jabatan::find($id);
        $unor = Unor::find($id);
        if($jabatan) {
            $jab = $jabatan->nama;
        } elseif ($unor) {
            $jab = $unor->namaJabatan;
        } else {
            $jab = "-";
        }

        return $jab;
    }
    public function edit(Request $request)
    {
        $data = Rwjabatan::find($request->id);
        $satuanKerja = Satuankerja::find($data['idSatuanKerja']);
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
            $data['namaJabatan'] = $this->getjabatan($data['idJabatan']);
            $data['namaSatuanKerja'] = $satuanKerja->nama;
        }
        return response()->json($data, 200);
    }

}
