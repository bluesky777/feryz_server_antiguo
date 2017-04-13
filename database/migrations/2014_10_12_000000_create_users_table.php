<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configuracion', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id');
            $table->string('nombre_empresa');
            $table->string('telefono')->nullable();
            $table->integer('logo_id')->unsigned()->nullable();
            $table->integer('ciudad_id')->unsigned();
            $table->string('direccion')->nullable();
            $table->integer('impuesto1')->nullable(); // Ivas
            $table->integer('impuesto2')->nullable();
            $table->integer('impuesto3')->nullable();
            $table->integer('utilidad1')->nullable(); // Posibles ganancias
            $table->integer('utilidad2')->nullable();
            $table->integer('utilidad3')->nullable();
            $table->integer('deci_entrada')->nullable()->default(0); // Cantidad de decimales en precio compra
            $table->integer('deci_salida')->nullable()->default(0); // Cantidad de decimales en precio venta
            $table->integer('deci_total')->nullable()->default(0); // Cantidad de decimales en Totales
            $table->timestamps();
        });

        Schema::create('users', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id');
            $table->string('nombres');
            $table->string('apellidos')->nullable();
            $table->string('sexo')->default('M');
            $table->string('username')->unique();
            $table->string('password', 60)->default('');
            $table->integer('imagen_id')->unsigned()->nullable();
            $table->string('tipo')->nullable(); // administrador, vendedor, tecnico
            $table->string('email')->nullable()->unique();
            $table->string('tipo_doc')->nullable()->default('Cédula');
            $table->integer('num_doc')->nullable();
            $table->integer('ciudad_doc')->unsigned()->nullable();
            $table->date('fecha_nac')->nullable();
            $table->integer('ciudad_nac')->unsigned()->nullable();
            $table->string('telefono1')->nullable();
            $table->string('telefono2')->nullable();
            $table->string('idioma')->nullable()->default('ES');
            $table->boolean('is_superuser')->default(false);
            $table->integer('created_by')->unsigned()->nullable();
            $table->integer('deleted_by')->unsigned()->nullable();
            $table->softDeletes();
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('images', function(Blueprint $table)
        {
            $table->engine = "InnoDB";
            $table->increments('id');
            $table->string('nombre'); 
            $table->integer('user_id')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->integer('deleted_by')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });


        // Relaciones: 
        Schema::table('users', function(Blueprint $table) {
            $table->foreign('imagen_id')->references('id')->on('images')->onDelete('cascade');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
        Schema::drop('users');
        Schema::drop('images');
        Schema::drop('configuracion');
    }
}
