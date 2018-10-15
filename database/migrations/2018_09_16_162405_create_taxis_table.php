<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaxisTable extends Migration
{

    public function up()
    {
        Schema::create('tx_users', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id');
            $table->string('nombres'); 
            $table->string('apellidos');
            $table->string('sexo')->nullable();
            $table->string('fecha_nac')->nullable();
            $table->string('celular')->nullable();
            $table->string('documento')->nullable();
            $table->string('tipo');
            $table->string('usuario');
            $table->string('password')->nullable();
            $table->timestamps();
        });

        Schema::create('tx_taxistas', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id');
            $table->string('nombres'); 
            $table->string('apellidos');
            $table->string('sexo')->nullable();
            $table->string('fecha_nac')->nullable();
            $table->string('celular')->nullable();
            $table->string('documento')->nullable();
            $table->string('usuario');
            $table->string('password')->nullable();
            $table->timestamps();
        });



        Schema::create('tx_taxis', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id');
            $table->string('modelo'); 
            $table->string('numero');
            $table->string('placa')->nullable();
            $table->string('taxista_id')->nullable();
            $table->string('propietario')->nullable();
            $table->string('soat')->nullable();
            $table->string('seguro')->nullable();
            $table->timestamps();
        });



        Schema::create('tx_carreras', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id');
            $table->integer('taxi_id'); 
            $table->integer('taxista_id');
            $table->string('zona')->nullable();
            $table->string('fecha_ini')->nullable();
            $table->string('lugar_ini')->nullable();
            $table->string('lugar_fin')->nullable();
            $table->string('fecha_fin')->nullable();
            $table->string('estado')->nullable();
            $table->timestamps();
        });





    }


    public function down()
    {
        Schema::drop('tx_carreras');
        Schema::drop('tx_taxistas');
        Schema::drop('tx_taxis');
        Schema::drop('tx_users');
    }
}
