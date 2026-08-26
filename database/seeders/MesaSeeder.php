<?php

namespace Database\Seeders;

use App\Models\Mesa;
use Illuminate\Database\Seeder;

class MesaSeeder extends Seeder
{
    public function run(): void
    {
        // --- PLANTA BAJA (piso 1) ---
        // Zona L (L1 a L16)
        for ($i = 1; $i <= 16; $i++) {
            Mesa::updateOrCreate(['numero' => 'L' . $i], ['piso' => 1, 'precio' => 150.00]);
        }

        // Zona R (R1 a R13)
        for ($i = 1; $i <= 13; $i++) {
            Mesa::updateOrCreate(['numero' => 'R' . $i], ['piso' => 1, 'precio' => 180.00]);
        }

        // Zona D (D1 y D2)
        foreach (['D1', 'D2'] as $codigo) {
            Mesa::updateOrCreate(['numero' => $codigo], ['piso' => 1, 'precio' => 200.00]);
        }

        // --- SEGUNDA PLANTA (piso 2) ---
        // Zona F (F1 a F16)
        for ($i = 1; $i <= 16; $i++) {
            Mesa::updateOrCreate(['numero' => 'F' . $i], ['piso' => 2, 'precio' => 220.00]);
        }

        // Zona A (A1 a A4)
        for ($i = 1; $i <= 4; $i++) {
            Mesa::updateOrCreate(['numero' => 'A' . $i], ['piso' => 2, 'precio' => 300.00]);
        }
    }
}
