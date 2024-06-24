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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('primer_apellido');
            $table->string('segundo_apellido')->nullable();
            $table->string('correo_electronico')->unique();
            $table->timestamp('correo_verified_at')->nullable();
            $table->string('username')->unique();
            $table->string('sexo');
            $table->date('fecha_nacimiento');
            $table->string('password');
            $table->string('telefono');
            $table->string('tipo');
            $table->string('dni')->unique();
            $table->string('imagen')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->bigInteger('estado', 20)->default(1); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
