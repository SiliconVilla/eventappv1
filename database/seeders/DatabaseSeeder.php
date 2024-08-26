<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //\App\Models\User::factory(100)->create();

       
        DB::table('users')->insert([
            'id' => '1127070168',
            'name' => 'Jayder Cabezas Molina',
            'email' => 'jjcabezasm@unal.edu.co',
            'documento' => '1127070168',
            'password' => Hash::make('1234567890'),
            'role' => 0,
        ]);

        $this->call(UserTableSeeder::class);

        DB::table('estados')->insert([
            'estado' => 'Activo',
            
        ]);

        DB::table('estados')->insert([
            'estado' => 'Inactivo',
            
        ]);


        DB::table('projects')->insert([
            'name' => 'Semestre 2022-01',
            'descripcion' => 'Primer Periodo año 2022',
            'date' => '2022-03-07'
            
        ]);

     
        DB::table('events')->insert([
            'evento' => 'Catedra Inducción Vida Universitaria',
            'imagen' => 'public/imagenes/slider/RegistroAsistenciasCatedraInduccion_18-04-2022.png',
            'estado_id' => '1'
            
        ]);

        DB::table('events')->insert([
            'evento' => 'Cátedra Rayos de Sol',
            'imagen' => 'public/imagenes/slider/AsistenciaRayosdeSol_18-04-2022.png',
            'estado_id' => '1'
            
        ]);

        DB::table('events')->insert([
            'evento' => 'Socialización Póliza Estudiantil',
            'imagen' => 'public/imagenes/slider/PolizaEstudiantil_18-04-2022.png',
            'estado_id' => '1'
            
        ]);

        DB::table('events')->insert([
            'evento' => 'Técnica Vocal',
            'imagen' => 'public/imagenes/slider/Registro_Tecnica_Vocal_18-04-2022.png',
            'estado_id' => '1'
            
        ]);

        DB::table('events')->insert([
            'evento' => 'Música Andina',
            'imagen' => 'public/imagenes/slider/1650552588MusicaAndina_Asistencias_BU.png',
            'estado_id' => '1'
            
        ]);

        DB::table('events')->insert([
            'evento' => 'Apoyo Alimentario',
            'imagen' => 'public/imagenes/slider/1650331901Registro_ApoyoAlimentario_2022.png',
            'estado_id' => '1'
            
        ]);

        

        

        DB::table('places')->insert([
            'place' => 'Auditorio Hernando Patiño Cruz',
            'latitud' => '3.51222',
            'longitud' => '-76.30723',
            'tipo' => '',
        ]);

        DB::table('places')->insert([
            'place' => 'Cancha de Futbol',
            'latitud' => '3.51039',
            'longitud' => '-76.30829',
            'tipo' => '',
        ]);

        DB::table('places')->insert([
            'place' => 'Edificio 50 UNAL Palmira',
            'latitud' => '3.51288',
            'longitud' => '-76.30783',
            'tipo' => '',
        ]);

        DB::table('places')->insert([
            'place' => 'Biblioteca UNAL Palmira',
            'latitud' => '3.51131',
            'longitud' => '-76.30764',
            'tipo' => '',
        ]);
        DB::table('places')->insert([
            'place' => 'Salas de Micros',
            'latitud' => '3.51135',
            'longitud' => '-76.30816',
            'tipo' => '',
        ]);
        DB::table('places')->insert([
            'place' => 'Óvalo Central - UNAL Palmira',
            'latitud' => '3.51183',
            'longitud' => '-76.30792',
            'tipo' => '',
        ]);
        DB::table('places')->insert([
            'place' => 'UNIMEDIOS',
            'latitud' => '3.51297',
            'longitud' => '-76.30805',
            'tipo' => '',
        ]);

        DB::table('places')->insert([
            'place' => 'Parque la Palabra - UNAL Palmira',
            'latitud' => '3.51253',
            'longitud' => '-76.30795',
            'tipo' => '',
        ]);
        DB::table('places')->insert([
            'place' => 'Salones de Diseño Industrial',
            'latitud' => '3.51239',
            'longitud' => '-76.30738',
            'tipo' => '',
        ]);
        DB::table('places')->insert([
            'place' => 'Granja Experimental Mario Gonzalez Aranda',
            'latitud' => '3.50840',
            'longitud' => '-76.30994',
            'tipo' => '',
        ]);

        DB::table('places')->insert([
            'place' => 'Auditorio Gary Mintz',
            'latitud' => '3.51298',
            'longitud' => '-76.30812',
            'tipo' => '',
        ]);
        DB::table('places')->insert([
            'place' => 'Auditorios Edificio 25 1010 - 1020',
            'latitud' => '3.51134',
            'longitud' => '-76.30819',
            'tipo' => '',
        ]);
        DB::table('places')->insert([
            'place' => 'Virtual',
            'latitud' => '3.5121776',
            'longitud' => '-76.3074038',
            'tipo' => '',
        ]);

        
        $this->call(CategoriasTableSeeder::class);
        $this->call(LevelsTableSeeder::class);
        $this->call(TiposTableSeeder::class);
       // $this->call(UserTableSeeder::class);


       /*
        DB::table('project_user')->insert([
            'project_id' => '1',
            'user_id' => '1',
            'level_id' => '1',
        ]);

        DB::table('project_user')->insert([
            'project_id' => '1',
            'user_id' => '3',
            'level_id' => '1',
        ]);
        */

    }
}
