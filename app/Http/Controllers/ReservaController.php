<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use App\Models\Promocion; // <-- Importamos el modelo de Promociones
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ReservaController extends Controller
{
    // Muestra la cartelera / vista inicial pasándole las promociones activas
    public function index()
    {
        // Consultar solo las promociones que estén activas
        $promociones = Promocion::where('activo', true)->get();

        return view('welcome', compact('promociones')); // O 'reservar' según el nombre de tu vista principal
    }

    // Muestra el croquis interactivo para elegir mesa
    public function mapa()
    {
        return view('reservar-mesa');
    }

    // Procesa el formulario, guarda en BD ligada al usuario autenticado y muestra la confirmación
    public function procesarReserva(Request $request)
    {
        // 1. Validar inputs recibidos
        $validated = $request->validate([
            'nombre'      => 'required|string|max:255',
            'fecha'       => 'required|date',
            'mesa_id'     => 'required|string',
            'zona'        => 'nullable|string',
            'precio'      => 'nullable|numeric',
            'metodo_pago' => 'nullable|string|in:tarjeta,paypal',
        ]);

        // Genera un código de reserva garantizando que no exista ya en la BD,
        // para que el QR generado a partir de él nunca se repita.
        $codigoReserva = $this->generarCodigoReservaUnico();

        // 2. Guardar el registro en la base de datos, ligado al usuario autenticado
        $reserva = Reserva::create([
            'user_id'        => $request->user()->id,
            'codigo_reserva' => $codigoReserva,
            'nombre'         => $validated['nombre'],
            'fecha'          => $validated['fecha'],
            'mesa_id'        => $validated['mesa_id'],
            'zona'           => $validated['zona'] ?? 'General',
            'precio'         => $validated['precio'] ?? 0,
            'metodo_pago'    => $validated['metodo_pago'] ?? 'tarjeta',
            'estado'         => 'confirmada',
        ]);

        // 3. Retornar vista pasando los datos guardados
        return view('reserva-exitosa', [
            'codigo_reserva' => $reserva->codigo_reserva,
            'nombre'         => $reserva->nombre,
            'fecha'          => $reserva->fecha,
            'mesa_id'        => $reserva->mesa_id,
            'zona'           => $reserva->zona,
            'metodo_pago'    => $reserva->metodo_pago,
        ]);
    }

    // Genera un código de reserva (y por lo tanto de QR) único, verificándolo contra la BD
    private function generarCodigoReservaUnico(): string
    {
        do {
            $codigo = 'VIC-' . strtoupper(Str::random(8));
        } while (Reserva::where('codigo_reserva', $codigo)->exists());

        return $codigo;
    }

    // Muestra ÚNICAMENTE las reservas del usuario autenticado (privadas por cuenta, no por sesión)
    public function misReservas(Request $request)
    {
        $reservas = Reserva::where('user_id', $request->user()->id)
            ->orderBy('fecha', 'desc')
            ->get();

        return view('mis-reservas', compact('reservas'));
    }
}