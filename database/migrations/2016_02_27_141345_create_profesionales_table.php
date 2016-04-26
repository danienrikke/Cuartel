<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfesionalesTable extends Migration
{
    public function up()
    {
        Schema::create('profesionales', function (Blueprint $table) {
            $table->integer('cpersonal')->unique()->unsigned();
            $table->string('tmilitar', 30);
            $table->string('jerarquia', 30);
            $table->string('matricula', 30);
            $table->string('especialidad', 30);
            $table->text('dtallas');
            $table->string('iproveniente', 30);
            $table->date('fuascenso');
            $table->integer('dependencia')->unsigned();
            $table->integer('cargo')->unsigned();

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('profesionales', function($table) {
            $table->foreign('cpersonal')->references('cedula')->on('personal')->onDelete('cascade');
            $table->foreign('cargo')->references('codigo')->on('cargos');
            $table->foreign('dependencia')->references('codigo')->on('dependencias');
        });
    }

    public function down()
    {
        Schema::drop('profesionales');
    }
}
