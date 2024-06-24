<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Artisan;
use App\Models\Usu;
use Illuminate\Support\Facades\Hash;


class UserTest extends TestCase
{
    public function test_login()
    {
        // Crear un usuario con todos los campos requeridos
        $user = Usu::create([
            'nombre' => 'Martina',
            'correo_electronico' => 'correo@example.com',
            'username' => '@martina',
            'password' => '1234' // Guarda la contraseña ya cifrada
        ]);

        // Intento de acceso con credenciales correctas
        $response = $this->post(route('login'), [
            'username' => '@martina',
            'password' => '1234' // Proporciona la contraseña en texto plano
        ]);

        // Asserts
        $response->assertStatus(200); // Verifica que la respuesta sea una redirección exitosa
        $this->assertAuthenticated(); // Verifica que el usuario esté autenticado correctamente
    }

    public function test_login_with_correct_credentials()
{
    // Usuario de prueba en memoria
    $user = [
        'username' => '@martina',
        'password' => bcrypt('1234'), // Guarda la contraseña cifrada
    ];

    // Intento de acceso con credenciales correctas
    $response = $this->post(route('login'), [
        'username' => '@martina',
        'password' => '1234' // Proporciona la contraseña en texto plano
    ]);

    // Asserts
    $response->assertStatus(302); // Verifica que la respuesta sea una redirección exitosa
    $this->assertAuthenticated(); // Verifica que el usuario esté autenticado correctamente
}
    
    
}
