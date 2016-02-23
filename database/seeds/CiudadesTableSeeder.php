<?php
use Illuminate\Database\Seeder;


class CiudadesTableSeeder extends Seeder {

	public function run()
	{

		Eloquent::unguard();

		// Insertarlas manualmente desde el archivo.

		/* No está funcionando por las Ñ (eñes) creo.*/
		
		Eloquent::unguard();

		// Borramos todas las cuidades
		DB::table('ciudades')->delete();

		
		// Insertamos los más de 4 mil registros separados de a mil en varios archivos.
		$this->command->info("Vamos a insertar las ciudades...");
		$sql = file_get_contents(dirname(__FILE__) .'/sql/ciudades_colombia.sql');
		DB::statement($sql);
		


	}


	public function clean()
	{
		DB::table('ciudades')->delete();
	}

}