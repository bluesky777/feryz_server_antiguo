<?php namespace App\Http\Controllers;

use Request;
use Hash;
use App\Models\User;
use App\Models\Categoria;


class CategoriasController extends Controller {

	public function getAll()
	{
		return Categoria::all();
	}

	public function postGuardar()
	{
		$user = User::fromToken();

		$categ = new Categoria;

		$categ->nombre 		= Request::input('nombre');
		$categ->save();

		return $categ;
	}


	public function putActualizar()
	{
		$user = User::fromToken();

		$categ = Categoria::find(Request::input('id'));

		$categ->nombre 		= Request::input('nombre');
		$categ->save();

		return 'Cambiado';
	}



	public function deleteDestroy($id)
	{
		$categ = Categoria::findOrFail($id);
		$categ->delete();
		return $categ;
	}

}