<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVacacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vacaciones', function (Blueprint $table) {
            $table->increments('codigo');
            $table->integer('cpersonal')->unsigned();
            $table->integer('cdependencia')->unsigned();
            $table->integer('estatus')->default(0);
            $table->date('fecha_salida');
            $table->date('fecha_ingreso');
            $table->timestamps();
        });

        Schema::table('vacaciones', function($table) {
            $table->foreign('cpersonal')->references('cedula')->on('personal')->onDelete('cascade');
            $table->foreign('cdependencia')->references('codigo')->on('dependencias')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('vacaciones');
    }
}
