<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EstudianteFisico extends Model
{
    protected $table = 'estudiantes_datos_fisicos';

    protected $fillable = [
        'estudiantes_id',
        'peso',
        'altura',
        'fecha',
    ];

    public function estudiante(): BelongsTo
    {
        return $this->belongsTo(Estudiante::class, 'estudiantes_id', 'id');
    }
}
