<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TCtrlInterno extends Model
{
    use HasFactory;
    protected $fillable = [
        'letra',
        'numero',
        't_boleta_id',
        'sede_id',
        'fecha',
        'hora',
    ];
}
