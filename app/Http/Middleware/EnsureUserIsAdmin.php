<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsAdmin
{
    /**
     * Bloquea el acceso a cualquier ruta protegida si el usuario autenticado
     * no tiene el rango de administrador (es_admin = true).
     *
     * Esto es lo que realmente impide que un usuario normal entre a
     * /admin/promociones o /admin/mesas escribiendo la URL directamente,
     * más allá de que el botón esté oculto en la vista.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! $request->user() || ! $request->user()->es_admin) {
            abort(403, 'No tienes permiso para acceder a esta sección.');
        }

        return $next($request);
    }
}
