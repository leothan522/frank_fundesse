<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Deporte extends Model
{
    use SoftDeletes;
    protected $table = 'deportes';
    protected $fillable = ['nombre', 'is_active'];

    public function modalidades(): HasMany
    {
        return $this->hasMany(Modalidad::class, 'deportes_id', 'id');
    }

}
