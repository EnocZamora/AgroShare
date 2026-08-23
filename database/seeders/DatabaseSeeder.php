<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            CategorySeeder::class,
        ]);

        // Usuario Administrador
        User::firstOrCreate(
            ['email' => 'admin@agroshare.ni'],
            [
                'name' => 'Administrador AgroShare',
                'password' => Hash::make('admin123'),
                'phone' => '+505 8888 0001',
                'department' => 'Managua',
                'municipality' => 'Managua',
                'preferred_language' => 'es',
                'rol_sistema' => 'ADMINISTRADOR',
            ]
        );

        // Usuario Auditor
        User::firstOrCreate(
            ['email' => 'auditor@agroshare.ni'],
            [
                'name' => 'Auditor AgroShare',
                'password' => Hash::make('auditor123'),
                'phone' => '+505 8888 0002',
                'department' => 'Managua',
                'municipality' => 'Managua',
                'preferred_language' => 'es',
                'rol_sistema' => 'AUDITOR',
            ]
        );

        // Usuario Productor de prueba
        User::firstOrCreate(
            ['email' => 'productor@agroshare.ni'],
            [
                'name' => 'Juan Productor',
                'password' => Hash::make('productor123'),
                'phone' => '+505 8888 0003',
                'department' => 'Matagalpa',
                'municipality' => 'Matagalpa',
                'preferred_language' => 'es',
                'rol_sistema' => 'USUARIO',
            ]
        );
    }
}