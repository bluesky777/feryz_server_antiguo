<?php

use Illuminate\Database\Seeder;
use App\Models\Vacuna;

class VacunasTableSeeder extends Seeder {

	public function run()
	{
		Eloquent::unguard();
		// Borramos todas las cuidades
		DB::table('vacunas')->delete();

		Vacuna::create([
			'id' => '1',
			'vacuna' => 'HEPATITIS B'
		]);
		Vacuna::create([
			'id' => '2',
			'vacuna' => 'TOXOIDE TETANICO'
		]);
		Vacuna::create([
			'id' => '3',
			'vacuna' => 'FIEBRE AMARILLA'
		]);
		$this->command->info("Tres vacunas ingresadas.");
	}

}