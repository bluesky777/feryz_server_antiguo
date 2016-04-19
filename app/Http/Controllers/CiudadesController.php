<?php namespace App\Http\Controllers;

use Request;
use DB;
use App\Models\Ciudad;
use App\Models\Pais;

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
		$city = new Ciudad;
		$city->ciudad = Request::input('ciudad');
		$city->departamento = Request::input('departamento');
		$city->pais = Request::input('pais');
		$city->save();

		return $city;
	}


	public function getPaisdeciudad($ciudad_id)
	{	
		$consulta = 'SELECT paises.id, pais, abrev FROM paises, ciudades where paises.id = ciudades.pais_id and ciudades.id = :ciudad_id';
		return DB::select($consulta, ['ciudad_id' => $ciudad_id]);
	}

	public function getPordepartamento($departamento)
	{
		return Ciudad::where('departamento', $departamento)->get();
	}



	public function getDatosciudad($ciudad_id)
	{
		$ciudad = Ciudad::find($ciudad_id);
		$pais = $this->getPaisdeciudad($ciudad->id);

		$departamentos = $this->getDepartamentos($pais[0]->id);
		$ciudades = Ciudad::where('departamento' , $ciudad->departamento)->get();

		$result = array('ciudad' => $ciudad, 
						'ciudades' => $ciudades, 
						'departamento' => array('departamento'=>$ciudad->departamento), 
						'departamentos' => $departamentos,
						'pais'=> $pais[0],
						'paises' => Pais::all());
		return $result;
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