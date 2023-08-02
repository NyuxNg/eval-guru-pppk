<?php

namespace App\Models;

use App\Http\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Thl2022 extends Model
{
    use HasFactory;
    use UsesUuid;

    public $timestamps = false;
    public $table = 'thl2022';

    protected $fillable = [
        'nomor_urut',
        'nama',
        'pendidikan',
        'jabatan',
        'sumberHonor',
        'status',
        'set_idabsensi',
        'set_nik',
        'keterangan',
        'idPerangkatDaerah',
    ];

    public static function join()
    {
        $data = DB::table('thl2022')
            ->join('perangkatdaerah', 'perangkatdaerah.id','=','thl2022.idPerangkatDaerah')
            ->select(
                'thl2022.*',
                'perangkatdaerah.nama as namaUnitkerja'
            );
        return $data;
    }
}
