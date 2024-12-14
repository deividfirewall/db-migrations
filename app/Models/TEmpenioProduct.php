<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TEmpenioProduct extends Model
{
    use HasFactory;
    protected $fillable = [
            'contenido',
            'descripcion',
            'marca',
            'serie',
            't_empenio_id'
        ];
}
