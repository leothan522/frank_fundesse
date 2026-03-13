<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Rep98\Venezuela\Models\Municipality;
use Rep98\Venezuela\Models\Parish;
use Rep98\Venezuela\Models\State;

class Representante extends Model
{
    use SoftDeletes;
    protected $table = 'representantes';
    protected $fillable = [
        'cedula',
        'nombre',
        'sexo',
        'telefono',
        'telefono_2',
        'states_id',
        'municipalities_id',
        'parishes_id',
        'direccion',
    ];

    public function hijos(): HasMany
    {
        return $this->hasMany(Estudiante::class, 'representantes_id', 'id');
    }

    public function estado(): BelongsTo
    {
        return $this->belongsTo(State::class, 'states_id', 'id');
    }

    public function municipio(): BelongsTo
    {
        return $this->belongsTo(Municipality::class, 'municipalities_id', 'id');
    }

    public function parroquia(): BelongsTo
    {
        return $this->belongsTo(Parish::class, 'parishes_id', 'id');
    }

}
