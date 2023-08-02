<?php

namespace App\Models;

use App\Http\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Golongan extends Model
{
    use HasFactory;
    use UsesUuid;
    public $timestamps = false;
    protected $fillable = [
        'kode',
        'golongan',
        'ruang',
        'golPNS',
        'golPPPK',
        'pangkatPNS',
    ];
}

