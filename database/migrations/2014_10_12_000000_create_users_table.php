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
            $table->string('nombre_ips');
            $table->string('telefono')->nullable();
            $table->integer('logo_id')->unsigned()->nullable();
            $table->integer('ciudad_id')->unsigned();
            $table->timestamps();
        });

        Schema::create('users', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id');
            $table->string('nombres');
            $table->string('apellidos')->nullable();
            $table->string('sexo')->default('M');
            $table->string('username')->unique();
            $table->integer('image_id')->unsigned()->nullable();
            $table->integer('tipo_usu_id')->unsigned()->nullable();
            $table->string('password', 60)->default('');
            $table->string('email')->nullable()->unique();$table->integer('firma_id')->nullable(); // Código de la imagen que tiene la firma
            $table->integer('tipo_doc')->unsigned()->nullable();
            $table->integer('num_doc')->nullable();
            $table->integer('ciudad_doc')->unsigned()->nullable();
            $table->date('fecha_nac')->nullable();
            $table->integer('ciudad_nac')->unsigned()->nullable();
            $table->string('titulo')->nullable();
            $table->string('estado_civil')->nullable();
            $table->string('barrio')->nullable();
            $table->string('direccion')->nullable();
            $table->string('telefono')->nullable();
            $table->string('celular')->nullable();
            $table->string('facebook')->nullable()->unique();
            $table->boolean('is_superuser')->default(false);
            $table->integer('imagen_id')->unsigned()->nullable();
            $table->integer('deleted_by')->unsigned()->nullable();
            $table->softDeletes();
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('tipo_usuario', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id');
            $table->string('titulo')->nullable(); // Optómetra, Fonoaudiólogo, Fisioterapeuta, Psicólogo, Bacteriólogo, Recepcionista

            $table->timestamps();
        });


        Schema::create('images', function(Blueprint $table)
        {
            $table->engine = "InnoDB";
            $table->increments('id');
            $table->string('nombre'); // Si no es pública, este nombre indica una imagen dentro de la carpeta del usuario.
            $table->integer('user_id')->nullable();
            $table->boolean('publica')->nullable(); // Esto indica que la imagen no se buscará en la carpeta del usuario, sino en la carpeta del colegio.
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->integer('deleted_by')->nullable();
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
        
        Schema::drop('images');
        Schema::drop('users');
        Schema::drop('configuracion');
    }
}
