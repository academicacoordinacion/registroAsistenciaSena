<?php

namespace Database\Seeders;

use App\Models\Persona;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PersonaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Persona::create([
            'id' => 1,
            'tipo_documento' => NULL,
            'numero_documento' => 987654321,
            'primer_nombre' => 'SUPER',
            'segundo_nombre' => NULL,
            'primer_apellido' => 'ADMINISTRADOR',
            'segundo_apellido' => NULL,
            'fecha_de_nacimiento' => '2000-01-01',
            'genero' => NULL,
            'email' => 'superAdmin@superAdmin.com',
        ]);
        Persona::create([
            'id' => 2,
            'tipo_documento' => NULL,
            'numero_documento' => 654321123,
            'primer_nombre' => 'ADMIN',
            'segundo_nombre' => NULL,
            'primer_apellido' => 'PRUEBA',
            'segundo_apellido' => NULL,
            'fecha_de_nacimiento' => '2000-01-01',
            'genero' => NULL,
            'email' => 'admin@admin.com',

        ]);

        Persona::create([
            'id' => 3,
            'tipo_documento' => NULL,
            'numero_documento' => 123456789,
            'primer_nombre' => 'INSTRUCTOR',
            'segundo_nombre' => NULL,
            'primer_apellido' => 'PRUEBA',
            'segundo_apellido' => NULL,
            'fecha_de_nacimiento' => '2000-01-01',
            'genero' => NULL,
            'email' => 'instructor@instructor.com',

        ]);
    }
}
