<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pignorante extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre',
        'ine',
        'rfc',
        'celular',
        'telefono',
        'email',
        'cp',
        'estado_id',
        'municipio_id',
        'direccion',
        'identidad_frente',
        'identidad_reverso',        
    ];
}
