<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cover_configuracion', function (Blueprint $table) {
            $table->id();
            $table->decimal('precio', 10, 2)->default(400.00);
            $table->timestamps();
        });

        DB::table('cover_configuracion')->insert([
            'precio' => 400.00,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('cover_configuracion');
    }
};
