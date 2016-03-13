<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExamenIngresosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exameningresos', function (Blueprint $table) {
           
            $table->increments('id');
            $table->string('departamento');
            $table->string('ciudad');
            $table->date('fecha');
            $table->string('empresa_usuaria');
            $table->string('empresa_temporal')->nullable();
            $table->string('actividad_economica');
            $table->string('nombres'); // Código de la imagen que tiene la firma
            $table->string('apellidos');
            $table->integer('documento_identidad');
            $table->string('genero');
            $table->string('direccion');
            $table->integer('telefono')->nullable();
            $table->string('telefono_contacto');
            $table->date('fecha_nacimiento');
            $table->string('lugar');
            $table->string('estado_civil');
            $table->string('nivel_escolaridad')->nullable();
            $table->string('edad');
            $table->string('profesion');
            $table->string('grupo_sanguineo');
            $table->string('rh');
            $table->string('eps');
            $table->string('arp');
            $table->string('afp');
            $table->date('fecha_ingreso');
            $table->string('cargo');
            $table->string('descripcion_cargo');
            $table->string('motivo_consulta');
            $table->string('antec_patologicos');
            $table->string('antec_hospitalarios');
            $table->string('antec_quirurgicos');
            $table->string('antec_familiares');
            $table->softDeletes();
            $table->rememberToken();
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
        //
    }
}
