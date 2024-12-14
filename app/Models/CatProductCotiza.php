<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CatProductCotiza extends Model
{
    use HasFactory;

    protected $fillable = [
        'por_aval',
        'por_vc',
        'precio_min',
        'precio_max',
        'cat_product_sub_id',
    ];

    /**
     * Get the SubProducto that owns the CatProductCotiza
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function SubProducto(): BelongsTo
    {
        return $this->belongsTo(CatProductSub::class, 'cat_product_sub_id', 'id');
    }
}
