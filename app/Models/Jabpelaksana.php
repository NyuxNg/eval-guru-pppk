<?php

namespace App\Models;

use App\Http\Traits\UsesUuid;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Jabpelaksana extends Model
{
    use UsesUuid;
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'nama',
        'aturan',
        'jenisTenaga',
        'bup'
    ];

    public static function join()
    {
        $data = DB::table('jabpelaksanas')
            ->select(
                'jabpelaksanas.*'
            );
        return $data;
    }
}
