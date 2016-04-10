<?php namespace App\Http\Controllers;

use Request;
use App\Models\AntecedenteLaboral;

class AntecedentesLaboralesController extends Controller {

	public function getAll()
	{
		return AntecedenteLaboral::all();
	}

	public function postGuardar()
	{
		$pro = new AntecedenteLaboral;
		$pro->empresa 			= Request::input('empresa');
		$pro->activ_economica 	= Request::input('activ_economica');
		$pro->cargo 			= Request::input('cargo');
		$pro->fact_riesgo 		= Request::input('fact_riesgo');
		$pro->tiempo_exposicion = Request::input('tiempo_exposicion');
		$pro->niv_exposicion 	= Request::input('niv_exposicion');
		$pro->controles 		= Request::input('controles');
		$pro->epp 				= Request::input('epp');
		$pro->paciente_id 		= Request::input('paciente_id');
		$pro->save();

		return $pro;
	}


	public function putActualizar()
	{
		$pro = AntecedenteLaboral::find(Request::input('id'));
		$pro->nombre = Request::input('nombre');
		$pro->codigo = Request::input('codigo');
		$pro->save();

		return $pro;
	}

	public function deleteDestroy($id)
	{
		$pro = AntecedenteLaboral::findOrFail($id);
		$pro->delete();
		return $pro;
	}

}