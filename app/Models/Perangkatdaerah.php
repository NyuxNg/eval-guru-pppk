<?php

namespace App\Models;

use App\Http\Traits\UsesUuid;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Perangkatdaerah extends Model
{
    use UsesUuid;
    use HasFactory;

    public $timestamps = false;
    public $table = 'perangkatdaerah';

    protected $fillable = [
        'id',
        'nama',
        'jabatanPimpinan',
        'thl2022',
        'usulthl2023',
        'keterangan',
    ];

    public static function join()
    {
        $data = DB::table('perangkatdaerah')
            ->select(
                'perangkatdaerah.*',
            );
        return $data;
    }

}
