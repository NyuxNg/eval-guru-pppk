<?php

namespace App\Models;

use App\Http\Traits\UsesUuid;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rwdiklat extends Model
{
    use HasFactory;
    use UsesUuid;

    public $timestamps = false;
    protected $fillable = [
        'id',
        'diklat_nama',
        'nomor_sertipikat',
        'tanggal_sertipikat',
        'bobot_kompetensi',
        'jenis_kompetensi',
        'institusi_penyelenggara',
        'jumlah_jam',
        'durasi_hari',
        'tanggal_mulai',
        'tanggal_selesai',
        'tahun',
        'jenis_kursus_id',
        'path',
        'tipe',
        'id_riwayat_update',
        'jenis_kursus_sertipikat',
        'idOrang',
        'jenis_diklat_id',
        'latihan_struktural_id',
        'instansi_id',
    ];

    public static function join()
    {
        $data = DB::table('rwdiklats')
                ->join('pegawaipns', 'pegawaipns.pns_id', '=', 'rwdiklats.idOrang')
                ->leftjoin('jenisdiklat', 'jenisdiklat.id', '=', 'rwdiklats.jenis_diklat_id')
                ->leftjoin('diklatstruktural', 'diklatstruktural.id', '=', 'rwdiklats.latihan_struktural_id')
                ->leftjoin('satuankerja', 'satuankerja.id', '=', 'rwdiklats.instansi_id')
                ->select(
                    'rwdiklats.*',
                    'pegawaipns.nip_baru', 'pegawaipns.nama', 'pegawaipns.gelar_depan', 'pegawaipns.gelar_blk',
                    'jenisdiklat.id_siasn as kodejenisdiklat', 'jenisdiklat.jenisdiklat',
                    'diklatstruktural.id_siasn as kodediklatstruktural', 'diklatstruktural.diklatstruktural',
                    'satuankerja.nama as namaSatker', 'satuankerja.instansi'
                );
        return $data;
    }
}
