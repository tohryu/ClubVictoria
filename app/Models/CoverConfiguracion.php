<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CoverConfiguracion extends Model
{
    protected $table = 'cover_configuracion';

    protected $fillable = [
        'precio',
    ];

    protected $casts = [
        'precio' => 'decimal:2',
    ];

    public static function precioActual(): float
    {
        return (float) (static::query()->value('precio') ?? 0);
    }

    public static function precioConfigurado(): bool
    {
        return static::precioActual() > 0;
    }

    public static function actualizarPrecio(float $precio): self
    {
        $config = static::query()->first();

        if (! $config) {
            $config = new self();
        }

        $config->precio = $precio;
        $config->save();

        return $config;
    }
}
