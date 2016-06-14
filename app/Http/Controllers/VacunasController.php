<?php namespace App\Http\Controllers;

use Request;
use App\Models\Vacuna;

class VacunasController extends Controller {

	public function putPaciente()
	{
		return Vacuna::all();
	}

	public function postGuardar()
	{
		$vac = new Vacuna;
		$vac->vacuna 			= Request::input('vacuna');
		$vac->save();

		return $vac;
	}


	public function putActualizar()
	{
		$vac = Vacuna::find(Request::input('id'));
		$vac->vacuna 			= Request::input('vacuna');
		$vac->save();

		return $vac;
	}

	public function deleteDestroy($id)
	{
		$vac = Vacuna::findOrFail($id);
		$vac->delete();
		return $vac;
	}

}