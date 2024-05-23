<?php

namespace Database\Seeders;

use App\Models\Regional;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RegionalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Regional::create([
            'regional' => 'CENTRO DE DESARROLLO AGROINDUSTRIAL, TURÍSTICO Y TECNOLÓGICO DEL GUAVIARE REGIONAL GUAVIARE',
            'user_create_id' => '1',
            'user_edit_id' => '1',
            'status' => '1',
        ]);
    }
}
