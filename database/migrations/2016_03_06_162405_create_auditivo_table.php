<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuditivoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('antec_auditivos', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id');
            // Otológicos
            $table->boolean('otalgia')->nullable(); 
            $table->boolean('otitis')->nullable();
            $table->boolean('sensacion_oido_tapado')->nullable();
            $table->boolean('tinitus')->nullable();
            $table->boolean('vertigo')->nullable();
            $table->boolean('prurito')->nullable();
            // Traumáticos
            $table->boolean('trauma_craneoencefalico')->nullable();
            $table->boolean('trauma_acustico')->nullable();
            $table->boolean('cirugia_oido')->nullable();
            $table->boolean('timpanoplastia')->nullable();
            // Patológicos
            $table->boolean('hipertension_arterial')->nullable();
            $table->boolean('diabetes')->nullable();
            $table->boolean('rinitis')->nullable(); // Rinitis / Sinusitis
            // Hereditarias
            $table->boolean('fam_prom_auditivos')->nullable();
            $table->boolean('exposicion_al_ruido')->nullable();

            $table->string('diagnostico')->nullable();

            $table->integer('paciente_id')->unsigned();
            $table->softDeletes();
            $table->timestamps();
        });


        Schema::create('otoscopia', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id');
            $table->boolean('pabellon_auricular_der')->nullable(); 
            $table->boolean('pabellon_auricular_izq')->nullable(); 
            $table->boolean('cae_der')->nullable(); 
            $table->boolean('cae_izq')->nullable(); 
            $table->boolean('membrana_timpanica_der')->nullable(); 
            $table->boolean('membrana_timpanica_izq')->nullable(); 
            
            $table->integer('paciente_id')->unsigned();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('audiometria', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id');
            $table->integer('int0')->nullable(); 
            $table->integer('int10')->nullable(); 
            $table->integer('int20')->nullable(); 
            $table->integer('int30')->nullable(); 
            $table->integer('int40')->nullable(); 
            $table->integer('int50')->nullable(); 
            $table->integer('int60')->nullable(); 
            $table->integer('int70')->nullable(); 
            $table->integer('int80')->nullable(); 
            $table->integer('int90')->nullable(); 
            $table->integer('int100')->nullable(); 
            $table->integer('int110')->nullable(); 
            $table->integer('int120')->nullable(); 
            
            $table->integer('paciente_id')->unsigned();
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
        Schema::drop('audiometria');
        Schema::drop('otoscopia');
        Schema::drop('antec_auditivos');
    }
}
