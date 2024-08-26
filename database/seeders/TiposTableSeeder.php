<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
//use App\Models\User;
use DB;

class TiposTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipos')->insert([
            'name' => 'Asesoría Académico Administrativa',
            'descripcion' => 'Acompañamiento en la Vida Universitaria',
            'category_id' => 1
            
        ]);

        DB::table('tipos')->insert([
            'name' => 'Préstamo de Implementos Deportivos',
            'descripcion' => 'Actividad Lúdico-Deportiva',
            'category_id' => 2
            
        ]);

        DB::table('tipos')->insert([
            'name' => 'Préstamo de Instrumentos',
            'descripcion' => 'Actividad Lúdico-Cultural',
            'category_id' => 3
            
        ]);

        DB::table('tipos')->insert([
            'name' => 'Reubicación Socioeconómica',
            'descripcion' => 'Comité de Matrícula',
            'category_id' => 4
            
        ]);

        DB::table('tipos')->insert([
            'name' => 'Apoyo Alimentario',
            'descripcion' => 'Gestión para la alimentación estudiantil',
            'category_id' => 5
            
        ]);

        DB::table('tipos')->insert([
            'name' => 'Citas Médicas',
            'descripcion' => 'Atención en Salud',
            'category_id' => 6
            
        ]);
    }
}
