<?php namespace App\Http\Controllers;

use Request;
use Hash;
use App\Models\User;
use App\Models\Cliente;

use DB;

class ClientesController extends Controller {

	public function getAll()
	{
		return Cliente::all();
	}

	public function postGuardar()
	{
		$user = User::fromToken();

		$clie = new Cliente;

		$clie->nombre 		= Request::input('nombre');
		$clie->direccion 	= Request::input('direccion');
		$clie->ciudad_id 	= Request::input('ciudad_id')['id'];
		$clie->persona_contacto = Request::input('persona_contacto');
		$clie->email 		= Request::input('email');
		$clie->telefono1 	= Request::input('telefono1');
		$clie->telefono2 	= Request::input('telefono2');
		$clie->nota 		= Request::input('nota');
		$clie->balance 		= Request::input('balance');
		$clie->created_by 	= $user['id'];
		$clie->save();

		return $clie;
	}


	public function putActualizar()
	{
		$user = User::fromToken();

		$clie = Cliente::find(Request::input('id'));

		if (is_array(Request::input('ciudad'))) {
			Request::merge(['ciudad' => Request::input('ciudad')['id']]);
		} 

		$clie->nombre 		= Request::input('nombre');
		$clie->direccion 	= Request::input('direccion');
		$clie->ciudad_id 	= Request::input('ciudad');
		$clie->persona_contacto = Request::input('persona_contacto');
		$clie->email 		= Request::input('email');
		$clie->telefono1 	= Request::input('telefono1');
		$clie->telefono2 	= Request::input('telefono2');
		$clie->nota 		= Request::input('nota');
		$clie->balance 		= Request::input('balance');
		$clie->save();

		return 'Cambiado';
	}



	public function deleteDestroy($id)
	{
		$clie = Cliente::findOrFail($id);
		$clie->delete();
		return $clie;
	}

}