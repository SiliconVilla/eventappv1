<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCorresponsabilidadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('corresponsabilidads', function (Blueprint $table) {
            $table->id();

            $table->string('actividad')->nullable();


            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('apoyos');


            $table->unsignedBigInteger('soporte_id');
            $table->foreign('soporte_id')->references('id')->on('users');


            $table->string('horas')->nullable();
            
            $table->string('fecha');


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
        Schema::dropIfExists('corresponsabilidads');
    }
}
