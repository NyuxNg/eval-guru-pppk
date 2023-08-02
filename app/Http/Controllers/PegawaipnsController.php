<?php

namespace App\Http\Controllers;

use App\Models\Unor;
use App\Models\Agama;
use App\Models\Eselon;
use App\Models\Jeniskp;
use App\Models\Golongan;
use App\Models\Rwjabatan;
use App\Models\Pegawaipns;
use App\Models\Jenisdiklat;
use App\Models\Statusnikah;
use App\Models\Jenishukuman;
use App\Models\Jenispegawai;
use App\Models\Rwpendidikan;
use Illuminate\Http\Request;
use App\Models\Tingkathukdis;
use App\Models\Tkt_Pendidikan;
use App\Models\Kategorijabatan;
use App\Models\Diklatstruktural;
use Illuminate\Support\Facades\Validator;


class PegawaipnsController extends Controller
{
    static function namaLengkap($depan, $nama, $belakang)
    {
        $lengkap = ($depan == null) ? $nama : trim($depan).'. '.$nama;
        $lengkap = ($belakang == null) ? $lengkap : $lengkap.', '.trim($belakang);
        return $lengkap;
    }

    public function index()
    {
        $agama = Agama::orderBy('kode','asc')->get();
        $statusnikah = Statusnikah::orderBy('kode','asc')->get();
        $jenispegawai = Jenispegawai::orderBy('kode','asc')->get();
        $golongan = Golongan::orderBy('kode','asc')->get();

        return view('owner.pegawaipns',compact('agama', 'statusnikah', 'jenispegawai', 'golongan'));
    }

    public function datariwayat(Request $request)
    {
        ini_set('max_execution_time', 500);
        ini_set('memory_limit', '512M');
        $data = Pegawaipns::showRiwayat();
        $data = ($request->nip_baru) ? $data->where('nip_baru', '=', $request->nip_baru) : $data;
        $data = ($request->carinama) ? $data->where('pegawaipns.nama', 'like', '%' .$request->carinama. '%') : $data;
        $data = ($request->cari_idJeniskp) ? $data->where('pegawaipns.jenis_pegawai_id', 'like', '%' .$request->cari_idJeniskp. '%') : $data;
        $data = ($request->cari_golAwal != '') ? $data->whereBetween('kodeakhir',[$request->cari_golAwal, $request->cari_golAkhir]) : $data;
        $data = ($request->jumlahView != 'All') ? $data->take($request->jumlahView) : $data;
        $data = $data->get();
        // $asnPPPK = 1;
        if (request()->ajax()) {
            return datatables()
             ->of($data)
                ->addColumn('nip_baru', function($data){
                    $url = "dist/img/foto".'/'. $data->nip_baru. '.jpg';
                    $photourl = file_exists($url) ? $url : url("dist/img/avatar2.png");
                    $photo = '<div class="text-center">'.
                             '<img class="profile-user-img img-fluid" src="'. $photourl. '" alt="User profile picture"></div>';
                    $pns_id = '<a target="_blank" class="btn btn-block btn-info" href="'.route('profilePegawai',['pns_id' => $data->pns_id]).'" title="Lihat Profile">'.$data->nip_baru.'</a>';
                    return $photo .= $pns_id;
                })
                ->addColumn('nama', function($data){
                    return $this->namaLengkap($data->gelar_depan, $data->nama, $data->gelar_blk);
                })
                ->addColumn('jenis_pegawai_id', function($data){
                    return $this->getjenispegawai($data->jenis_pegawai_id);
                })
                ->addColumn('kodeakhir', function($data){
                    return $this->getgolongan($data);
                })
                ->addColumn('tktAkhir', function($data){
                    $datatkt = Tkt_Pendidikan::where('kode','=',$data->tktAkhir)->get();
                    $tkt = ($datatkt->isNotEmpty()) ? $datatkt[0]->kode.' - '.$datatkt[0]->nama : "??";
                    return $tkt;
                })
                ->addColumn('jurusan', function($data){
                    return $this->getpendidikan($data);
                })
                ->addColumn('jabatan', function($data){
                    return $this->getjabatan($data);
                })
                ->addColumn('unitKerja', function($data){
                    return $this->getunitkerja($data);
                })
                ->addColumn('aksi', function ($data) {
                    $button = '<button id="'.$data->pns_id.
                    '" name= "edit" class="edit btn btn-warning" >Edit</button>';
                    $button.= ' <button id="'.$data->nip_baru.
                    '" name="hapus" class="hapus btn btn-danger">Hapus</button>';
                    return $button;
                })
                ->rawColumns(['nip_baru','aksi'])
                ->make(true);
        }
    }

    public function store(Request $request)
    {
        $rules = [
            'nip_baru' => 'required|min:18|max:18',
            'nama' => 'required',
            'tempat_lahir_nama' => 'required',
            'tgl_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'nik' => 'required',
            'nomor_hp' => 'required',
            'email' => 'required',
            'alamat' => 'required',
            // 'npwp_nomor' => 'required',
            // 'bpjs' => 'required',
            'agama_id' => 'required',
            'status_nikah_id' => 'required',
            'jenis_pegawai_id' => 'required',
        ];

        $text =[
            'nip_baru' => 'nip_baru harus diisi sesuai ketentuan',
            'nama' => 'nama harus diisi sesuai ketentuan',
            'tempat_lahir_nama' => 'tempat_lahir_nama harus diisi sesuai ketentuan',
            'tgl_lahir' => 'tgl_lahir harus diisi sesuai ketentuan',
            'jenis_kelamin' => 'jenis_kelamin harus diisi sesuai ketentuan',
            'nik' => 'nik harus diisi sesuai ketentuan',
            'nomor_hp' => 'nomor_hp harus diisi sesuai ketentuan',
            'email' => 'email harus diisi sesuai ketentuan',
            'alamat' => 'alamat harus diisi sesuai ketentuan',
            // 'npwp_nomor' => 'npwp_nomor harus diisi sesuai ketentuan',
            // 'bpjs' => 'bpjs harus diisi sesuai ketentuan',
            'agama_id' => 'agama_id harus diisi sesuai ketentuan',
            'status_nikah_id' => 'status_nikah_id harus diisi sesuai ketentuan',
            'jenis_pegawai_id' => 'jenis_pegawai_id harus diisi sesuai ketentuan',
        ];

        $validasi = Validator::make($request->all(), $rules, $text);
        if ($validasi->fails()) {
            return response()->json(['success' => 0, 'text' => $validasi->errors()->first()], 422);
        }

        $dataPegawaipns = [
            'nip_baru' => $request->nip_baru,
            'nip_lama' => $request->nip_lama,
            'nama' => $request->nama,
            'gelar_depan' => $request->gelar_depan,
            'gelar_blk' => $request->gelar_blk,
            'tempat_lahir_nama' => $request->tempat_lahir_nama,
            'tgl_lahir' => $request->tgl_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'nik' => $request->nik,
            'nomor_hp' => $request->nomor_hp,
            'email' => $request->email,
            'alamat' => $request->alamat,
            'npwp_nomor' => $request->npwp_nomor,
            'bpjs' => $request->bpjs,
            'kartu_pegawai' => $request->kartu_pegawai,
            'agama_id' => $request->agama_id,
            'status_nikah_id' => $request->status_nikah_id,
            'jenis_pegawai_id' => $request->jenis_pegawai_id,
        ];

        if ($request->mode == 'save') {
            $pegawaipns = Pegawaipns::create($dataPegawaipns);
        } else {
            $data = Pegawaipns::all()->where('nip_baru', '=', $request->nip_baru)->first();
            $pegawaipns = $data->update($dataPegawaipns);
        }

        if ($pegawaipns) {
            return response()->json(['text' => 'Pegawai pns ditambahkan/diperbaharui'], 200);
        } else {
            return response()->json(['text' => 'Operasi gagal'], 422);
        }
    }

    public function hapus(Request $request)
    {
        $data = Pegawaipns::where('nip_baru', '=', $request->nip_baru)->first();
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
        // $data = Pegawaipns::find($request->id);
        $data = Pegawaipns::showRiwayat()
                ->where('pns_id', '=', $request->id)
                ->first();
        if($data) {
            $depan = $data->gelar_depan;
            $belakang = $data->gelar_blk;
            $nama = $data->nama;
            $lengkap = $this->namaLengkap(
                $depan,
                $nama,
                $belakang
            );
            $data->namalengkap = $lengkap;

            $data->statusnikah = $this->getstatusnikah($data->status_nikah_id);
            $data->jenispegawai = $this->getjenispegawai($data->jenis_pegawai_id);
            $data->jabatan = $this->getjabatan($data);
            $data->unitkerja = $this->getunitkerja($data);
            $data->pendidikan = $this->getpendidikan($data,0);
            $data->golru = $this->getgolongan($data);

        }
        return response()->json($data, 200);
    }

    //Digunakan untuk Modal saat tambah riwayat PNS --> cari berdasarkan NIP Baru
    public function cariNIPbaru(Request $request)
    {
        $data = Pegawaipns::where('nip_baru', '=', $request->nip_baru)->get();

        if($data) {
            $depan = $data[0]->gelar_depan;
            $belakang = $data[0]->gelar_blk;
            $nama = $data[0]->nama;
            $lengkap = $this->namaLengkap(
                $depan,
                $nama,
                $belakang
            );
            $data[0]->namalengkap = $lengkap;
        }
        return response()->json($data[0], 200);
    }

    static function getstatusnikah(string $id)
    {
        $data = Statusnikah::where('id','=',$id)->get();
        $statusnikah = ($data->isNotEmpty()) ? $data[0]->nama : "??";
        return $statusnikah;
    }

    static function getjenispegawai(string $id)
    {
        $dataJenispegawai = Jenispegawai::where('id','=',$id)->get();
        $jenispegawai = ($dataJenispegawai->isNotEmpty()) ? $dataJenispegawai[0]->nama : "??";
        return $jenispegawai;
    }

    static function getjabatan($data)
    {
        $jabatan = Rwjabatan::where('idOrang','=',$data->pns_id)
                        ->join('jabatans', 'jabatans.id', '=', 'rwjabatans.idJabatan')
                        ->where('rwjabatans.tmtJabatan','=', $data->max_tmtJabatan)
                        ->get();

        $jabStruktural = Rwjabatan::where('idOrang','=',$data->pns_id)
                        ->join('unors', 'unors.id', '=', 'rwjabatans.idJabatan')
                        ->where('rwjabatans.tmtJabatan','=', $data->max_tmtJabatan)
                        ->get();

        if ($jabatan->isNotEmpty()) {
            $jab = $jabatan[0]->nama;
        }
        else if ($jabStruktural->isNotEmpty()) {
            $jab = $jabStruktural[0]->namaJabatan;
        } else {
            $jab = "-";
        }
        return $jab;
    }

    static function getunitkerja($data)
    {
        $idUnor = Rwjabatan::where('idOrang','=',$data->pns_id)
                            ->where('tmtJabatan','=', $data->max_tmtJabatan)
                            ->get();
        $unitKerja = ($idUnor->isNotEmpty()) ? $idUnor[0]->unitKerjaText : "??";
        return $unitKerja;
    }

    static function getpendidikan($data, $cek = 1)
    {
        $pendidikan = Rwpendidikan::where('idOrang','=',$data->pns_id)
                                    ->join('pendidikans', 'pendidikans.id', '=', 'rwpendidikans.idPendidikan')
                                    ->where('pendidikans.tktPendidikan','=', $data->tktAkhir)
                                    ->get();
        // dd($pendidikan);
        $jurusan = ($pendidikan->isNotEmpty()) ? $pendidikan[0]->nama : "??";
        if($cek != 1) {
            $jurusan .= ' ('. $pendidikan[0]->thnLulus .')';
        }
        return $jurusan;
    }

    static function getgolongan($data)
    {
        $datagolongan = Golongan::where('kode','=',$data->kodeakhir)->get();

        //jika jenis Pegawai PPPK maka golongan I s.d. XVII
        if ($data->jenis_pegawai_id <> 'e3b79935-80c1-4d10-b30e-4a615d35bcb5') {
            $golongan = ($datagolongan->isNotEmpty()) ? $datagolongan[0]->pangkatPNS.', '.$datagolongan[0]->golPNS : "??";
        } else {
            $golongan = ($datagolongan->isNotEmpty()) ? $datagolongan[0]->golPPPK : "??";
        }
        return $golongan;
    }

    public function profilePegawai(Request $request)
    {
        $pns_id = $request->pns_id;
        $data = Pegawaipns::showRiwayat()
                ->where('pns_id', '=', $pns_id)
                ->first();
        $agama = Agama::orderBy('kode','asc')->get();
        $statusnikah = Statusnikah::orderBy('kode','asc')->get();
        $jenispegawai = Jenispegawai::orderBy('kode','asc')->get();
        $golongan = Golongan::orderBy('kode','asc')->get();
        $jeniskp = Jeniskp::orderBy('kode','asc')->get();

        $kategoriJabatan = Kategorijabatan::orderBy('kode', 'asc')->get();
        $eselon = Eselon::orderBy('kode', 'asc')->get();

        $tktPendidikan = Tkt_Pendidikan::orderBy('kode', 'asc')->get();

        $jenisdiklat = Jenisdiklat::orderBy('id_siasn', 'asc')->get();
        $diklatstruktural = Diklatstruktural::orderBy('id_siasn', 'asc')->get();

        $tingkatHukdis = Tingkathukdis::orderBy('kode','asc')->get();
        $jenishukuman = Jenishukuman::join()->orderBy('kode_tkt','desc')->get();

        // dd($data);
        return view('owner.profile', compact(
                            'pns_id', 'data',
                            'agama', 'statusnikah', 'jenispegawai', 'golongan', 'jeniskp',
                            'kategoriJabatan','eselon', 'tktPendidikan', 'tingkatHukdis', 'jenishukuman',
                            'jenisdiklat', 'diklatstruktural'
        ));
    }
}
