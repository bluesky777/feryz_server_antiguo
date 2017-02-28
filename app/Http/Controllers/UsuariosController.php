<?php namespace App\Http\Controllers;

use Request;
use Hash;
use App\Models\User;


use DB;

class UsuariosController extends Controller {

	public function getAll()
	{
		$user = User::fromToken();

		$cons = "SELECT *, NULL as password FROM users u WHERE (u.is_superuser=false or u.id=:user_id) and u.deleted_at is null";
		$users = DB::select($cons, [':user_id' => $user['id']]);

		
		return $users;
	}

	public function postGuardar()
	{
		$user = User::fromToken();

		$UserN = new User;

		$UserN->nombres 	= Request::input('nombres');
		$UserN->apellidos 	= Request::input('apellidos');
		$UserN->sexo 		= Request::input('sexo');
		//$pro->image_id = Request::input('imagen_id');
		$UserN->username 	= Request::input('username');
		$UserN->password 	= Hash::make(Request::input('password'));
		$UserN->email 		= Request::input('email');
		$UserN->tipo 		= Request::input('tipo')['tipo'];
		$UserN->tipo_doc 	= Request::input('tipo_doc')['tipo'];
		$UserN->num_doc 	= Request::input('num_doc');
		$UserN->ciudad_doc 	= Request::input('ciudad_doc')['id'];
		$UserN->fecha_nac 	= Request::input('fecha_nac');
		$UserN->ciudad_nac 	= Request::input('ciudad_nac')['id'];
		$UserN->telefono1 	= Request::input('telefono1');
		$UserN->telefono2 	= Request::input('telefono2');
		$UserN->created_by 	= $user['id'];
		$UserN->save();

		return $UserN;
	}


	public function putActualizar()
	{
		$user = User::fromToken();

		$User = User::find(Request::input('id'));

		if (is_array(Request::input('tipo'))) {
			Request::merge(['tipo' => Request::input('tipo')['tipo']]);
		} 
		if (is_array(Request::input('tipo_doc'))) {
			Request::merge(['tipo_doc' => Request::input('tipo_doc')['tipo']]);
		} 

		$User->nombres 		= Request::input('nombres');
		$User->apellidos 	= Request::input('apellidos');
		$User->sexo 		= Request::input('sexo');
		//$pro->image_id = Request::input('image_id');
		$User->username 	= Request::input('username');

		if (Request::input('password') != '') {
			$User->password = Hash::make(Request::input('password'));
		}

		$User->email 		= Request::input('email');
		$User->tipo 		= Request::input('tipo');
		$User->tipo_doc 	= Request::input('tipo_doc');
		$User->num_doc 		= Request::input('num_doc');
		$User->ciudad_doc 	= Request::input('ciudad_doc')['id'];
		$User->fecha_nac 	= Request::input('fecha_nac');
		$User->ciudad_nac 	= Request::input('ciudad_nac')['id'];
		$User->telefono1 	= Request::input('telefono1');
		$User->telefono2 	= Request::input('telefono2');
		$User->save();

		return 'Cambiado';
	}



	public function deleteDestroy($id)
	{
		$User = User::findOrFail($id);
		$User->delete();
		return $User;
	}

}