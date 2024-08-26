<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;

class ImportPlacesUNAL extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:placesunal';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Importa el archivo places.sql con códigos de ubicación del lugares';

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
        DB::unprepared(file_get_contents(‘database/migrations/places.sql’));
    }
}
