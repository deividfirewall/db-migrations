<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TCaja extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'fecha',
        'caja',
        'abono_caja',
        'empenios',
        'refrendos',
        'abonos',
        'desempenios',
        'duplicado',
        'venta_subasta',
        'venta_vitrina',
        'consolidados',
        't_boleta_id',
        'total_egresos',
        'total'
    ];


    /**
     * Get the user that owns the TCaja
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
