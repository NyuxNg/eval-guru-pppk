<?php

namespace App\Models;

use App\Http\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Unor extends Model
{
    use HasFactory;
    use UsesUuid;

    public $timestamps = false;
    protected $fillable = [
        'namaUnor',
        'namaJabatan',
        'unorAtasan_id',
        'unorInduk_id',
        'is_unorInduk',
        'keterangan',
        'is_aktif',
        'jenisUnor_id',
        'eselon_id',
    ];

    public static function join()
    {
        $data = DB::table('unors as unor')
            ->leftJoin('unors as unorInduk', 'unor.unorInduk_id', '=', 'unorInduk.id')
            ->leftJoin('unors as unorAtasan', 'unor.unorAtasan_id', '=', 'unorAtasan.id')
            ->leftJoin('jenisunors', 'jenisunors.id', '=', 'unor.jenisUnor_id')
            ->leftJoin('eselon', 'eselon.id', '=', 'unor.eselon_id')
            ->leftjoin('kategorijabatans', 'kategorijabatans.id', '=', 'jenisunors.idKategoriJabatan')
            ->select(
                'unor.*',
                'jenisunors.nama as jenisUnor',
                'kategorijabatans.kode as kodeKategori', 'kategorijabatans.kategori as kategori', 'kategorijabatans.jenis as jenisJabatan',
                'eselon.kode as kodeEselon', 'eselon.nama as eselon',
                'unorInduk.id as unorInduk_Id','unorInduk.namaUnor as namaUnorInduk', 'unorInduk.namaJabatan as namaJabatanUnorInduk',
                'unorAtasan.namaUnor as namaUnorAtasan', 'unorAtasan.namaJabatan as namaJabatanUnorAtasan',
            );
        return $data;
    }

}
