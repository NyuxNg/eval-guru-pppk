<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Ekin extends Model
{
    use HasFactory;

    protected $fillable = [
        // 'act',
        // 'id',
        // 'bulan',
        // 'tahun',
        'tglRealisasi',
        'fkKegiatanTahunan',
        'uraianKegiatan',
        'kualitas',
        'waktu',
    ];

    public static function join()
    {
        $data = DB::table('ekins')
            ->leftjoin('kegiatantahunans', 'kegiatantahunans.idKegiatantahunan','=','ekins.fkKegiatanTahunan')
            ->select(
                'ekins.*',
                'kegiatantahunans.kegiatanTahunan as kegiatanTahunan'
            );
        return $data;
    }
}
