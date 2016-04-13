<?php namespace App\Http\Controllers;

use Request;
use App\Models\EnfermedadProfesional;

class EnfermedadesProfesionalesController extends Controller {

	public function putPaciente()
	{
		return EnfermedadProfesional::where('paciente_id', Request::input('paciente_id'))->get();
	}

	public function postGuardar()
	{
		$enfm = new EnfermedadProfesional;
		$enfm->fecha 			= Request::input('fecha');
		$enfm->diagnostico 	    = Request::input('diagnostico');
		$enfm->arp 			    = Request::input('arp');
		$enfm->fact_riesgo 		= Request::input('fact_riesgo');
		$enfm->organo_afectado   = Request::input('organo_afectado');
		$enfm->agente 	        = Request::input('agente');
		$enfm->tipo_accidente 	= Request::input('tipo_accidente');
		$enfm->severidad 		= Request::input('severidad');
		$enfm->secuelas          = Request::input('secuelas');
		$enfm->paciente_id       = Request::input('paciente_id');
		$enfm->save();

		return $enfm;
	}


	public function putActualizar()
	{
		$enfm = EnfermedadProfesional::find(Request::input('id'));
		$enfm->fecha 			= Request::input('fecha');
		$enfm->diagnostico 	    = Request::input('diagnostico');
		$enfm->arp 			    = Request::input('arp');
		$enfm->fact_riesgo 		= Request::input('fact_riesgo');
		$enfm->organo_afectado   = Request::input('organo_afectado');
		$enfm->agente 	        = Request::input('agente');
		$enfm->tipo_accidente 	= Request::input('tipo_accidente');
		$enfm->severidad 		= Request::input('severidad');
		$enfm->secuelas          = Request::input('secuelas');
		$enfm->save();

		return $enfm;
	}

	public function deleteDestroy($id)
	{
		$enfm = EnfermedadProfesional::findOrFail($id);
		$enfm->delete();
		return $enfm;
	}

}