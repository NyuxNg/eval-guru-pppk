<?php

namespace App\Models;

use App\Http\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tkt_Pendidikan extends Model
{
    use UsesUuid;
    use HasFactory;
    public $timestamps = false;
    public $table = 'tkt_pendidikans';
    protected $fillable = [
        'kode',
        'nama',
        'golAwal',
        'golAkhir',
    ];


}
