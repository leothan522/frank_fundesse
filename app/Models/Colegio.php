<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Rep98\Venezuela\Models\Municipality;
use Rep98\Venezuela\Models\Parish;
use Rep98\Venezuela\Models\State;

class Colegio extends Model
{
    use SoftDeletes;

    protected $table = 'colegios';

    protected $fillable = [
        'codigo',
        'nombre',
        'direccion',
        'states_id',
        'municipalities_id',
        'parishes_id',
        'google_earth',
        'representante_nombre',
        'representante_telefono',
        'representante_sexo',
        'fecha_fundacion',
        'telefono_local',
    ];

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

    public function usuarios(): HasMany
    {
        return $this->hasMany(User::class, 'colegios_id', 'id');
    }

    public function estudiantes(): HasMany
    {
        return $this->hasMany(Estudiante::class, 'colegios_id', 'id');
    }

}
