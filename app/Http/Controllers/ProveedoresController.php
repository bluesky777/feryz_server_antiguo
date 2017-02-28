<?php namespace App\Http\Controllers;

use Request;
use Hash;
use App\Models\User;
use App\Models\Proveedor;

use DB;

class ProveedoresController extends Controller {

	public function getAll()
	{
		return Proveedor::all();
	}

	public function postGuardar()
	{
		$user = User::fromToken();

		$prov = new Proveedor;

		$prov->nombre 		= Request::input('nombre');
		$prov->direccion 	= Request::input('direccion');
		$prov->ciudad_id 	= Request::input('ciudad_id')['id'];
		$prov->persona_contacto = Request::input('persona_contacto');
		$prov->email 		= Request::input('email');
		$prov->telefono1 	= Request::input('telefono1');
		$prov->telefono2 	= Request::input('telefono2');
		$prov->nota 		= Request::input('nota');
		$prov->balance 		= Request::input('balance');
		$prov->created_by 	= $user['id'];
		$prov->save();

		return $prov;
	}


	public function putActualizar()
	{
		$user = User::fromToken();

		$prov = Proveedor::find(Request::input('id'));

		if (is_array(Request::input('ciudad'))) {
			Request::merge(['ciudad' => Request::input('ciudad')['id']]);
		} 

		$prov->nombre 		= Request::input('nombre');
		$prov->direccion 	= Request::input('direccion');
		$prov->ciudad_id 	= Request::input('ciudad');
		$prov->persona_contacto = Request::input('persona_contacto');
		$prov->email 		= Request::input('email');
		$prov->telefono1 	= Request::input('telefono1');
		$prov->telefono2 	= Request::input('telefono2');
		$prov->nota 		= Request::input('nota');
		$prov->balance 		= Request::input('balance');
		$prov->save();

		return 'Cambiado';
	}



	public function deleteDestroy($id)
	{
		$prov = Proveedor::findOrFail($id);
		$prov->delete();
		return $prov;
	}

}