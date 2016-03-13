<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePulmonarTable extends Migration
{

    public function up()
    {
        Schema::create('pulmonar', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id');
            
            $table->integer('paciente_id')->unsigned();
            $table->softDeletes();
            $table->timestamps();
        });


    }


    public function down()
    {
        Schema::drop('pulmonar');
    }
}
