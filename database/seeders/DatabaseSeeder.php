<?php
namespace Database\Seeders;
use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
    public function run(): void {
        $this->call([AdminUserSeeder::class]);
        Categoria::factory(10)->create();
        Producto::factory(50)->create([
            'categoria_id' => fn() => Categoria::inRandomOrder()->first()->id,
        ]);
    }
}