<?php

namespace App\Models;

use App\Http\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statuskedudukan extends Model
{
    use UsesUuid;
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'kode',
        'nama',
        'keterangan',
    ];
}
