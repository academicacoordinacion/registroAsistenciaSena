<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call([
        PersonaSeeder::class,
        UsersTableSeeder::class,
        PaisSeeder::class,
        RegionalSeeder::class,
        DepartamentoSeeder::class,
        MunicipioSeeder::class,
        SedeSeeder::class,
        BloqueSeeder::class,
        PisoSeeder::class,
        AmbienteSeeder::class,
        ParametroSeeder::class,
        TemaSeeder::class,
        updatePersona::class,
        InstructorSeeder::class,

        ]);
    }
}
