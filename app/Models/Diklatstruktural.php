<?php

namespace App\Models;

use App\Http\Traits\UsesUuid;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Diklatstruktural extends Model
{
    use HasFactory;
    use UsesUuid;

    public $timestamps = false;
    public $table = 'diklatstruktural';

    protected $fillable = [
        'id_siasn',
        'diklatstruktural'
    ];

    public static function join()
    {
        $data = DB::table('diklatstruktural')
                ->select('diklatstruktural.*');
        return $data;
    }
}
