<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConsultoriosTable extends Migration
{
    public function up()
    {
        Schema::create('consultorios', function (Blueprint $table) {
            $table->increments('codigo')->unsigned();
            $table->string('nombre', 50)->unique();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('consultorios');
    }
}
