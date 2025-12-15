<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// Asegúrate de que el modelo User esté en el archivo (generalmente lo está por defecto)
use App\Models\User; 

// Asegúrese de que el UserSeeder de los 4 empleados esté importado
// Nota: No es estrictamente necesario importarlo si se llama por clase, 
// pero es buena práctica llamar al archivo específico: EmployeeSeeder
use Database\Seeders\EmployeeSeeder; 

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 🛑 SOLUCIÓN: Eliminamos la creación de usuario de prueba y llamamos al Seeder de Empleados.

        $this->call([
            EmployeeSeeder::class, // Esto ejecuta su archivo EmployeeSeeder.php
        ]);
        
        // Nota: Las líneas de User::factory() se eliminan para evitar el error de columna faltante.
    }
}
