<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetinventarioTable extends Migration
{

    public function up()
    {
        Schema::create('inventarios_detalles', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id');
            $table->integer('inventario_id')->unsigned()->nullable();
            $table->integer('producto_id')->unsigned()->nullable();
            $table->double('precio_costo', 11, 3)->nullable();
            $table->double('precio_venta', 11, 3)->nullable();
            $table->integer('cantidad')->default(0);
            $table->integer('updated_by')->unsigned()->nullable(); 
            $table->softDeletes();
            $table->timestamps();
        });



        // Relaciones:
        Schema::table('inventarios_detalles', function(Blueprint $table) {
            $table->foreign('inventario_id')->references('id')->on('inventarios')->onDelete('cascade');
            $table->foreign('producto_id')->references('id')->on('productos')->onDelete('cascade');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade');
        });

    }


    public function down()
    {
        Schema::drop('inventarios_detalles');
    }
}
