<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVisiometriaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visiometria', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id');
            $table->integer('paciente_id')->unsigned();
            $table->datetime('fecha')->nullable();
            $table->string('ant_personales')->nullable();
            $table->string('recomendaciones')->nullable();

            $table->string('estereopsis', 1)->nullable(); // N o A, Normal o Anormal
            $table->string('estereopsis_observ')->nullable();
            $table->string('test_color', 1)->nullable(); // N o A, Normal o Anormal
            $table->string('test_color_observ')->nullable();
            $table->timestamps();
        });

        Schema::create('sintomas_vision', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id');
            $table->integer('paciente_id')->unsigned();
            $table->string('nombre')->nullable();
            $table->timestamps();
        });


        Schema::create('agudeza_visual', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id');
            $table->boolean('correc_optica')->nullable();
            //oido derecho
            $table->boolean('ojo_der_esfera')->nullable();
            $table->boolean('ojo_der_cilindro')->nullable();
            $table->boolean('ojo_der_eje')->nullable();
            $table->boolean('ojo_der_add')->nullable();
            //vision lejos
            $table->boolean('ojo_der_sc_lejos')->nullable();
            $table->boolean('ojo_der_cc_lejos')->nullable();
            //vision cerca
            $table->boolean('ojo_der_sc_cerca')->nullable();
            $table->boolean('ojo_der_cc_cerca')->nullable();
            //oido izquierdo
            $table->boolean('ojo_izq_esfera')->nullable();
            $table->boolean('ojo_izq_cilindro')->nullable();
            $table->boolean('ojo_izq_eje')->nullable();
            $table->boolean('ojo_izq_add')->nullable();
            $table->boolean('ojo_izq_sc')->nullable();
            //vision lejos
            $table->boolean('ojo_izq_cc_lejos')->nullable();
            $table->boolean('ojo_izq_cs_lejos')->nullable();
            //vision cerca
            $table->boolean('ojo_izq_sc_cerca')->nullable();
            $table->boolean('ojo_izq_cc_cerca')->nullable();

            $table->boolean('pabellon_auricular_izq')->nullable(); 
            $table->boolean('cae_der')->nullable(); 
            $table->boolean('cae_izq')->nullable(); 
            $table->boolean('membrana_timpanica_der')->nullable(); 
            $table->boolean('membrana_timpanica_izq')->nullable();

            $table->boolean('ojo_izq_ph')->nullable(); 
            $table->boolean('ojo_der_ph')->nullable(); 
            
            $table->integer('paciente_id')->unsigned();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('motilidad_ocular', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id');
            $table->integer('paciente_id')->unsigned();
            $table->string('oftalmoscopia_od', 1)->nullable(); // N o A, Normal o Anormal
            $table->string('oftalmoscopia_od_observ')->nullable(); 
            $table->string('oftalmoscopia_oi', 1)->nullable(); // N o A, Normal o Anormal
            $table->string('oftalmoscopia_oi_observ')->nullable();

            $table->string('externo_od', 1)->nullable(); // N o A, Normal o Anormal
            $table->string('externo_od_observ')->nullable();
            $table->string('externo_oi', 1)->nullable(); // N o A, Normal o Anormal
            $table->string('externo_oi_observ')->nullable();
            $table->timestamps();
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('motilidad_ocular');
        Schema::drop('agudeza_visual');
        Schema::drop('sintomas_vision');
        Schema::drop('visiometria');
    }
}
