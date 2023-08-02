<?php

namespace App\Models;

use App\Http\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategorijabatan extends Model
{
    use HasFactory;
    use UsesUuid;
    public $timestamps = false;
    protected $fillable = [
        'kode',
        'kategori',
        'jenis',
        'pangkatDasar',
        'pangkatPuncak',
        'tktPendidikan',
        'keterangan',
    ];
}
