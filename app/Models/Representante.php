<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

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
        'estado',
        'municipio',
        'parroquia',
        'direccion',
    ];

    public function hijos(): HasMany
    {
        return $this->hasMany(Estudiante::class, 'representantes_id', 'id');
    }
}
