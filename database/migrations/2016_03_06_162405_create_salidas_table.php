<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalidasTable extends Migration
{

    public function up()
    {
        Schema::create('salidas', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id');
            $table->date('fecha')->nullable(); 
            $table->string('tipo', 100);
            $table->integer('cliente_id')->unsigned()->nullable();
            $table->integer('inventario_id')->unsigned()->nullable();
            $table->boolean('cancelada')->default(false);
            $table->integer('created_by')->unsigned()->nullable();
            $table->integer('updated_by')->unsigned()->nullable();
            $table->integer('deleted_by')->unsigned()->nullable();
            $table->softDeletes();
            $table->timestamps();
        });


        Schema::create('salidas_detalles', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id');
            $table->integer('salida_id')->unsigned();
            $table->integer('producto_id')->unsigned();
            $table->integer('cantidad');
            $table->double('precio_costo', 11, 3);
            $table->double('precio_venta', 11, 3)->nullable();
            $table->integer('total')->nullable();
            $table->timestamps();
        });



        // Relaciones:
        Schema::table('salidas', function(Blueprint $table) {
            $table->foreign('cliente_id')->references('id')->on('clientes')->onDelete('cascade');
            $table->foreign('inventario_id')->references('id')->on('inventarios')->onDelete('cascade');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('deleted_by')->references('id')->on('users')->onDelete('cascade');
        });
        Schema::table('salidas_detalles', function(Blueprint $table) {
            $table->foreign('salida_id')->references('id')->on('salidas')->onDelete('cascade');
            $table->foreign('producto_id')->references('id')->on('productos')->onDelete('cascade');
        });

    }


    public function down()
    {
        Schema::drop('salidas_detalles');
        Schema::drop('salidas');
    }
}
