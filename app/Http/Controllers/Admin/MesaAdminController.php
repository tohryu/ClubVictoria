<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mesa;
use Illuminate\Http\Request;

class MesaAdminController extends Controller
{
    public function index()
    {
        $mesas = Mesa::all();
        return view('admin.mesas.index', compact('mesas'));
    }

    public function updatePrecio(Request $request, $id)
    {
        $request->validate([
            'precio' => 'required|numeric|min:0',
        ]);

        $mesa = Mesa::findOrFail($id);
        $mesa->precio = $request->precio;
        $mesa->save();

        $mensaje = "¡Precio de {$mesa->numero} actualizado a $" . number_format($mesa->precio, 2) . "!";

        // Si la petición viene por AJAX (fetch del panel de mesas) respondemos JSON
        // para mostrar una notificación propia de la página, sin recargar ni depender
        // de un redirect. Si no, mantenemos el comportamiento clásico por si el
        // formulario se envía sin JavaScript.
        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => $mensaje,
                'mesa' => [
                    'id' => $mesa->id,
                    'numero' => $mesa->numero,
                    'precio' => (float) $mesa->precio,
                ],
            ]);
        }

        return redirect()->route('admin.mesas.index')->with('success', $mensaje);
    }
}