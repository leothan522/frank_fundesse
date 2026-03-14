<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Rep98\Venezuela\Models\Municipality;
use Rep98\Venezuela\Models\Parish;
use Rep98\Venezuela\Models\State;

class Estudiante extends Model
{
    use SoftDeletes;

    protected $table = 'estudiantes';

    protected $fillable = [
        'colegios_id',
        'nombres',
        'apellidos',
        'full_name',
        'fecha_nacimiento',
        'sexo',
        'cedula',
        'representantes_id',
        'direccion_representante',
        'states_id',
        'municipalities_id',
        'parishes_id',
        'direccion',
    ];

    public function edad(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->fecha_nacimiento
                ? Carbon::parse($this->fecha_nacimiento)->age
                : null
        );
    }

    public function colegio(): BelongsTo
    {
        return $this->belongsTo(Colegio::class, 'colegios_id', 'id');
    }

    public function representante(): BelongsTo
    {
        return $this->belongsTo(Representante::class, 'representantes_id', 'id');
    }

    public function datosFisicos(): HasMany
    {
        return $this->hasMany(EstudianteFisico::class, 'estudiantes_id', 'id');
    }

    public function lastFisico(): HasOne
    {
        return $this->hasOne(EstudianteFisico::class, 'estudiantes_id', 'id')->latestOfMany('fecha');
    }

    public function deportes(): BelongsToMany
    {
        return $this->belongsToMany(
            Deporte::class,           // 1. El modelo con el que se relaciona
            'estudiantes_deportes',   // 2. La tabla pivote real
            'estudiantes_id',         // 3. FK de Estudiante en la pivote
            'deportes_id'             // 4. FK de Deporte en la pivote
        );
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
