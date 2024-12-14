<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ComparedCatalogs extends Model
{
    protected $fillable = [
        'catalog',
        'catalog_id',
        'diference',
        'register_sucur_id',
        'register_siemp_id',
        'fixed',
    ];
}
