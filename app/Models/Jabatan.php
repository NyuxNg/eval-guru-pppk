<?php

namespace App\Models;

use App\Http\Traits\UsesUuid;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Jabatan extends Model
{
    use UsesUuid;
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'nama',
        'aturan',
        'jenisTenaga',
        'bup',
        'aktif',
        'idKategorijabatan',
    ];

    public static function join()
    {
        $data = DB::table('jabatans')
            ->join('kategorijabatans', 'kategorijabatans.id','=', 'jabatans.idKategorijabatan')
            ->select(
                'jabatans.*',
                'kategorijabatans.kode as kodeKategori', 'kategorijabatans.kategori as kategori', 'kategorijabatans.jenis as jenis'
            );

        return $data;
    }

}
