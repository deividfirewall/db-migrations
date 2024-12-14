<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;

class TBoleta extends Model
{
    use HasFactory;

    /**
     * Get the user that owns the TBoleta
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class); //, 'foreign_key', 'other_key'
    }

    /**
     * Get the pignorante that owns the TBoleta
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pignorante(): BelongsTo
    {
        return $this->belongsTo(Pignorante::class, 'pignorante_id', 'id');
    }
    public function pagos(): HasMany
    {
        return $this->hasMany(TBoletaPago::class);  //, 'boleta_id', 'id'
    }
    
    //  Obten el empeño de la Relacion de Empeños
    public function empenio(): HasManyThrough
    {
        return $this->hasManyThrough(
            TEmpenio::class, 
            TEmpBolRelation::class, 
            't_boleta_id',  // Foreign key on the t_emp_bol_relations table...
            'id',           // Foreign key on the t_empenios table...
            'id',           // Local key on the t_boletas table...
            't_empenio_id'  // Local key on the t_emp_bol_relations table...
        );
    }
    public function ctrlInterno(): HasOne
    {
        return $this->hasOne(TCtrlInterno::class); //, 't_boleta_id', 'id'
    }

    public function pignoranteSolidario(): HasOne
    {
        return $this->hasOne(PignoranteSolidario::class); //, 't_boleta_id', 'id'
    }

    // //  Obten los metales de la Relacion de Empeños
    // public function metales(): HasManyThrough
    // {
    //     return $this->hasManyThrough(
    //         TEmpenioMetal::class, 
    //         TEmpBolRelation::class, 
    //         't_boleta_id',  // Foreign key on the t_emp_bol_relations table...
    //         't_empenio_id', // Foreign key on the t_empenio_metals table...
    //         'id',           // Local key on the t_boletas table...
    //         't_empenio_id'  // Local key on the t_emp_bol_relations table...
    //     );
    // }
    // //  Obten los productos varios de la Relacion de Empeños
    // public function productos(): HasManyThrough
    // {
    //     return $this->hasManyThrough(
    //         TEmpenioProduct::class, 
    //         TEmpBolRelation::class, 
    //         't_boleta_id',  // Foreign key on the t_emp_bol_relations table...
    //         't_empenio_id', // Foreign key on the t_empenio_products table...
    //         'id',           // Local key on the t_boletas table...
    //         't_empenio_id'  // Local key on the t_emp_bol_relations table...
    //     );
    // }
}
