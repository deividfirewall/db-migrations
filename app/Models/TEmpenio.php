<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class TEmpenio extends Model
{
    use HasFactory;
    protected $fillable = [
        'valuo',
        'prestamo',
        'maximo',
        'minimo',
        'cat_status_empenio_id',
        'cat_prestamo_tipo_id',
        'pignorante_id',
        'cat_product_sub_id'
    ];


    public function metal(): HasOne
    {
        return $this->hasOne(TEmpenioMetal::class); //, 't_empenio_id', 'id'
    }
    public function producto(): HasOne
    {
        return $this->hasOne(TEmpenioProduct::class); //, 't_empenio_id', 'id'
    }


}
