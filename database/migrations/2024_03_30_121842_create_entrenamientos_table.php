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
        Schema::create('entrenamientos', function (Blueprint $table) {
            $table->id();
            $table->string('entrenamiento', 1000); 
            $table->date('dia');
        
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
        Schema::dropIfExists('entrenamientos');
    }
};
