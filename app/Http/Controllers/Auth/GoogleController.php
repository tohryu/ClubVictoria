<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    // Redirige al cliente a la pantalla de inicio de sesión de Google
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    // Procesa el retorno de Google tras iniciar sesión
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            // Busca al usuario por su correo o lo crea si es nuevo
            $user = User::firstOrCreate(
                ['email' => $googleUser->getEmail()],
                [
                    'name' => $googleUser->getName(),
                    'password' => bcrypt(str()->random(16)), // Contraseña aleatoria segura
                    'es_admin' => false, // Por defecto no es admin
                ]
            );

            Auth::login($user);

            return redirect()->route('home');
        } catch (\Exception $e) {
            return redirect()->route('login')->with('error', 'Ocurrió un error al iniciar sesión con Google.');
        }
    }
}