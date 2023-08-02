<?php

namespace App\Models;

use App\Http\Traits\UsesUuid;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rwgolongan extends Model
{
    use UsesUuid;
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'skNomor',
        'skTanggal',
        'pertekNomor',
        'pertekTanggal',
        'tmt',
        'akUtama',
        'akTambahan',
        'mkGolTahun',
        'mkGolBulan',
        'idOrang',
        'idJeniskp',
        'idGolongan',
    ];

    public static function join()
    {
        $data = DB::table('rwgolongans')
            ->join('pegawaipns', 'pegawaipns.pns_id', '=', 'rwgolongans.idOrang')
            ->join('golongans', 'golongans.id', '=', 'rwgolongans.idGolongan')
            ->join('jeniskps', 'jeniskps.id', '=', 'rwgolongans.idJeniskp')
            ->select(
                'rwgolongans.*',
                'pegawaipns.nip_baru', 'pegawaipns.nama', 'pegawaipns.gelar_depan', 'pegawaipns.gelar_blk',
                'golongans.golPNS', 'golongans.pangkatPNS', 'golongans.kode',
                'jeniskps.nama as jenisKP'
            );
        return $data;
    }
}
