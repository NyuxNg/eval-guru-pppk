<?php

namespace App\Models;

use App\Http\Traits\UsesUuid;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Presensi extends Model
{
    use HasFactory;
    use UsesUuid;

    public $timestamps = false;
    public $table = 'presensi';

    protected $fillable = [
        'idTHL',
        'nama',
        'perangkatDaerah',
        'presensiJuli',
        'presensiAgustus',
        'presensiSeptember',
        'presensiOktober',
        'presensiNovember',
        'presensiDesember',
        'presensiGrandTotal',
        'status',
        'idPerangkatDaerah',
    ];

    public static function join()
    {
        $data = DB::table('presensi')
            ->select(
                'presensi.*',
            );
        return $data;
    }
}
