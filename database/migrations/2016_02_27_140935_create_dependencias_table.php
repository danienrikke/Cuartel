<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDependenciasTable extends Migration
{
    public function up()
    {
        Schema::create('dependencias', function (Blueprint $table) {
            $table->increments('codigo')->unsigned();
            $table->string('nombre', 40)->unique();
            $table->string('actividad', 50);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('dependencias');
    }
}
