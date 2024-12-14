<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TEmpBolRelation extends Model
{
    use HasFactory;
    protected $fillable = [
        't_empenio_id',
        't_boleta_id',
    ];
}
