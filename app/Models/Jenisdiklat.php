<?php

namespace App\Models;

use App\Http\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Jenisdiklat extends Model
{
    use HasFactory;
    use UsesUuid;

    public $timestamps = false;
    public $table = 'jenisdiklat';

    protected $fillable = [
        'id_siasn',
        'jenisdiklat'
    ];

    public static function join()
    {
        $data = DB::table('jenisdiklat')
                ->select('jenisdiklat.*');
        return $data;
    }
}
