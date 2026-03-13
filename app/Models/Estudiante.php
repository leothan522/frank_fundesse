<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

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
        'estado',
        'municipio',
        'parroquia',
        'direccion',
    ];

    protected function age()
    {
        return Attribute::make(
            get: fn () => Carbon::parse($this->fecha_nacimiento)->age
        );
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

    public function deportes(): HasMany
    {
        return $this->hasMany(EstudianteDeporte::class, 'estudiantes_id', 'id');
    }

}
