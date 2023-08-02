<?php

namespace App\Models;

use App\Http\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use SebastianBergmann\CodeCoverage\Driver\Selector;

class PPPK extends Model
{
    use HasFactory;
    use UsesUuid;

    public $table = 'pppk';
    public $timestamps = false;
    protected $primaryKey = 'idOrang';

    protected $fillable = [
        'nipBaru',
        'nama',
        'statusPerkawinan',
        'golru',
        'tmtPPPK',
        'pendidikan',
        'jabatanASN',
        'unitKerja',
        'linear',
        'wilayah',
        'kejujuran',
        'tanggungJawab',
        'kehadiran',
        'kesetiaan',
        'etikaPerilaku',
        'admPerencanaan',
        'pelaksanaan',
        'admPenilaian',
        'rekapitulasiPKG',
        'skp',
        'catatanDisiplin',
        'catatanKinerja',
        'rekomendasi',
        'npsn'
    ];

    public static function showData()
    {
        $pppk = DB::table('pppk')
            ->join('sekolah', 'sekolah.npsn', '=', 'pppk.npsn')
            ->select(
                'pppk.*',
                'sekolah.namadapodik', 'sekolah.namasekolah', 'sekolah.wilayah as wilayahSekolah',
                'sekolah.abk', 'sekolah.rombel', 'sekolah.asn', 'sekolah.nonASN', 'sekolah.siswa',
            )
            ->orderBy('nipBaru');

        return $pppk;
    }

    public static function showWilayah()
    {
        $wilayah = DB::table('pppk')
                ->groupBy('wilayah')
                ->orderBy('unitKerja')
                ->select('wilayah', DB::raw('count(*) as total'));
        return $wilayah;
    }

    public static function showLinear($wilayah) {
        $linear = DB::table('pppk')
                  ->groupBy('linear')
                  ->where('wilayah', '=', $wilayah)
                  ->select('linear', DB::raw('count(*) as total'));
        return $linear;
    }

}
