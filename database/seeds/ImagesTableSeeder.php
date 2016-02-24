<?php

use Illuminate\Database\Seeder;
use Image;
use DB;

class ImagesTableSeeder extends Seeder {

	public function run()
	{
		$this->command->info('Borrando imágenes existentes en la tabla ...');
		DB::table('images')->delete();

		// Las imágenes de usuario por defecto.
		$img = new Image;
		$img->id 		= 1;
		$img->nombre 	= 'default_male.jpg';
		$img->save();

		$img = new Image;
		$img->id 		= 2;
		$img->nombre	= 'default_female.jpg';
		$img->save();
		
		$this->command->info('Imágenes insertadas.');
		
		
	}

}