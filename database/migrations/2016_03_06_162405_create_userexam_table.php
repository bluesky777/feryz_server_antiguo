<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserexamTable extends Migration
{

    public function up()
    {
        Schema::create('examenes', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id');
            $table->string('tipo')->nullable(); // Para definir qué tipo de usuario puede hacer este examen.
            $table->boolean('basicos')->default(false);
            $table->boolean('visiometria')->default(false);
            $table->boolean('ant_auditivos')->default(false);
            $table->boolean('pulmonar')->default(false);

            $table->timestamps();
        });

        Schema::create('user_exam', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('examen_id')->unsigned();
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
        Schema::drop('user_exam');
        Schema::drop('examenes');
    }
}
