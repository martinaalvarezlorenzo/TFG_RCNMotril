<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('solicitudes_categoria', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('user_id')
                ->nullable()
                ->constrained('solicitudes')
                ->cascadeOnUpdate()
                ->nullOnDelete();

            $table->foreignId('categoria_id')
                ->nullable()
                ->constrained('categorias')
                ->cascadeOnUpdate()
                ->nullOnDelete();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('solicitudes_categoria');
    }
};
