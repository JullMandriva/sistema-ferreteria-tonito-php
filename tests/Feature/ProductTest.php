<?php

namespace Tests\Feature;

use App\Models\User; 
use Illuminate\Foundation\Testing\DatabaseMigrations; // <-- USAMOS ESTE TRAIT CLAVE
use Tests\TestCase;

class ProductTest extends TestCase
{
    // Usamos DatabaseMigrations para asegurar que las tablas se creen
    use DatabaseMigrations;

    public function test_usuario_no_autenticado_no_puede_crear_producto()
    {
        $productData = [
            'nombre' => 'Martillo de carpintero',
            'precio' => 15.50,
            'stock' => 50,
            'codigo_sku' => 'MART001', 
        ];
        
        // 1. ACCIÓN: Simular la petición POST sin estar logueado
        $response = $this->post('/dashboard', $productData); 
        
        // 2. AFIRMACIONES:
        $response->assertRedirect('/login');
        
        $this->assertDatabaseMissing('products', [
            'nombre' => 'Martillo de carpintero'
        ]);
    }

    public function test_trabajador_autenticado_puede_crear_producto()
    {
        // 1. CREACIÓN: Crear y autenticar a un trabajador de prueba
        $user = User::factory()->create(['username' => 'trabajador']);
        $this->actingAs($user); 

        // 2. Datos del producto a crear 
        $productData = [
            'nombre' => 'Tornillos autorroscantes',
            'precio' => 0.25,
            'stock' => 1500,
            'codigo_sku' => 'TORN001', 
        ];

        // 3. ACCIÓN: Simular la petición POST
        $response = $this->post('/dashboard', $productData); 

        // 4. AFIRMACIONES:
        $response->assertSessionHasNoErrors(); 

        $this->assertDatabaseHas('products', [
            'nombre' => 'Tornillos autorroscantes',
            'precio' => 0.25,
            'codigo_sku' => 'TORN001',
        ]);

        $response->assertRedirect('/dashboard'); 
    }
}