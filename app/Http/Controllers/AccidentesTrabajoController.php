<?php namespace App\Http\Controllers;

use Request;
use App\Models\AccidenteTrabajo;

class AccidentesTrabajoController extends Controller {

	public function putPaciente()
	{
		return AccidenteTrabajo::where('paciente_id', Request::input('paciente_id'))->get();
	}

	public function postGuardar()
	{
		$pro = new AccidenteTrabajo;
		$pro->fecha 			= Request::input('fecha');
		$pro->diagnostico 	    = Request::input('diagnostico');
		$pro->arp 			    = Request::input('arp');
		$pro->fact_riesgo 		= Request::input('fact_riesgo');
		$pro->organo_afectado   = Request::input('organo_afectado');
		$pro->agente 	        = Request::input('agente');
		$pro->tipo_accidente 	= Request::input('tipo_accidente');
		$pro->severidad 		= Request::input('severidad');
		$pro->secuelas          = Request::input('secuelas');
		$pro->paciente_id       = Request::input('paciente_id');
		$pro->save();

		return $pro;
	}


	public function putActualizar()
	{
		$pro = AccidenteTrabajo::find(Request::input('id'));
		$pro->fecha 			= Request::input('fecha');
		$pro->diagnostico 	    = Request::input('diagnostico');
		$pro->arp 			    = Request::input('arp');
		$pro->fact_riesgo 		= Request::input('fact_riesgo');
		$pro->organo_afectado   = Request::input('organo_afectado');
		$pro->agente 	        = Request::input('agente');
		$pro->tipo_accidente 	= Request::input('tipo_accidente');
		$pro->severidad 		= Request::input('severidad');
		$pro->secuelas          = Request::input('secuelas');
		$pro->save();

		return $pro;
	}

	public function deleteDestroy($id)
	{
		$pro = AccidenteTrabajo::findOrFail($id);
		$pro->delete();
		return $pro;
	}

}