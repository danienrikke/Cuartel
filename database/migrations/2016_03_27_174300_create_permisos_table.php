<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermisosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permisos', function (Blueprint $table) {
            $table->increments('codigo')->unsigned();
            $table->integer('cpersonal')->unsigned();
            $table->integer('tipo');
            $table->text('descripcion');
            $table->integer('estatus')->default(0);
            $table->date('fecha_permiso');
            $table->date('fecha_ingreso');
            $table->timestamps();
        });

        Schema::table('permisos', function($table) {
            $table->foreign('cpersonal')->references('cedula')->on('personal')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('permisos');
    }
}
