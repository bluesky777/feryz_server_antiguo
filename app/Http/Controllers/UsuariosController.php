<?php namespace App\Http\Controllers;

use Request;
use Hash;
use App\Models\User;
use App\Models\TipoUsuario;

class UsuariosController extends Controller {

	public function getAll()
	{
		return User::where('is_superuser',false)->get();
	}

	public function postGuardar()
	{
		$User = new User;
		$User->nombres = 	Request::input('nombres');
		$User->apellidos = 	Request::input('apellidos');
		$User->sexo = 		Request::input('sexo');
		//$pro->image_id = Request::input('image_id');
		$User->username = 	Request::input('username');
		$User->password = 	Hash::make(Request::input('password'));
		$User->email = 		Request::input('email');
		$User->tipo_usu_id = 	Request::input('tipo_usu_id')['id'];
		$User->tipo_doc = 	Request::input('tipo_doc')['id'];
		$User->num_doc = 	Request::input('num_doc');
		$User->ciudad_doc = Request::input('ciudad_doc')['id'];
		$User->fecha_nac = 	Request::input('fecha_nac');
		$User->ciudad_nac = Request::input('ciudad_nac')['id'];
		//$User->titulo = 	Request::input('titulo');
		$User->estado_civil = Request::input('estado_civil');
		$User->barrio = 	Request::input('barrio');
		$User->direccion = 	Request::input('direccion');
		$User->telefono = 	Request::input('telefono');
		$User->celular = 	Request::input('celular');
		$User->facebook = 	Request::input('facebook');
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
		$User->password = 	Hash::make(Request::input('password'));
		$User->email = Request::input('email');
		$User->tipo_usu_id = 	Request::input('tipo_usu_id')['id'];
		$User->tipo_doc = Request::input('tipo_doc')['id'];
		$User->num_doc = Request::input('num_doc');
		$User->ciudad_doc = Request::input('ciudad_doc')['id'];
		$User->fecha_nac = Request::input('fecha_nac');
		$User->ciudad_nac = Request::input('ciudad_nac')['id'];
		$User->titulo = Request::input('titulo');
		$User->estado_civil = Request::input('estado_civil');
		$User->barrio = Request::input('barrio');
		$User->direccion = Request::input('direccion');
		$User->telefono = Request::input('telefono');
		$User->celular = Request::input('celular');
		$User->facebook = Request::input('facebook');
		$User->save();

		return 'Cambiado';
	}


	public function getTipos()
	{
		return TipoUsuario::all();
	}

	public function deleteDestroy($id)
	{
		$User = User::findOrFail($id);
		$User->delete();
		return $User;
	}

}