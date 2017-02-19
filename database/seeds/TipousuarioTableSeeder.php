<?php
use Illuminate\Database\Seeder;
use App\Models\TipoUsuario;

class TipousuarioTableSeeder extends Seeder {

	public function run()
	{
		Eloquent::unguard();
		// Borramos todas las cuidades
		DB::table('tipo_usuario')->delete();

		TipoUsuario::create([
			'id' => '1',
			'titulo' => 'Administrador',
		]);
		TipoUsuario::create([
			'id' => '2',
			'titulo' => 'Tendero',
		]);
		$this->command->info("Tipos ingresados.");
	}

}