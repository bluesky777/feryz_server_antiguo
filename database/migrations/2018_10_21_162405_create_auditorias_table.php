<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuditoriasTable extends Migration
{

    public function up()
    {
        Schema::create('au_users', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id');
            $table->string('nombres'); 
            $table->string('apellidos');
            $table->string('email')->nullable(); // ->unique()
            $table->string('sexo')->nullable();
            $table->date('fecha')->nullable(); // fecha nac
            $table->string('tipo');
            $table->boolean('is_active')->default(true);
            $table->integer('distrito_id')->nullable();
            $table->integer('iglesia_id')->nullable();
            $table->integer('auditoria_id')->nullable();
            $table->string('celular')->nullable();
            $table->string('usuario');
            $table->string('password')->nullable();
            $table->timestamps();
        });

        
        Schema::create('au_uniones', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id');
            $table->string('nombre'); 
            $table->string('alias')->nullable();
            $table->string('codigo')->nullable();
            $table->integer('presidente')->nullable();
            $table->string('pais')->nullable();
            $table->integer('division_id')->nullable();
            $table->timestamps();
        });

        
        Schema::create('au_asociaciones', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id');
            $table->string('nombre'); 
            $table->string('alias')->nullable();
            $table->string('codigo')->nullable();
            $table->string('zona')->nullable();
            $table->integer('union_id')->nullable();
            $table->integer('tesorero_id')->nullable();
            $table->timestamps();
        });

        
        Schema::create('au_distritos', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id');
            $table->string('nombre'); 
            $table->string('alias')->nullable();
            $table->string('codigo')->nullable();
            $table->string('zona')->nullable();
            $table->integer('asociacion_id')->nullable();
            $table->integer('pastor_id')->nullable();
            $table->integer('tesorero_id')->nullable(); // Tesorero del distrito
            $table->timestamps();
        });



        Schema::create('au_iglesias', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id');
            $table->string('nombre'); 
            $table->string('alias')->nullable();
            $table->string('codigo')->nullable();
            $table->integer('distrito_id')->nullable();
            $table->string('tipo')->nullable()->defaul('IGLESIA'); // IGLESIA O GRUPO
            $table->string('zona')->nullable();
            
            $table->string('tipo_propiedad')->nullable();
            $table->string('anombre_propiedad')->nullable();
            $table->date('fecha_propiedad')->nullable();
            $table->date('fecha_fin')->nullable();
            
            $table->string('tipo_propiedad2')->nullable();
            $table->string('anombre_propiedad2')->nullable();
            $table->date('fecha_propiedad2')->nullable();
            $table->date('fecha_fin2')->nullable();
            
            $table->string('tipo_propiedad3')->nullable();
            $table->string('anombre_propiedad3')->nullable();
            $table->date('fecha_propiedad3')->nullable();
            $table->date('fecha_fin3')->nullable();
            
            $table->integer('tesorero_id')->nullable();
            $table->integer('secretario_id')->nullable();
            
            $table->timestamps();
        });


        Schema::create('au_auditorias', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id');
            $table->date('fecha')->nullable();
            $table->string('hora')->nullable();
            $table->integer('saldo_ant')->nullable();
            $table->integer('ingre_por_registrar')->nullable();
            $table->integer('ingre_sabados')->nullable();
            $table->integer('cta_por_pagar')->nullable();
            $table->integer('ajuste_por_enviar')->nullable();
            $table->integer('saldo_banco')->nullable();
            $table->integer('consig_fondos_confia')->nullable();
            $table->integer('gastos_mes_por_regis')->nullable();
            $table->integer('dinero_efectivo')->nullable();
            $table->integer('cta_por_cobrar')->nullable();
            $table->integer('iglesia_id')->nullable();
            $table->timestamps();
        });


        Schema::create('au_lib_mensuales', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id');
            $table->integer('year')->nullable();
            $table->string('mes')->nullable();
            $table->integer('orden')->nullable();
            $table->integer('auditoria_id')->nullable();
            $table->integer('diezmos')->nullable()->defaul(0);
            $table->integer('ofrendas')->nullable()->defaul(0);
            $table->integer('especiales')->nullable()->defaul(0);
            $table->integer('gastos')->nullable()->defaul(0);
            $table->integer('gastos_soportados')->nullable()->defaul(0);
            $table->integer('remesa_enviada')->nullable()->defaul(0);
            $table->timestamps();
        });

        // Dinero recogido en los 5 o 4 sábados del mes. Puede especificar por sábado o por total
        Schema::create('au_lib_semanales', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id');
            $table->integer('libro_mes_id');
            $table->integer('diezmo_1')->nullable()->defaul(0); // Diezmos recogidos el primer sábado del mes
            $table->integer('ofrenda_1')->nullable()->defaul(0); // Ofrendas recogidas el primer sábado del mes
            $table->integer('especial_1')->nullable()->defaul(0); // Ofrendas especiales recogidas el primer sábado del mes
            $table->integer('diezmo_2')->nullable()->defaul(0); // Diezmos recogidos el SEGUNDO sábado del mes
            $table->integer('ofrenda_2')->nullable()->defaul(0);
            $table->integer('especial_2')->nullable()->defaul(0);
            $table->integer('diezmo_3')->nullable()->defaul(0); // Diezmos recogidos el TERCERO sábado del mes
            $table->integer('ofrenda_3')->nullable()->defaul(0);
            $table->integer('especial_3')->nullable()->defaul(0);
            $table->integer('diezmo_4')->nullable()->defaul(0); // Diezmos recogidos el CUARTO sábado del mes
            $table->integer('ofrenda_4')->nullable()->defaul(0);
            $table->integer('especial_4')->nullable()->defaul(0);
            $table->integer('diezmo_5')->nullable()->defaul(0); // Diezmos recogidos el QUINTO sábado del mes
            $table->integer('ofrenda_5')->nullable()->defaul(0);
            $table->integer('especial_5')->nullable()->defaul(0); 
            $table->integer('diaconos_1')->nullable()->defaul(0); // Suma del libro de diáconos por sábado
            $table->integer('diaconos_2')->nullable()->defaul(0);
            $table->integer('diaconos_3')->nullable()->defaul(0);
            $table->integer('diaconos_4')->nullable()->defaul(0);
            $table->integer('diaconos_5')->nullable()->defaul(0);
            $table->integer('total_diezmos')->nullable()->defaul(0); // Diezmos recogidos del mes, no por sábados
            $table->integer('total_ofrendas')->nullable()->defaul(0); // Ofrendas recogidas del mes, no por sábados
            $table->integer('total_especiales')->nullable()->defaul(0); // Ofrendas especiales recogidas del mes, no por sábados
            $table->integer('por_total')->nullable()->defaul(0); // 0 o 1. Si es por total, se ignoran los valores de los 5 sábados
            $table->timestamps();
        });

        // Obligaciones fijas que tiene la iglesia mensuales
        Schema::create('au_destinos', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id');
            $table->integer('iglesia_id');
            $table->string('nombre');
            $table->string('descripcion')->nullable();
            $table->timestamps();
        });

        // Pagos que ha hecho la iglesia en ese mes en los destinos fijos
        Schema::create('au_destinos_pagos', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id');
            $table->integer('destino_id');
            $table->integer('libro_mes_id');
            $table->integer('pago');
            $table->date('fecha')->nullable();
            $table->date('descripcion')->nullable();
            $table->timestamps();
        });

        // Gastos registrados. Tiene que coincidir con los gastos que tienen soporte en soportes_mes
        Schema::create('au_gastos_mes', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id');
            $table->integer('libro_mes_id')->nullable();
            $table->integer('auditoria_id')->nullable();
            $table->integer('valor');
            $table->date('descripcion')->nullable();
            $table->timestamps();
        });

        Schema::create('au_dinero_efectivo', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id');
            $table->integer('auditoria_id')->nullable();
            $table->integer('valor');
            $table->date('descripcion')->nullable();
            $table->timestamps();
        });

        
        Schema::create('au_preguntas', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id');
            $table->string('definition');
            $table->string('tipo')->nullable();
            $table->string('option1')->nullable();
            $table->string('option2')->nullable();
            $table->string('option3')->nullable();
            $table->string('option4')->nullable();
            $table->timestamps();
        });
        
        Schema::create('au_respuestas', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id');
            $table->integer('pregunta_id');
            $table->integer('auditoria_id')->nullable();
            $table->string('respuestas')->nullable();
            $table->timestamps();
        });
        
        
        Schema::create('au_recomendaciones', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id');
            $table->integer('auditoria_id');
            $table->text('hallazgo')->nullable();
            $table->text('recomendacion')->nullable();
            $table->text('justificacion')->nullable();
            $table->boolean('superada')->default(0);
            $table->string('fecha')->nullable();
            $table->string('tipo')->nullable();
            $table->timestamps();
        });

    }


    public function down()
    {
        Schema::drop('au_dinero_efectivo');
        Schema::drop('au_recomendaciones');
        Schema::drop('au_respuestas');
        Schema::drop('au_preguntas');
        Schema::drop('au_gastos_mes');
        Schema::drop('au_destinos_pagos');
        Schema::drop('au_destinos');
        Schema::drop('au_lib_semanales');
        Schema::drop('au_lib_mensuales');
        Schema::drop('au_auditorias');
        Schema::drop('au_iglesias');
        Schema::drop('au_distritos');
        Schema::drop('au_asociaciones');
        Schema::drop('au_uniones');
        Schema::drop('au_users');
    }
}
