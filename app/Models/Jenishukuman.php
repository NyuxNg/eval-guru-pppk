<?php

namespace App\Models;

use App\Http\Traits\UsesUuid;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Jenishukuman extends Model
{
    use UsesUuid;
    use HasFactory;

    public $timestamps = false;
    public $table = 'jenishukuman';
    protected $fillable = [
        'kode',
        'nama',
        'keterangan',
        'tingkat',
    ];

    public static function join()
    {
        $data = DB::table('jenishukuman')
            ->join('tingkathukdis', 'tingkathukdis.id', '=', 'jenishukuman.tingkat')
            ->select(
                'jenishukuman.*',
                'tingkathukdis.nama as tkthukdis', 'tingkathukdis.kode as kode_tkt'
            );
        return $data;
    }

}
