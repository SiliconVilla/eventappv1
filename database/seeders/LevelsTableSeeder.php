<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
//use App\Models\User;
use DB;

class LevelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('levels')->insert([
            'namenivel' => 'Creada',
            'project_id' => '1'
            
        ]);

        DB::table('levels')->insert([
            'namenivel' => 'Asignada',
            'project_id' => '1'
            
        ]);

        DB::table('levels')->insert([
            'namenivel' => 'Resuelta',
            'project_id' => '1'
            
        ]);

        DB::table('levels')->insert([
            'namenivel' => 'Notificada',
            'project_id' => '1'
            
        ]);
    }
}
