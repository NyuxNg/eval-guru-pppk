<?php

namespace App\Models;

use App\Http\Traits\UsesUuid;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rwhukdisiplin extends Model
{
    use HasFactory;
    use UsesUuid;

    public $timestamps = false;
    protected $fillable = [
        'skNomor',
        'skTanggal',
        'tglMulai',
        'tglAkhir',
        'masaTahun',
        'masaBulan',
        'ppNomor',
        'skPembatalan',
        'tglSkbatal',
        'idOrang',
        'idHukdis',
        'idGolongan',
    ];

    public static function join()
    {
        $data = DB::table('rwhukdisiplins')
            ->join('pegawaipns', 'pegawaipns.pns_id', '=', 'rwhukdisiplins.idOrang')
            ->join('golongans', 'golongans.id', '=', 'rwhukdisiplins.idGolongan')
            ->join('jenishukuman', 'jenishukuman.id', '=', 'rwhukdisiplins.idHukdis')
            ->join('tingkathukdis', 'tingkathukdis.id', '=', 'jenishukuman.tingkat')
            ->select(
                'rwhukdisiplins.*',
                'pegawaipns.nip_baru', 'pegawaipns.nama', 'pegawaipns.gelar_depan', 'pegawaipns.gelar_blk',
                'golongans.golPNS', 'golongans.pangkatPNS', 'golongans.kode',
                'jenishukuman.nama as jenisHukuman',
                'tingkathukdis.nama as tingkatHukuman'
            );
        return $data;
    }
}
