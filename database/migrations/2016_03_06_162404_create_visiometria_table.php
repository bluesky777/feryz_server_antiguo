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
            // Otológicos

        Schema::create('visiometria', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id');
            $table->datetime('fecha')->nullable();

            $table->boolean('enrojecimiento_ojo')->nullable(); 
            $table->boolean('lagrimeo')->nullable();
            $table->boolean('ardor_ocular')->nullable();
            $table->boolean('vision_borrosa')->nullable();
            $table->boolean('vision_doble')->nullable();
            $table->boolean('prurito')->nullable();
            $table->boolean('cefalea')->nullable();
            $table->string('otros')->nullable();
            $table->boolean('otro')->nullable();

            $table->string('antecedentes_personales')->nullable();
            $table->string('recomendaciones')->nullable();

            $table->boolean('correc_optica')->nullable();
            //oido derecho
            $table->string('od_correccion_optica_uso')->nullable();
            $table->boolean('od_vision_lejos')->nullable();
            $table->boolean('od_vision_cerca')->nullable();
            $table->boolean('od_visiometria_ph')->nullable();

            //oido izquierdo
            $table->string('oi_correccion_optica_uso')->nullable();
            $table->boolean('oi_vision_lejos')->nullable();
            $table->boolean('oi_vision_cerca')->nullable();
            $table->boolean('oi_visiometria_ph')->nullable();


            $table->string('oftalmoscopia_od', 1)->nullable(); // N o A, Normal o Anormal
            $table->string('oftalmoscopia_od_observ')->nullable(); 
            $table->string('oftalmoscopia_oi', 1)->nullable(); // N o A, Normal o Anormal
            $table->string('oftalmoscopia_oi_observ')->nullable();

            $table->string('externo_od', 1)->nullable(); // N o A, Normal o Anormal
            $table->string('externo_od_observ')->nullable();
            $table->string('externo_oi', 1)->nullable(); // N o A, Normal o Anormal
            $table->string('externo_oi_observ')->nullable();

            $table->string('estereopsis', 1)->nullable(); // N o A, Normal o Anormal
            $table->string('estereopsis_observ')->nullable();
            $table->string('test_color', 1)->nullable(); // N o A, Normal o Anormal
            $table->string('test_color_observ')->nullable();

            $table->integer('paciente_id')->unsigned();
            
            $table->timestamps();
            $table->softDeletes();
        });


        Schema::create('sintomas_vision', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id');
            $table->integer('paciente_id')->unsigned();
            $table->string('nombre')->nullable();
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
        Schema::drop('sintomas_vision');
        Schema::drop('visiometria');
    }
}
