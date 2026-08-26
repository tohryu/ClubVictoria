<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Crea/actualiza las 51 mesas (L, R, D, F, A) con sus precios base.
        // Sin esto la tabla "mesas" queda vacía y el panel de precios falla.
        $this->call(MesaSeeder::class);
    }
}
