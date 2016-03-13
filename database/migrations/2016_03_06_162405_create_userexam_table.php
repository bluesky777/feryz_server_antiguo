<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserexamTable extends Migration
{

    public function up()
    {
        Schema::create('examenes', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id');
            $table->string('tipo')->nullable(); // Para definir qué tipo de usuario puede hacer este examen.
            $table->boolean('nombres')->default(false); 
            $table->boolean('apellidos')->default(false); 
            $table->boolean('ciudad')->default(false); 
            $table->boolean('empresa_usuaria')->default(false); 
            $table->boolean('empresa_temporal')->default(false); 
            $table->boolean('actividad_economica')->default(false); 
            $table->boolean('doc_tipo')->default(false); 
            $table->boolean('doc_identidad')->default(false); 
            $table->boolean('sexo')->default(false); 
            $table->boolean('direccion')->default(false); 
            $table->boolean('telefono')->default(false); 
            $table->boolean('telefono_contacto')->default(false); 
            $table->boolean('fecha_nac')->default(false); 
            $table->boolean('estado_civil')->default(false); 
            $table->boolean('nivel_escolaridad')->default(false); 
            $table->boolean('edad');
            $table->boolean('profesion');
            $table->boolean('grupo_sanguineo');
            $table->boolean('rh');
            $table->boolean('eps');
            $table->boolean('arp');
            $table->boolean('afp');
            $table->boolean('cargo');
            $table->boolean('descripcion_cargo');
            $table->boolean('motivo_consulta');
            $table->boolean('antec_patologicos');
            $table->boolean('antec_hospitalarios');
            $table->boolean('antec_quirurgicos');
            $table->boolean('antec_familiares');

            $table->boolean('empresa');
            $table->boolean('activ_economica')->nullable();
            $table->boolean('fact_riesgo');
            $table->boolean('tiemp_exposicion');
            $table->boolean('niv_exposicion');
            $table->boolean('controles');
            $table->boolean('epp');

            
            $table->timestamps();
        });

        Schema::create('user_exam', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('examen_id')->unsigned();
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
        Schema::drop('user_exam');
        Schema::drop('examenes');
    }
}
