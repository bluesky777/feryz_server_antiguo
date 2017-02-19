<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductosTable extends Migration
{

    public function up()
    {

        Schema::create('categorias', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id');
            $table->string('nombre');
            $table->softDeletes();
            $table->timestamps();
        });


        Schema::create('productos', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id');
            $table->string('nombre'); 
            $table->string('unidad_medida')->nullable()->default('-');
            $table->integer('categoria_id')->unsigned()->nullable();
            $table->integer('precio_compra')->nullable();
            $table->integer('precio_venta')->nullable();
            $table->integer('cantidad')->nullable();
            $table->string('nota')->nullable();
            $table->integer('created_by')->unsigned()->nullable(); 
            $table->integer('updated_by')->unsigned()->nullable(); 
            $table->integer('deleted_by')->unsigned()->nullable(); 
            $table->softDeletes();
            $table->timestamps();
        });


        // Relaciones:
        Schema::table('productos', function(Blueprint $table) {
            $table->foreign('categoria_id')->references('id')->on('categorias')->onDelete('cascade');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('deleted_by')->references('id')->on('users')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('productos');
        Schema::drop('categorias');
    }
}
