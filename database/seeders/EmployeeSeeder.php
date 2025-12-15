<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User; // Asegúrese de importar el modelo User

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $employeesWithRoles = [
            // 1. Jull Gonzales (ADMINISTRADOR)
            [
                'name' => 'Jull Gonzales',
                'username' => 'jgonzales',
                'email' => 'gonzalesjulde2@autonoma.edu.pe',
                'password' => 'jull123',
                'role' => 'administrador', // <-- ROL ASIGNADO
            ],
            // 2. Martín Callupe (VENDEDOR)
            [
                'name' => 'Martín Callupe',
                'username' => 'mcallupe',
                'email' => 'martinserna021@gmail.com',
                'password' => 'martin123',
                'role' => 'vendedor', // <-- ROL ASIGNADO
            ],
            // 3. Mario Apaza (VENDEDOR)
            [
                'name' => 'Mario Apaza',
                'username' => 'mapaza',
                'email' => 'mapazad@autonoma.edu.pe',
                'password' => 'mario123',
                'role' => 'vendedor', // <-- ROL ASIGNADO
            ],
            // 4. Jesús Rodríguez (ALMACENERO)
            [
                'name' => 'Jesús Rodríguez',
                'username' => 'jrodriguez',
                'email' => 'rodriguezjesas6@autonoma.edu.pe',
                'password' => 'jesus123',
                'role' => 'almacenero', // <-- ROL ASIGNADO
            ],
        ];

        // Insertar los usuarios con sus roles
        foreach ($employeesWithRoles as $employee) {
            User::create([
                'name' => $employee['name'], 
                'username' => $employee['username'],
                'email' => $employee['email'],
                'password' => Hash::make($employee['password']),
                'role' => $employee['role'], // <-- ¡Aquí se asigna el rol!
            ]);
        }
    }
}