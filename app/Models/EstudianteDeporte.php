<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EstudianteDeporte extends Model
{
    protected $table = 'estudiantes_deportes';
    protected $fillable = ['estudiantes_id', 'deportes_id'];

    public function estudiante(): BelongsTo
    {
        return $this->belongsTo(Estudiante::class, 'estudiantes_id', 'id');
    }

    public function deporte(): BelongsTo
    {
        return $this->belongsTo(Deporte::class, 'estudiantes_id', 'id');
    }
}
