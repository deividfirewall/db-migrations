<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TEmpenioMetal extends Model
{
    use HasFactory;
    protected $fillable = [
        'descripcion',
        'peso',
        'pesoTotal',
        't_empenio_id',
        'cat_metal_cotiza_id',
    ];
}
