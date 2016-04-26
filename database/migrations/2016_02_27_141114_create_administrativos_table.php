<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdministrativosTable extends Migration
{
    public function up()
    {
        Schema::create('administrativos', function (Blueprint $table) {
            $table->integer('cpersonal')->unique()->unsigned();
            $table->string('profesion', 50);
            $table->integer('cargo')->unsigned();
            $table->integer('dependencia')->unsigned();
            
            $table->timestamps();
            $table->softDeletes();
        });
        
        Schema::table('administrativos', function($table) {
            $table->foreign('cpersonal')->references('cedula')->on('personal')->onDelete('cascade');
            $table->foreign('cargo')->references('codigo')->on('cargos');
            $table->foreign('dependencia')->references('codigo')->on('dependencias');
        });
    }

    public function down()
    {
        Schema::drop('administrativos');
    }
}
