<?php

namespace App\Http\Controllers;

use App\Models\Promocion;
use App\Models\Evento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PromocionController extends Controller
{
    // ==========================================
    // VISTA PÚBLICA (Página Principal)
    // ==========================================
    public function publicIndex()
    {
        $promociones = Promocion::where('activo', true)->get();
        $eventos = Evento::where('activo', true)->orderBy('fecha', 'asc')->get();

        return view('welcome', compact('promociones', 'eventos'));
    }

    // ==========================================
    // PANEL DE ADMINISTRACIÓN
    // ==========================================
    public function index()
    {
        $promociones = Promocion::latest()->get();
        $eventos = Evento::latest()->get();

        return view('admin.promociones', compact('promociones', 'eventos'));
    }

    // Guarda una nueva promoción
    public function store(Request $request)
    {
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'badge' => 'nullable|string|max:100',
            'descripcion' => 'nullable|string',
            'precio_etiqueta' => 'nullable|string|max:100',
        ]);

        $validated['activo'] = true;

        Promocion::create($validated);

        return redirect()->route('admin.promociones.index')->with('success', 'Promoción creada correctamente.');
    }

    // Guarda un nuevo evento procesando el archivo subido
    public function storeEvento(Request $request)
    {
        $validated = $request->validate([
            'titulo'          => 'required|string|max:255',
            'subtitulo'       => 'nullable|string|max:255',
            'fecha'           => 'required|date',
            'descripcion'     => 'nullable|string',
            'precio_etiqueta' => 'required|string|max:100',
            'imagen'          => 'required|image|mimes:jpeg,png,jpg,webp|max:4096', // Valida archivo de imagen (máx 4MB)
        ]);

        // Sube la imagen a storage/app/public/eventos y obtiene el path relativo
        if ($request->hasFile('imagen')) {
            $validated['imagen'] = $request->file('imagen')->store('eventos', 'public');
        }

        $validated['activo'] = true;

        Evento::create($validated);

        return redirect()->route('admin.promociones.index')->with('success', 'Evento guardado correctamente.');
    }

    // Activa o desactiva la promoción
    public function toggleStatus($id)
    {
        $promo = Promocion::findOrFail($id);
        $promo->activo = !$promo->activo;
        $promo->save();

        return redirect()->route('admin.promociones.index')->with('success', 'Estado de la promoción actualizado.');
    }

    // Activa o desactiva un evento
    public function toggleStatusEvento($id)
    {
        $evento = Evento::findOrFail($id);
        $evento->activo = !$evento->activo;
        $evento->save();

        return redirect()->route('admin.promociones.index')->with('success', 'Estado del evento actualizado.');
    }

    // Elimina la promoción
    public function destroy($id)
    {
        Promocion::destroy($id);
        return redirect()->route('admin.promociones.index')->with('success', 'Promoción eliminada.');
    }

    // Elimina el evento y borra su archivo de imagen físico de storage
    public function destroyEvento($id)
    {
        $evento = Evento::findOrFail($id);
        
        if ($evento->imagen && Storage::disk('public')->exists($evento->imagen)) {
            Storage::disk('public')->delete($evento->imagen);
        }

        $evento->delete();
        return redirect()->route('admin.promociones.index')->with('success', 'Evento eliminado.');
    }
}