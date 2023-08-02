<?php

namespace App\Models;

use App\Http\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Jenisunor extends Model
{
    use HasFactory;
    use UsesUuid;

    public $timestamps = false;

    protected $fillable = [
        'id',
        'nama',
        'bup',
        'idKategoriJabatan',
    ];

    public static function join()
    {
        $data = DB::table('jenisunors')
            ->leftjoin('kategorijabatans', 'kategorijabatans.id', '=', 'jenisunors.idKategoriJabatan')
            ->select(
                'jenisunors.*',
                'kategorijabatans.kode as kodeKategori', 'kategorijabatans.kategori as kategori', 'kategorijabatans.jenis as jenis'
            );
        return $data;
    }
}
