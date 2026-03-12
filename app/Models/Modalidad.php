<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Modalidad extends Model
{
    use SoftDeletes;
    protected $table = 'deportes_modalidades';
    protected $fillable = [
        'deportes_id',
        'nombre',
        'descripcion',
        'edad_minima',
        'edad_maxima',
        'genero',
        'tipo_participacion',
        'min_participantes',
        'max_participantes',
        'is_active',
    ];

    public function deporte(): BelongsTo
    {
        return $this->belongsTo(Deporte::class, 'deportes_id', 'id');
    }

}
