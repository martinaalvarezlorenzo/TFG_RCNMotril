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
        Schema::create('minimas', function (Blueprint $table) {
            $table->id();
            $table->string('piscina');
            $table->string('crono');
            $table->string('estilo');
            $table->string('distancia');
            $table->string('lugar');
            $table->date('fecha');
            $table->string('tiempo'); 
            $table->string('sexo')->nullable(); 
            $table->string('tipo');
            $table->foreignId('idUsuario1')->nullable()->constrained('users')->cascadeOnUpdate()->nullOnDelete();
            $table->foreignId('idUsuario2')->nullable()->constrained('users')->cascadeOnUpdate()->nullOnDelete();
            $table->foreignId('idUsuario3')->nullable()->constrained('users')->cascadeOnUpdate()->nullOnDelete();
            $table->foreignId('idUsuario4')->nullable()->constrained('users')->cascadeOnUpdate()->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('minimas');
    }
};
