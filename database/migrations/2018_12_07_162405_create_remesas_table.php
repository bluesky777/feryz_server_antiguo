<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRemesasTable extends Migration
{

    public function up()
    {
        Schema::create('au_remesas', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id');
            $table->integer('num_diario')->nullable();
            $table->integer('linea')->nullable();
            $table->string('tipo_diario')->nullable(); 
            $table->string('num_secuencia')->nullable();
            $table->string('periodo'); // 2018/009
            $table->date('fecha')->nullable();
            $table->string('referencia')->nullable();
            $table->integer('cod_cuenta')->nullable();
            $table->string('nombre_cuenta')->nullable();
            $table->string('descripcion_transaccion')->nullable();
            $table->integer('cantidad')->nullable();
            $table->integer('iva')->nullable();
            $table->string('moneda')->nullable(); // COP1
            $table->string('recurso')->nullable();
            $table->string('funcion')->nullable();
            $table->string('restr')->nullable(); // ni idea
            $table->string('org_id')->nullable(); // ni idea
            $table->integer('empleados')->nullable();
            $table->string('concepto')->nullable();
            $table->timestamps();
        });

        



    }


    public function down()
    {
        
        Schema::drop('au_remesas');
    }
}
