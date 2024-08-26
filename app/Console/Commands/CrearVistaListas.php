<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;

class CrearVistaListas extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crear:vistalista';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Crear la tabla vistas para completar el molo entidad relación';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        DB::unprepared(file_get_contents('database/migrations/query_listas_create.sql'));
        DB::unprepared(file_get_contents('database/migrations/query_proyecto_usuario.sql'));
        DB::unprepared(file_get_contents('database/migrations/query_reg_asistencias_create.sql'));

        
    }
}
