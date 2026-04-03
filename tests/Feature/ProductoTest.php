<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductoTest extends TestCase
{
    use RefreshDatabase;

    private User $admin;

    protected function setUp(): void
    {
        parent::setUp();
        // Forzamos la llave para evitar el error de hashing
        config(['app.key' => 'base64:OTY0NjU0MzIxMDEyMzQ1Njc4OTAxMjM0NTY3ODkwMTI=']);
        
        // Creamos el admin base para los tests
        $this->admin = User::factory()->create(['rol' => 'admin']);
    }

    /** @test */
    public function test_puede_ver_listado_de_productos(): void
    {
        // Creamos la categoría primero para evitar error de llave foránea
        $categoria = Categoria::factory()->create();
        Producto::factory()->create(['categoria_id' => $categoria->id]);

        $response = $this->actingAs($this->admin)->get('/productos');
        
        // Si sale 500 aquí, recuerda crear el archivo resources/views/productos/index.blade.php
        $response->assertStatus(200);
    }

    /** @test */
    public function test_admin_puede_crear_producto(): void
    {
        $categoria = Categoria::factory()->create();
        
        $data = [
            'nombre' => 'Laptop Gamer ' . uniqid(),
            'descripcion' => 'Prueba de log',
            'precio' => 15000,
            'stock' => 5,
            'categoria_id' => $categoria->id
        ];

        $response = $this->actingAs($this->admin)->post('/productos', $data);
        
        // Verifica que después de crear, nos mande a la lista
        $response->assertRedirect('/productos');
    }

    /** @test */
    public function test_no_puede_crear_producto_sin_nombre(): void
    {
        $categoria = Categoria::factory()->create();
        
        $response = $this->actingAs($this->admin)->post('/productos', [
            'precio' => 100,
            'stock' => 10,
            'categoria_id' => $categoria->id
        ]);

        $response->assertSessionHasErrors('nombre');
    }

    /** @test */
    public function test_usuario_normal_no_puede_crear_producto(): void
    {
        $user = User::factory()->create(['rol' => 'usuario']);
        $categoria = Categoria::factory()->create();
        
        // Enviamos datos completos pero con un usuario sin permisos
        $response = $this->actingAs($user)->post('/productos', [
            'nombre' => 'Intento Fallido',
            'precio' => 10,
            'stock' => 1,
            'categoria_id' => $categoria->id
        ]);

        // El controlador debe abortar con 403
        $response->assertStatus(403);
    }
}