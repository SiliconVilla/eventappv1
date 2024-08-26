<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
//use App\Models\User;
use DB;

class CategoriasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            'namecategoria' => 'Acompañamiento Integral',
            //'descripcion' => 'Acompañamiento Integral',
            'project_id' => 1
            
        ]);
        DB::table('categories')->insert([
            'namecategoria' => 'Actividad Física y Deporte',
            //'descripcion' => 'Actividad Física y Deporte',
            'project_id' => 1
            
        ]);
        DB::table('categories')->insert([
            'namecategoria' => 'Cultura',
            //'descripcion' => 'Cultura',
            'project_id' => 1
            
        ]);
        DB::table('categories')->insert([
            'namecategoria' => 'Dirección',
            //'descripcion' => 'Dirección',
            'project_id' => 1
            
        ]);
        DB::table('categories')->insert([
            'namecategoria' => 'Gestión y Fomento Socioeconómico',
            //'descripcion' => 'Gestión y Fomento Socioeconómico',
            'project_id' => 1
            
        ]);
        DB::table('categories')->insert([
            'namecategoria' => 'Salud Estudiantil',
            //'descripcion' => 'Salud Estudiantil',
            'project_id' => 1
            
        ]);
    }
}
