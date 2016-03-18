<?php namespace App\Http\Controllers;

use Request;
use App\Models\Paciente;

class PacientesController extends Controller {

	public function getAll()
	{
		return Paciente::all();
	}

	public function postGuardar()
	{
		$pro = new Paciente;
		$pro->nombre = Request::input('nombre');
		$pro->codigo = Request::input('codigo');
		$pro->save();

		return $pro;
	}


	public function putActualizar()
	{
		$pro = Paciente::find(Request::input('id'));
		$pro->nombre = Request::input('nombre');
		$pro->codigo = Request::input('codigo');
		$pro->save();

		return $pro;
	}

	public function deleteDestroy($id)
	{
		$pro = Paciente::findOrFail($id);
		$pro->delete();
		return $pro;
	}

}