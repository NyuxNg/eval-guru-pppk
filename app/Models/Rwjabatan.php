<?php

namespace App\Models;

use App\Http\Traits\UsesUuid;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Rwjabatan extends Model
{
    use HasFactory;
    use UsesUuid;

    public $timestamps = false;
    protected $fillable = [
        'id',
        'idOrang',
        'idUnor',
        'unitKerjaText',
        'idKategoriJabatan',
        'idJabatan',
        'idEselon',
        'tmtJabatan',
        'skNomor',
        'skTanggal',
        'idSatuanKerja',
        'tmtPelantikan',
    ];

    public static function join()
    {
        $data = DB::table('rwjabatans')
            ->join('pegawaipns', 'pegawaipns.pns_id', '=', 'rwjabatans.idOrang')
            ->leftjoin('unors', 'unors.id', '=', 'rwjabatans.idUnor')
            ->leftjoin('kategorijabatans', 'kategorijabatans.id', '=', 'rwjabatans.idKategoriJabatan')
            ->leftjoin('jabatans', 'jabatans.id', '=', 'rwjabatans.idJabatan')
            ->leftjoin('eselon', 'eselon.id', '=', 'rwjabatans.idEselon')
            ->leftJoin('satuankerja', 'satuankerja.id', '=', 'rwjabatans.idSatuanKerja')
            ->select(
                'rwjabatans.*',
                'pegawaipns.nip_baru', 'pegawaipns.nama', 'pegawaipns.gelar_depan', 'pegawaipns.gelar_blk',
                'unors.namaUnor', 'unors.is_aktif',
                'kategorijabatans.kategori', 'kategorijabatans.jenis',
                'jabatans.nama as jabatan', 'jabatans.jenisTenaga', 'jabatans.bup',
                'eselon.kode', 'eselon.nama as eselon',
                'satuankerja.nama as namaSatker', 'satuankerja.instansi'
            );
        return $data;
    }
}
