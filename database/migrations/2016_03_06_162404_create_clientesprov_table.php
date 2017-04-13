<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientesprovTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('inventarios', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id');
            $table->date('fecha');
            $table->boolean('actual')->default(false);
            $table->string('descripcion')->nullable(); 
            $table->integer('created_by')->unsigned()->nullable(); 
            $table->integer('updated_by')->unsigned()->nullable(); 
            $table->integer('deleted_by')->unsigned()->nullable(); 
            $table->timestamps();
            $table->softDeletes();
        });


        Schema::create('clientes', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id');
            $table->string('nombre');
            $table->string('direccion')->nullable(); 
            $table->integer('ciudad_id')->unsigned()->nullable();
            $table->string('persona_contacto')->nullable();
            $table->string('email')->nullable(); 
            $table->integer('telefono1')->nullable();
            $table->integer('telefono2')->nullable();
            $table->string('nota')->nullable();
            $table->integer('balance')->nullable();
            $table->integer('created_by')->unsigned()->nullable(); 
            $table->integer('updated_by')->unsigned()->nullable(); 
            $table->integer('deleted_by')->unsigned()->nullable(); 
            $table->timestamps();
            $table->softDeletes();
        });


        Schema::create('proveedores', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id');
            $table->string('nombre');
            $table->string('direccion')->nullable(); 
            $table->integer('ciudad_id')->unsigned()->nullable();
            $table->string('persona_contacto')->nullable();
            $table->string('email')->nullable(); 
            $table->integer('telefono1')->nullable();
            $table->integer('telefono2')->nullable();
            $table->string('nota')->nullable();
            $table->integer('balance')->nullable();
            $table->integer('created_by')->unsigned()->nullable(); 
            $table->integer('updated_by')->unsigned()->nullable(); 
            $table->integer('deleted_by')->unsigned()->nullable(); 
            $table->timestamps();
            $table->softDeletes();
        });



        // Relaciones
        Schema::table('inventarios', function(Blueprint $table) {
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('deleted_by')->references('id')->on('users')->onDelete('cascade');
        });
        Schema::table('clientes', function(Blueprint $table) {
            $table->foreign('ciudad_id')->references('id')->on('ciudades')->onDelete('cascade');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('deleted_by')->references('id')->on('users')->onDelete('cascade');
        });
        Schema::table('proveedores', function(Blueprint $table) {
            $table->foreign('ciudad_id')->references('id')->on('ciudades')->onDelete('cascade');
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
        Schema::drop('proveedores');
        Schema::drop('clientes');
        Schema::drop('inventarios');
    }
}
