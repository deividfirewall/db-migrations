<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdmSede extends Model
{
    use HasFactory;
    protected $fillable = [
        'serie',
        'clave',
        'sucursal',
        'region',
        'tipo_prenda',
        'monto_max_concentrado',
        'fondo_renvolvente',
        'subastas',
        'monto_demasiaCheque',
        'telefono',
        'direccion',
        'cp',
        'Activa',
        'tenant_id'
    ];
}
