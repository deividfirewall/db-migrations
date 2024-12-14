<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CatProducto extends Model
{
    use HasFactory;

    protected $fillable = [
        'producto',
        'cat_product_tipo_id',
    ];


    /**
     * Get the ProductoTipo that owns the CatProducto
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ProductoTipo(): BelongsTo
    {
        return $this->belongsTo(CatProductTipo::class, 'cat_product_tipo_id', 'id');
    }
}
