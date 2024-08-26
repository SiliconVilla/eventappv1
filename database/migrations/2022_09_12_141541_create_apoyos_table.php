<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApoyosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apoyos', function (Blueprint $table) {
            $table->id();
            
            //$table->unsignedBigInteger('user_id')->primary();
            $table->string('email')->default('@unal.edu.co');
            $table->string('apoyo');
            $table->unsignedBigInteger('estado');
            $table->string('reserva')->nullable();
            $table->string('tarifa');
            $table->string('servicios')->default(0);
            $table->string('corresponsabilidad')->default(0);
            

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('apoyos');
    }
}
