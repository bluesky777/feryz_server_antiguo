<?php namespace App\Http\Controllers;

use Request;
use App\Models\Inmunizacion;
use DB;


class InmunizacionesController extends Controller {

	public function putPaciente()
	{
		return Inmunizacion::where('paciente_id', Request::input('paciente_id'))->get();
	}

	public function putActualizar()
	{
		$id 		= Request::input('id');


		$inm = Inmunizacion::findOrFail($id);
		$inm->vacuna_id 	= Request::input('vacuna_id');
		$inm->d1 			= Request::input('d1');
		$inm->d2 			= Request::input('d2');
		$inm->d3 			= Request::input('d3');
		$inm->d4 			= Request::input('d4');
		$inm->d5 			= Request::input('d5');
		$inm->refuerzo 		= !Request::input('refuerzo');
		$inm->paciente_id 	= Request::input('paciente_id');
		$inm->save();


		return $inm;
	}


	public function postGuardar()
	{
		$paciente_id 	= Request::input('paciente_id');
		$vacuna_id 		= Request::input('vacuna_id');

		$inm = new Inmunizacion;
		$inm->vacuna_id 	= $vacuna_id;
		$inm->paciente_id 	= $paciente_id;
		$inm->save();

		$consulta = 'SELECT i.*, v.vacuna
						from inmunizaciones i 
						inner join vacunas v on v.id=i.vacuna_id
						where i.id=:inmunizacion_id';
		$inmunizacion = DB::select($consulta, [':inmunizacion_id' => $inm->id])[0];


		return (array)$inmunizacion;
	}

	public function deleteDestroy($id)
	{
		$inm = Inmunizacion::findOrFail($id);
		$inm->delete();
		return $inm;
	}

}