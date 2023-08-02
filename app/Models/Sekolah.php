<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sekolah extends Model
{
    use HasFactory;

    public $table = 'sekolah';
    public $timestamps = false;
    protected $primaryKey = 'npsn';

    protected $fillable = [
        'npsn',
        'namadapodik',
        'namasekolah',
        'jenjang',
        'wilayah',
        'abk',
        'rombel',
        'asn',
        'nonASN',
        'siswa',
        'catatan',
    ];

    public static function show() {

        $data = DB::table('sekolah')
                ->select(
                    '*'
                )
                ->orderBy('wilayah');
        return $data;
    }
}
