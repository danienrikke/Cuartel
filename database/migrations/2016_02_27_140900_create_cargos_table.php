<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCargosTable extends Migration
{
    public function up()
    {
        Schema::create('cargos', function (Blueprint $table) {
            $table->increments('codigo')->unsigned();
            $table->string('tipo', 50)->unique();
            $table->string('descripcion', 100);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('cargos');
    }
}
