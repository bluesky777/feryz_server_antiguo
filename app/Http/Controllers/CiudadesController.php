<?php namespace App\Http\Controllers;

use Request;
use DB;
use App\Models\Ciudad;

class CiudadesController extends Controller {

	public function getAll()
	{
		return Ciudad::all();
	}

	public function getDepartamentos()
	{
		$pais_id = Request::get('pais_id');
		$consulta = 'SELECT distinct departamento FROM ciudades where pais_id = :pais';
		return DB::select($consulta, ['pais' => $pais_id]);
	}

	public function getCiudades()
	{
		$departamento = Request::get('departamento');
		return Ciudad::where('departamento', $departamento)->get();
	}

	public function postGuardar()
	{
		$pro = new Ciudad;
		$pro->nombre = Request::input('nombre');
		$pro->codigo = Request::input('codigo');
		$pro->save();

		return $pro;
	}


	public function putActualizar()
	{
		$pro = Ciudad::find(Request::input('id'));
		$pro->nombre = Request::input('nombre');
		$pro->codigo = Request::input('codigo');
		$pro->save();

		return $pro;
	}

	public function deleteDestroy($id)
	{
		$pro = Ciudad::findOrFail($id);
		$pro->delete();
		return $pro;
	}

}