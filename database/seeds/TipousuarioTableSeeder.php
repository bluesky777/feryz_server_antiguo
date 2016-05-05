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
			'titulo' => 'Optómetra',
		]);
		TipoUsuario::create([
			'id' => '2',
			'titulo' => 'Fonoaudiólogo',
		]);
		TipoUsuario::create([
			'id' => '3',
			'titulo' => 'Fisioterapeuta',
		]);
		TipoUsuario::create([
			'id' => '4',
			'titulo' => 'Psicólogo',
		]);
		TipoUsuario::create([
			'id' => '5',
			'titulo' => 'Bacteriólogo',
		]);
		TipoUsuario::create([
			'id' => '6',
			'titulo' => 'Recepcionista',
		]);
		TipoUsuario::create([
			'id' => '7',
			'titulo' => 'Médico',
		]);
		$this->command->info("Tipos ingresados.");
	}

}