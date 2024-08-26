<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
//use App\Models\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Admin
        \App\Models\User::factory()->create([
            'id' => '1020304050',
        	'name' => 'Jayder',
        	'email' => 'admin@correo.com',
            'documento' => '1020304050',
        	'password' => bcrypt('1234567890'),
        	'role' => 0
        ]);

        //Soporte
        \App\Models\User::factory()->create([
            'id' => '1234567890',
        	'name' => 'Perfil de Soporte',
        	'email' => 'soporte@correo.com',
            'documento' => '1234567890',
        	'password' => bcrypt('1234567890'),
        	'role' => 1
        ]);

        //Usuario
        \App\Models\User::factory()->create([
            'id' => '1112223334',
        	'name' => 'Usuario Cliente',
        	'email' => 'usuario@correo.com',
            'documento' => '1112223334',
        	'password' => bcrypt('1234567890'),
        	'role' => 2
        ]);

         //Usuario
         //\App\Models\User::factory(100)->create();
    }
}
