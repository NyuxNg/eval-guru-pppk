<?php

namespace App\Models;

use App\Http\Traits\UsesUuid;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Eselon extends Model
{
    use HasFactory;
    use UsesUuid;

    public $timestamps = false;
    public $table = 'eselon';

    protected $fillable = [
        'kode',
        'nama',
        'keterangan',
        'idKategoriJabatan',
    ];

    public static function join()
    {
        $data = DB::table('eselon')
        ->leftjoin('kategorijabatans', 'kategorijabatans.id', '=', 'eselon.idKategoriJabatan')
        ->select(
            'eselon.*',
            'kategorijabatans.kode as kodeKategori', 'kategorijabatans.kategori as kategori', 'kategorijabatans.jenis as jenis'
        );
    return $data;
    }

}
