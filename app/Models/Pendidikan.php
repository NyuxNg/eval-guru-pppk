<?php

namespace App\Models;

use App\Http\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Pendidikan extends Model
{
    use HasFactory;
    use UsesUuid;

    public $timestamps = false;
    protected $fillable = [
        'nama',
        'tktPendidikan',
    ];

    public static function join()
    {
        $data = DB::table('pendidikans')
            ->join('tkt_pendidikans','tkt_pendidikans.kode','=','pendidikans.tktPendidikan' )
            ->select(
                'pendidikans.*',
                'tkt_pendidikans.kode as kodeTKT'
            );

        return $data;
    }
}
