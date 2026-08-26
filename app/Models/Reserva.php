<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reserva extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'codigo_reserva',
        'nombre',
        'fecha',
        'mesa_id',
        'zona',
        'precio',
        'metodo_pago',
        'estado',
    ];

    /**
     * El usuario dueño de esta reserva.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}