<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PignoranteSolidario extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'contacto',
        'parentesco',
        'fecha_registro',
        't_boleta_id',
        'pignorante_id',
    ];
}
