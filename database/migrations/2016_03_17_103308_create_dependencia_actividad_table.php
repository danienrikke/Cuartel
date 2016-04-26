<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDependenciaActividadTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dependencia_actividad', function (Blueprint $table) {
            $table->integer('dependencia')->unsigned();
            $table->integer('actividad')->unsigned();
            $table->timestamps();
        });

        Schema::table('dependencia_actividad', function($table) {
            $table->foreign('dependencia')->references('codigo')->on('dependencias');
            $table->foreign('actividad')->references('codigo')->on('actividades');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('dependencia_actividad');
    }
}
