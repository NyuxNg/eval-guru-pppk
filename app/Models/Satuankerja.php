<?php

namespace App\Models;

use App\Http\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Satuankerja extends Model
{
    use HasFactory;
    use UsesUuid;

    public $timestamps = false;
    public $table = 'satuankerja';

    protected $fillable = [
        'nama',
        'instansi',
        'jenis',
    ];

    public static function join()
    {
        $data = DB::table('satuankerja')
            ->select('satuankerja.*');
        return $data;
    }
}
