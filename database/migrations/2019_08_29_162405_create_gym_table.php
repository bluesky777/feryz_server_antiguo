<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGymTable extends Migration
{

    public function up()
    {
        Schema::create('gym_users', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id');
            $table->string('nombres'); 
            $table->string('apellidos');
            $table->string('sexo')->nullable();
            $table->string('email')->nullable();
            $table->string('fecha_nac')->nullable();
            $table->string('celular')->nullable();
            $table->string('documento')->nullable();
            $table->string('tipo')->nullable();
            $table->string('usuario');
            $table->string('password')->nullable();
            $table->timestamps();
        });

        Schema::create('gym_asistencias', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id');
            $table->integer('usuario_id'); 
            $table->string('fecha_nac')->nullable();
            $table->timestamps();
        });







    }


    public function down()
    {
        Schema::dropIfExists('gym_asistencias');
        Schema::dropIfExists('gym_users');
    }
}
