<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVentasTable extends Migration
{

    public function up()
    {
        Schema::create('ventas', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id');
            $table->date('fecha')->nullable(); 
            $table->integer('cliente_id')->unsigned()->nullable();
            $table->integer('total_monto')->nullable();
            $table->integer('created_by')->unsigned()->nullable();
            $table->integer('updated_by')->unsigned()->nullable();
            $table->integer('deleted_by')->unsigned()->nullable();
            $table->softDeletes();
            $table->timestamps();
        });


        Schema::create('ventas_detalles', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id');
            $table->integer('producto_id')->unsigned();
            $table->integer('cantidad');
            $table->integer('precio_compra');
            $table->integer('precio_venta')->nullable();
            $table->integer('total')->nullable();
            $table->timestamps();
        });



        // Relaciones:
        Schema::table('ventas', function(Blueprint $table) {
            $table->foreign('cliente_id')->references('id')->on('clientes')->onDelete('cascade');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('deleted_by')->references('id')->on('users')->onDelete('cascade');
        });
        Schema::table('ventas_detalles', function(Blueprint $table) {
            $table->foreign('producto_id')->references('id')->on('productos')->onDelete('cascade');
        });

    }


    public function down()
    {
        Schema::drop('ventas_detalles');
        Schema::drop('ventas');
    }
}
