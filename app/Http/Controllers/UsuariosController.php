<?php namespace App\Http\Controllers;

use Request;
use App\Models\User;

class UsuariosController extends Controller {

	public function getAll()
	{
		return User::all();
	}

	public function postGuardar()
	{
		$User = new User;
		$User->nombres = Request::input('nombres');
		$User->apellidos = Request::input('apellidos');
		$User->sexo = Request::input('sexo');
		//$pro->image_id = Request::input('image_id');
		$User->username = Request::input('username');
		$User->password = Request::input('password');
		$User->email = Request::input('email');
		$User->tipo_doc = Request::input('tipo_doc');
		$User->num_doc = Request::input('num_doc');
		$User->ciudad_doc = Request::input('ciudad_doc');
		$User->fecha_nac = Request::input('fecha_nac');
		$User->ciudad_nac = Request::input('ciudad_nac');
		$User->titulo = Request::input('titulo');
		$User->estado_civil = Request::input('estado_civil');
		$User->barrio = Request::input('barrio');
		$User->direccion = Request::input('direccion');
		$User->telefono = Request::input('telefono');
		$User->celular = Request::input('celular');
		$User->facebook = Request::input('facebook');
		$User->save();

		return $User;
	}


	public function putActualizar()
	{
		$User = User::find(Request::input('id'));
		$User->nombres = Request::input('nombres');
		$User->apellidos = Request::input('apellidos');
		$User->sexo = Request::input('sexo');
		//$pro->image_id = Request::input('image_id');
		$User->username = Request::input('username');
		$User->password = Request::input('password');
		$User->email = Request::input('email');
		$User->tipo_doc = Request::input('tipo_doc');
		$User->num_doc = Request::input('num_doc');
		$User->ciudad_doc = Request::input('ciudad_doc');
		$User->fecha_nac = Request::input('fecha_nac');
		$User->ciudad_nac = Request::input('ciudad_nac');
		$User->titulo = Request::input('titulo');
		$User->estado_civil = Request::input('estado_civil');
		$User->barrio = Request::input('barrio');
		$User->direccion = Request::input('direccion');
		$User->telefono = Request::input('telefono');
		$User->celular = Request::input('celular');
		$User->facebook = Request::input('facebook');
		$User->save();

		return $User;
	}

	public function deleteDestroy($id)
	{
		$User = User::findOrFail($id);
		$User->delete();
		return $User;
	}

}