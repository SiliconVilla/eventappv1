<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('documento');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('qrcode')->nullable();
            $table->string('password');
            $table->string('corresponsabilidad')->default(0);
            $table->smallInteger('role')->default(2); //0: Admin, 1: Soporte, 2: Usuario

            $table->unsignedBigInteger('seleccionar_proyecto_id')->nullable();
            $table->foreign('seleccionar_proyecto_id')->references('id')->on('projects');

            $table->rememberToken();
            //Eliminación lógica de registros - desactivando
            $table->softDeletes();

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
        Schema::dropIfExists('users');
    }
}
