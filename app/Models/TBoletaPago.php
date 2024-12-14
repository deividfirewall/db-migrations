<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TBoletaPago extends Model
{
    use HasFactory;
    protected $fillable = [
        'num_pago',
        'fecha_pago',
        'prestamo',
        'refrendo',
        'capital_mas_interes',
        't_boleta_id',
    ];
}
