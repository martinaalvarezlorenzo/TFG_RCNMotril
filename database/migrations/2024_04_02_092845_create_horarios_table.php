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
        Schema::create('horarios', function (Blueprint $table) {
            $table->id();
            $table->text('horarioLunes')->nullable(); 
            $table->text('horarioMartes')->nullable();
            $table->text('horarioMiercoles')->nullable();
            $table->text('horarioJueves')->nullable(); 
            $table->text('horarioViernes')->nullable();
            $table->text('horarioSabado')->nullable(); 
            $table->date('semana');
            
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
        Schema::dropIfExists('horarios');
    }
};
