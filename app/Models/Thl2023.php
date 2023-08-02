<?php

namespace App\Models;

use App\Http\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Thl2023 extends Model
{
    use HasFactory;
    use UsesUuid;

    public $timestamps = false;
    public $table = 'thl2023';

    protected $fillable = [
        'nomorUrut',
        'nik',
        'idPresensi',
        'namaLengkap',
        'lahirTempat',
        'lahirTanggal',
        'jenisKelamin',
        'pendidikanJurusan',
        'pendidikanLulus',
        'jabatan',
        'uraianTugas',
        'honor',
        'masukTahun',
        'masakerjaTahun',
        'masakerjaBulan',
        'keterangan',
        'status',
        'idPerangkatDaerah',
        'uptkelurahan'
    ];

    public static function join()
    {
        $data = DB::table('thl2023')
            ->join('perangkatdaerah','perangkatdaerah.id', '=', 'thl2023.idPerangkatDaerah')
            ->select(
                'thl2023.*',
                'perangkatdaerah.nama as namaUnitkerja'
            );
        return $data;
    }
}
