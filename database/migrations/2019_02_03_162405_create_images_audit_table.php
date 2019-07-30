<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImagesAuditTable extends Migration
{

    public function up()
    {
        Schema::create('au_images', function(Blueprint $table)
		{
			$table->engine = "InnoDB";
			$table->increments('id');
			$table->string('nombre'); 
			$table->integer('user_id')->nullable();
            $table->text('descripcion')->nullable();
            $table->date('fecha_documento')->nullable();
			$table->integer('iglesia_id')->nullable(); // Si es un documento, aquí el cod de la iglesia
            $table->integer('asociacion_id')->nullable();
            $table->integer('union_id')->nullable();
            $table->integer('created_by')->nullable();
			$table->integer('updated_by')->nullable();
			$table->integer('deleted_by')->nullable();
			$table->softDeletes();
			$table->timestamps();
		});

        
        Schema::table('au_auditorias', function ($table) {
            $table->boolean('cerrada')->default(0); // Indica que ya terminó esta auditoría. Se puede volver a abrir
            $table->dateTime('cerrada_fecha')->nullable();
            $table->text('saldo_ant_descripcion')->nullable();
            $table->integer('saldo_final')->nullable()->default(0);
        });




    }


    public function down()
    {
        Schema::dropIfExists('au_images');
        /*
        Schema::table('au_auditorias', function($table)
        {
            $table->dropColumn(['cerrada', 'cerrada_fecha', 'saldo_ant_descripcion', 'saldo_final']);
        });
        */
    }
}
