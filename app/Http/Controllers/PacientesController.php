<?php namespace App\Http\Controllers;

use Request;
use App\Models\Paciente;

class PacientesController extends Controller {

	public function getAll()
	{
		return Paciente::all();
	}

	public function postGuardar()
	{
		$pac = new Paciente;
		$pac->empresa_usuaria = Request::input('empresa_usuaria');
		$pac->empresa_temporal = Request::input('empresa_temporal');
		$pac->actividad_economica = Request::input('actividad_economica');
		$pac->nombres = Request::input('nombres');
		$pac->apellidos = Request::input('apellidos');
		$pac->doc_tipo = Request::input('doc_tipo')['tipo'];
		$pac->doc_identidad = Request::input('doc_identidad');
		$pac->sexo = Request::input('sexo');
		$pac->direccion = Request::input('direccion');
		$pac->telefono = Request::input('telefono');
		$pac->telefono_contacto = Request::input('telefono_contacto');
		$pac->ciudad_nac_id = Request::input('ciudad_nac')['id'];
		$pac->estado_civil = Request::input('estado_civil');
		$pac->nivel_escolaridad = Request::input('nivel_escolaridad');
		$pac->profesion = Request::input('profesion');
		$pac->grupo_sanguineo = Request::input('grupo_sanguineo');
		$pac->rh = Request::input('rh');
		$pac->eps = Request::input('eps');
		$pac->arp = Request::input('arp');
		$pac->fecha_ingreso = date('Y-m-d');
		$pac->cargo = Request::input('cargo');
		$pac->descripcion_cargo = Request::input('descripcion_cargo');
		$pac->motivo_consulta = Request::input('motivo_consulta');
		$pac->save();

		return $pac;
	}


	public function putActualizar()
	{
		$pac = Paciente::find(Request::input('id'));
		$pac->empresa_usuaria = Request::input('empresa_usuaria');
		$pac->empresa_temporal = Request::input('empresa_temporal');
		$pac->actividad_economica = Request::input('actividad_economica');
		$pac->nombres = Request::input('nombres');
		$pac->apellidos = Request::input('apellidos');
		$pac->doc_tipo = Request::input('doc_tipo')['tipo'];
		$pac->doc_identidad = Request::input('doc_identidad');
		$pac->sexo = Request::input('sexo');
		$pac->direccion = Request::input('direccion');
		$pac->telefono = Request::input('telefono');
		$pac->telefono_contacto = Request::input('telefono_contacto');
		$pac->ciudad_nac_id = Request::input('ciudad_nac')['id'];
		$pac->estado_civil = Request::input('estado_civil');
		$pac->nivel_escolaridad = Request::input('nivel_escolaridad');
		$pac->profesion = Request::input('profesion');
		$pac->grupo_sanguineo = Request::input('grupo_sanguineo');
		$pac->rh = Request::input('rh');
		$pac->eps = Request::input('eps');
		$pac->arp = Request::input('arp');
		$pac->fecha_ingreso = Request::input('fecha_ingreso');
		$pac->cargo = Request::input('cargo');
		$pac->descripcion_cargo = Request::input('descripcion_cargo');
		$pac->motivo_consulta = Request::input('motivo_consulta');


		$pac->save();

		return $pac;
	}

	public function putActualizarAntecLaborales()
	{
		$pac = Paciente::findOrFail($id);
		$pac->delete();
		return $pac;
	}

	public function deleteDestroy($id)
	{
		$pac = Paciente::findOrFail($id);
		$pac->delete();
		return $pac;
	}

}