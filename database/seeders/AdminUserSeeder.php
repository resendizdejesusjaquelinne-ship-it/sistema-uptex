<?php
namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder {
    public function run(): void {
        User::updateOrCreate(
            ['email' => 'admin@uptex.edu.mx'],
            [
                'name' => 'Administradora Jaquelinne',
                'password' => Hash::make('12345678'),
                'email_verified_at' => now(),
            ]
        );
    }
}