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
		$pais = new Pais;
		$pais->pais = Request::input('paisnuevo');
		$pais->abrev = Request::input('abrev');
		$pais->save();

		return $pais;
	}


	public function putActualizar()
	{
		$pais = Pais::find(Request::input('id'));
		$pais->pais = Request::input('pais');
		$pais->abrev = Request::input('abrev');
		$pais->save();

		return $pais;
	}

	public function deleteDestroy($id)
	{
		$pro = Pais::findOrFail($id);
		$pro->delete();
		return $pro;
	}

}