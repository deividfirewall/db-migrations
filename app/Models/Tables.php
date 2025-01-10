<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tables extends Model
{
    protected $table = 'tables';
    protected $fillable = [
        'tabla_origen',
        'num_registros_origen',
        'tabla_destino',
        'num_registros_destino',
        'avance',
    ];
    public $timestamps = false;
}
