<?php
use Illuminate\Database\Seeder;
use App\Models\Configuracion;

class ConfiguracionTableSeeder extends Seeder {

	public function run()
	{
		Eloquent::unguard();
		// Borramos todas las cuidades
		DB::table('configuracion')->delete();

		Configuracion::create([
			'id' => '1',
			'nombre_empresa' => 'Edilson Feryz',
			'telefono' => '235234523',
		]);

		$this->command->info("Configuración agregada.");
	}

}