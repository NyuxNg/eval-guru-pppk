<?php

namespace App\Models;

use App\Http\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Agama extends Model
{
    use UsesUuid;
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'kode',
        'nama',
    ];
}
