<?php namespace App\Http\Controllers;

use Request;
use App\Models\Pais;

class PaisesController extends Controller {

	public function getAll()
	{
		return Pais::all();
	}

	public function postGuardar()
	{
		$pro = new Pais;
		$pro->nombre = Request::input('nombre');
		$pro->codigo = Request::input('codigo');
		$pro->save();

		return $pro;
	}


	public function putActualizar()
	{
		$pro = Pais::find(Request::input('id'));
		$pro->nombre = Request::input('nombre');
		$pro->codigo = Request::input('codigo');
		$pro->save();

		return $pro;
	}

	public function deleteDestroy($id)
	{
		$pro = Pais::findOrFail($id);
		$pro->delete();
		return $pro;
	}

}