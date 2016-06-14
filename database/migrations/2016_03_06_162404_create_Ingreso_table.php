<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIngresoTable extends Migration
{

    public function up()
    {
        Schema::create('pacientes', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id');
            $table->string('nombres'); 
            $table->string('apellidos');
            $table->string('sexo', 1)->default('M');
            $table->integer('image_id')->unsigned()->nullable();
            $table->integer('ciudad_actual_id')->unsigned()->nullable();
            $table->string('empresa_usuaria')->nullable();
            $table->string('empresa_temporal')->nullable();
            $table->string('actividad_economica')->nullable();
            $table->string('doc_tipo')->nullable();
            $table->integer('doc_identidad')->nullable();
            $table->string('direccion')->nullable();
            $table->string('telefono')->nullable();
            $table->string('telefono_contacto')->nullable();
            $table->date('fecha_nac')->nullable();
            $table->date('fecha_ingreso')->nullable();
            $table->integer('ciudad_nac_id')->unsigned()->nullable();
            $table->string('estado_civil')->nullable(); // Soltero, Casado, 
                                                        // Viudo, Divorciado, Comprometido, Unión libre
            $table->string('nivel_escolaridad')->nullable();
            $table->string('profesion')->nullable();
            $table->string('grupo_sanguineo')->nullable();
            $table->string('rh')->nullable();
            $table->string('eps')->nullable();
            $table->string('arp')->nullable();
            $table->string('afp')->nullable();
            $table->string('cargo')->nullable();
            $table->string('descripcion_cargo')->nullable();
            $table->string('motivo_consulta')->nullable();
            $table->string('antec_patologicos')->nullable();
            $table->string('antec_hospitalarios')->nullable();
            $table->string('antec_quirurgicos')->nullable();
            $table->string('antec_familiares')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });


        Schema::create('antec_laborales', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id');
            $table->string('empresa');
            $table->string('activ_economica')->nullable();
            $table->string('cargo')->nullable();
            $table->string('fact_riesgo')->nullable();
            $table->string('tiempo_exposicion')->nullable();
            $table->string('niv_exposicion')->nullable();
            $table->string('controles')->nullable();
            $table->string('epp')->nullable();
            $table->integer('paciente_id');
            $table->softDeletes();
            $table->timestamps();
        });


        Schema::create('accid_trabajo', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id');
            $table->date('fecha')->nullable();
            $table->string('diagnostico')->nullable();
            $table->string('arp')->nullable();
            $table->string('fact_riesgo')->nullable();
            $table->string('organo_afectado')->nullable();
            $table->string('agente')->nullable();
            $table->string('tipo_accidente')->nullable();
            $table->integer('severidad')->nullable();
            $table->string('secuelas')->nullable();
            $table->integer('paciente_id');
            $table->softDeletes();
            $table->timestamps();
        });


        Schema::create('enfermedades_prof', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id');
            $table->date('fecha')->nullable();
            $table->string('diagnostico')->nullable();
            $table->string('arp')->nullable();
            $table->string('fact_riesgo')->nullable();
            $table->string('organo_afectado')->nullable();
            $table->string('agente')->nullable();
            $table->string('tipo_accidente')->nullable();
            $table->integer('severidad')->nullable();
            $table->string('secuelas')->nullable();
            $table->integer('paciente_id');
            $table->softDeletes();
            $table->timestamps();
        });


        Schema::create('inmunizaciones', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id');
            $table->integer('vacuna_id');
            $table->boolean('d1')->default(false);
            $table->boolean('d2')->default(false);
            $table->boolean('d3')->default(false);
            $table->boolean('d4')->default(false);
            $table->boolean('d5')->default(false);
            $table->boolean('refuerzo')->default(false);
            $table->integer('paciente_id');
            $table->timestamps();
        });


        Schema::create('vacunas', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id');
            $table->string('vacuna');
            $table->softDeletes();
            $table->timestamps();
        });


        Schema::create('habitos', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id');
            $table->boolean('cigarrillo')->default(false);
            $table->string('cigarrillo_descripcion')->nullable();
            $table->boolean('alcohol')->default(false);
            $table->string('alcohol_descripcion')->nullable();
            $table->boolean('drogas')->default(false);
            $table->string('drogas_descripcion')->nullable();
            $table->boolean('dieta')->default(false);
            $table->string('dieta_descripcion')->nullable();
            $table->boolean('ejercicio')->default(false);
            $table->string('ejercicio_descripcion')->nullable();
            $table->integer('paciente_id');
            $table->softDeletes();
            $table->timestamps();
        });


        Schema::create('examen_fisico', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id');
            $table->integer('sign_vit_fr');
            $table->integer('sign_vit_ta');
            $table->integer('sign_vit_ta1');
            $table->integer('sign_vit_temp');
            $table->integer('sign_vit_fc');
            $table->integer('sign_vit_peso');
            $table->integer('sign_vit_talla');
            $table->integer('sign_vit_imc');
            $table->string('estado_general');
            $table->string('contitucion');
            $table->string('dominancia');
            $table->string('agudeza_visual');
            $table->string('ojo_derecho');
            $table->string('ojo_izquierdo');
            $table->string('cabeza_cuello');
            $table->string('organos_sentidos');
            $table->string('cardio_pulmonar');
            $table->string('abdomen');
            $table->string('genito_urinario');
            $table->string('columna_vertebral');
            $table->string('neurologico');
            $table->string('osteo_muscular');
            $table->string('extremidades');
            $table->string('piel_anexos');
            $table->string('examen_mental');
            $table->string('observaciones');
            $table->integer('paciente_id');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('examen_paraclinico', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id');
            $table->string('examen');
            $table->string('diagnostico');
            $table->integer('paciente_id');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('diagnosticos', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id');
            $table->string('diagnostico');
            $table->string('nivel_aptitud');
            $table->string('restricciones_temp_perm');
            $table->string('recomendaciones_diagnostico');
            $table->integer('paciente_id');
            $table->softDeletes();
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
        Schema::drop('diagnosticos');
        Schema::drop('examen_paraclinico');
        Schema::drop('examen_fisico');
        Schema::drop('habitos');
        Schema::drop('vacunas');
        Schema::drop('inmunizaciones');
        Schema::drop('enfermedades_prof');
        Schema::drop('accid_trabajo');
        Schema::drop('antec_laborales');
        Schema::drop('pacientes');
    }
}
