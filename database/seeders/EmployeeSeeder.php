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
        // 1. Lista de los 4 trabajadores con sus datos de prueba
        $employees = [
            [
                'name' => 'Jesús Rodríguez',
                'username' => 'jrodriguez',
                'email' => 'rodriguezjesas6@autonoma.edu.pe',
                'password' => 'jesus123',
            ],
            [
                'name' => 'Jull Gonzales',
                'username' => 'jgonzales',
                'email' => 'gonzalesjulde2@autonoma.edu.pe',
                'password' => 'jull123',
            ],
            [
                'name' => 'Mario Apaza',
                'username' => 'mapaza',
                'email' => 'mapazad@autonoma.edu.pe',
                'password' => 'mario123',
            ],
            [
                'name' => 'Martín Callupe',
                'username' => 'mcallupe',
                'email' => 'martinserna021@gmail.com',
                'password' => 'martin123',
            ]
        ];

        // 2. Insertar los usuarios en la base de datos
        foreach ($employees as $employee) {
            User::create([
                'name' => $employee['name'], // <--- CORRECCIÓN AÑADIDA
                'username' => $employee['username'],
                'email' => $employee['email'],
                'password' => Hash::make($employee['password']), // Hashear la contraseña
            ]);
        }
    }
}