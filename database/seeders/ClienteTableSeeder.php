<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class ClienteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        

        //Usuario
        /*\App\Models\User::factory(1)->create([
        	'name' => 'Cliente Seeder',
        	'email' => 'clienteseeder@correo.com',
            'documento' => '1112223334',
        	'password' => bcrypt('1234567890'),
        	'role' => 2
        ]);*/


        \App\Models\User::factory(100)->create();

        /*DB::table('users')->insert([
            'name' => str_random(10),
            'email' => str_random(10).'@gmail.com',
            'password' => bcrypt('secret'),
        ]);*/
    }
}