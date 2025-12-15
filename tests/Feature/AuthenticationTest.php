<?php

namespace Tests\Feature;

use App\Models\User; 
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase; 

    public function test_la_pantalla_de_login_puede_ser_renderizada()
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
    }

    /**
     * Prueba que un usuario pueda iniciar sesión con credenciales válidas.
     * Esta prueba usa el campo 'username' para la petición POST.
     *
     * @return void
     */
    public function test_el_usuario_puede_autenticarse_con_credenciales_validas()
    {
        // 1. CREACIÓN: Crea un usuario de prueba
        $user = User::factory()->create([
            'username' => 'trabajador',
            'email' => 'trabajador@ferreteria.com',
            'password' => bcrypt('password123'), 
        ]);

        // 2. ACCIÓN: Simula el envío de formulario de login
        $response = $this->post('/login', [
            // Corregido: Usamos 'username' en la petición POST
            'username' => 'trabajador', 
            'password' => 'password123', 
        ]);

        // 3. AFIRMACIONES:
        
        // Debe autenticarse
        $this->assertAuthenticatedAs($user);

        // Debe ser redirigido al CRUD del inventario/productos
        // (Asegúrate que esta es la ruta correcta)
        $response->assertRedirect('/dashboard'); 
    }
}