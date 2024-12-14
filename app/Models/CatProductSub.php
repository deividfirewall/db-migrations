<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CatProductSub extends Model
{

    use HasFactory;

    protected $fillable = [
        'subproducto',
        'cat_producto_id'
    ];

    /**
     * Get the Producto that owns the CatProductSub
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function Producto(): BelongsTo
    {
        return $this->belongsTo(CatProducto::class, 'cat_producto_id', 'id');
    }
}
