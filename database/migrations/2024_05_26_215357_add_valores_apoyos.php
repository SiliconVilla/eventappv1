<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('apoyos', function (Blueprint $table) {
            //
            $table->string('saldoAnterior')->after('estado')->default(0);
            $table->string('cantidadEntrada')->after('saldoAnterior')->default(0);
            $table->string('cantidadSalida')->after('cantidadEntrada')->default(0);
            $table->string('saldoCreated')->after('saldo')->default(0);
            $table->string('saldoUpdated')->after('saldoCreated')->default(0);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('apoyos', function (Blueprint $table) {
            //
            $table->dropColumn('saldoAnterior');
            $table->dropColumn('cantidadEntrada');
            $table->dropColumn('cantidadSalida');
            $table->dropColumn('saldoCreated');
            $table->dropColumn('saldoUpdated');
            
        });
    }
};
