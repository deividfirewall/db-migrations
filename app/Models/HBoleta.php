<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HBoleta extends Model
{
    use HasFactory;

    protected $fillable = [
        't_boleta_id',
        'prestamo',
        'avaluo',
        'interes',
        'recargo',
        'abono',
        'fecha_movimiento',
        'fecha_vencimiento',
        'cat_status_empenio_id',
        'cat_operacion_tipo_id',
        'pignorante_id',
        'user_id',
        'tipo_empenio',
        'modificado',
        'interes_vencido',
        'comision_almacenaje',
        'comision_avaluo',
        'comision_almoneda',
        'compuesto',
        'ban_modificar',
        'ban_cancelar',
        'ban_retroceso',
        'ban_almoneda',
        'status_alternativo',
    ];


}
