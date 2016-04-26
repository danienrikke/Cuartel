<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHisadministrativoTable extends Migration
{
    public function up()
    {
        Schema::create('his_administrativo', function (Blueprint $table) {
            $table->increments('codigo')->unsigned();
            $table->integer('danterior')->default(0);
            $table->integer('canterior')->default(0);
            $table->integer('cadministrativo')->unsigned();
            $table->timestamps();
        });

        Schema::table('his_administrativo', function($table) {
            $table->foreign('cadministrativo')->references('cpersonal')->on('administrativos')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::drop('his_administrativo');
    }
}
