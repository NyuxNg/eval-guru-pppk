<?php

namespace App\Models;

use App\Http\Traits\UsesUuid;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rwpendidikan extends Model
{
    use HasFactory;
    use UsesUuid;

    public $timestamps = false;
    protected $fillable = [
        'tglLulus',
        'thnLulus',
        'noIjazah',
        'namaSekolah',
        'lokasi',
        'glrDepan',
        'glrBelakang',
        'pendAwal',
        'idOrang',
        'idPendidikan',
    ];

    public static function join()
    {
        $data = DB::table('rwpendidikans')
            ->join('pegawaipns', 'pegawaipns.pns_id', '=', 'rwpendidikans.idOrang')
            ->join('pendidikans', 'pendidikans.id', '=', 'rwpendidikans.idPendidikan')
            ->select(
                'rwpendidikans.*',
                'pegawaipns.nip_baru', 'pegawaipns.nama', 'pegawaipns.gelar_depan', 'pegawaipns.gelar_blk',
                'pendidikans.nama as namaPendidikan', 'pendidikans.tktPendidikan'
            );
        return $data;
    }
}
