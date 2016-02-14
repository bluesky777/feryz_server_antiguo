<?php namespace App\Http\Controllers;

use Request;
use App\Models\Producto;

class ProductosController extends Controller {

	public function getAll()
	{
		return Producto::all();
	}

	public function postGuardar()
	{
		$pro = new Producto;
		$pro->nombre = Request::input('nombre');
		$pro->codigo = Request::input('codigo');
		$pro->save();

		return $pro;
	}


	public function putActualizar()
	{
		$pro = Producto::find(Request::input('id'));
		$pro->nombre = Request::input('nombre');
		$pro->codigo = Request::input('codigo');
		$pro->save();

		return $pro;
	}

	public function deleteDestroy($id)
	{
		$pro = Producto::findOrFail($id);
		$pro->delete();
		return $pro;
	}

}