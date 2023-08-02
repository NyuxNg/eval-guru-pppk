<?php

namespace App\Models;

use App\Http\Traits\UsesUuid;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pegawaipns extends Model
{
    use UsesUuid;
    use HasFactory;
    public $table = 'pegawaipns';
    protected $primaryKey = 'pns_id';
    public $timestamps = false;
    protected $fillable = [
        'pns_id',
        'nip_baru',
        'nip_lama',
        'nama',
        'gelar_depan',
        'gelar_blk',
        'tempat_lahir_nama',
        'tgl_lahir',
        'jenis_kelamin',
        'nik',
        'nomor_hp',
        'email',
        'alamat',
        'npwp_nomor',
        'bpjs',
        'kartu_pegawai',
        'agama_id',
        'status_nikah_id',
        'jenis_pegawai_id',
    ];

    public static function showRiwayat()
    {
        $riwayatJabatan = DB::table('rwjabatans')
            ->leftjoin('jabatans', 'jabatans.id', '=', 'rwjabatans.idJabatan')
            ->select('idOrang',DB::raw('MAX(tmtJabatan) as max_tmtJabatan'))
            ->groupBy('idOrang');

        $riwayatGol = DB::table('rwgolongans')
            ->join('golongans', 'golongans.id', '=', 'rwgolongans.idGolongan')
            ->select('idOrang as idOrang1',DB::raw('MAX(golongans.kode) as kodeakhir'))
            ->groupBy('idOrang');

        $riwayatPendidikan = DB::table('rwpendidikans')
            ->join('pendidikans', 'pendidikans.id', '=', 'rwpendidikans.idPendidikan')
            ->select('idOrang as idOrang2',DB::raw('MAX(pendidikans.tktPendidikan) as tktAkhir'))
            ->groupBy('idOrang');

        $data = DB::table('pegawaipns')
            ->joinSub($riwayatJabatan, 'jabatanakhir', function($join){
                $join->on('pegawaipns.pns_id','=','jabatanakhir.idOrang');
            })
            ->joinSub($riwayatGol, 'golakhir', function($join){
                $join->on('pegawaipns.pns_id','=','golakhir.idOrang1');
            })
            ->joinSub($riwayatPendidikan, 'pendAkhir', function($join){
                $join->on('pegawaipns.pns_id','=','pendAkhir.idOrang2');
            });

        return $data;

    }

}
