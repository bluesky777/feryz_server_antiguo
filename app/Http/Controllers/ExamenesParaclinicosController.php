<?php namespace App\Http\Controllers;

use Request;
use App\Models\ExamenParaclinico;
use DB;


class ExamenesParaclinicosController extends Controller {

	public function putPaciente()
	{
		return ExamenParaclinico::where('paciente_id', Request::input('paciente_id'))->get();
	}

	public function putActualizar()
	{
		$id 		= Request::input('id');


		$exam 				= ExamenParaclinico::findOrFail($id);
		$exam->examen 		= Request::input('examen');
		$exam->diagnostico 	= Request::input('diagnostico');
		$exam->paciente_id 	= Request::input('paciente_id');
		$exam->save();


		return $exam;
	}


	public function postGuardar()
	{
		$paciente_id 	= Request::input('paciente_id');
		$examen 		= Request::input('examen');

		$exam				= new ExamenParaclinico;
		$exam->examen 		= $examen;
		$exam->paciente_id 	= $paciente_id;
		$exam->save();


		return $exam;
	}

	public function deleteDestroy($id)
	{
		$exam = ExamenParaclinico::findOrFail($id);
		$exam->delete();
		return $exam;
	}

}