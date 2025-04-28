<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Jugador extends Model
{
    use HasFactory;

    protected $table = 'jugadores';

    protected $fillable = [
        'nombre',
        'edad',
        'posicion',
        'nacionalidad',
        'numero_camiseta',
        'equipo_id',
    ];


    public function equipo(): BelongsTo
    {
        return $this->belongsTo(Equipo::class);
    }
}

