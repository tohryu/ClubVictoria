<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            $user = User::firstOrCreate(
                ['email' => $googleUser->getEmail()],
                [
                    'name' => $googleUser->getName(),
                    'password' => bcrypt(str()->random(16)),
                    'es_admin' => false,
                ]
            );

            // El segundo parámetro (true) mantiene la cookie 'remember' activa
            Auth::login($user, true);

            // Regenera la sesión para garantizar persistencia y seguridad
            request()->session()->regenerate();

            return redirect()->route('home');
        } catch (\Exception $e) {
            // Cambiado a 'home' para evitar que falle buscando una ruta 'login' inexistente
            return redirect()->route('home')->with('error', 'Ocurrió un error al iniciar sesión con Google.');
        }
    }
}