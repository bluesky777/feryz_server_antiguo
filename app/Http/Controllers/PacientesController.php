<?php namespace App\Http\Controllers;

use Request;
use DB;
use App\Models\Paciente;

class PacientesController extends Controller {

	public function getAll()
	{
		return Paciente::all();
	}

	public function getResumen()
	{
		$consulta = 'SELECT p.nombres, p.apellidos, p.fecha_nac, p.telefono, p.doc_identidad, p.motivo_consulta, c.id, c.ciudad, c.departamento, c.pais_id, pa.id, pa.pais, pa.abrev
						from pacientes p 
						left join ciudades c on c.id=p.ciudad_nac_id
						left join paises pa on pa.id=c.pais_id';
		return DB::select($consulta);
	}

	public function getExamenIngreso()
	{
		$paciente = [];

		$consulta = 'SELECT p.*, c.id, c.ciudad, c.departamento, 
							c.pais_id, pa.id, pa.pais, pa.abrev
						from pacientes p 
						left join ciudades c on c.id=p.ciudad_nac_id
						left join paises pa on pa.id=c.pais_id
						left join antec_auditivos antec on antec.paciente_id=p.id
						left join agudeza_visual agu on agu.paciente_id=p.id 
						left join otoscopia o on o.paciente_id=p.id
						left join motilidad_ocular m on m.paciente_id=p.id
						left join pulmonar pu on pu.paciente_id=p.id
						left join visiometria vi on vi.paciente_id=p.id
						and p.id=1';
		
		$paciente = DB::select($consulta);

		if (count($paciente) > 0) {
			$paciente = $paciente[0];
		}else{
			return abort(404, "No se encontró el paciente");
		}


		
		$consulta = 'SELECT * from antec_laborales where paciente_id=:paciente_id';
		$ant_lab = DB::select($consulta, [':paciente_id' => $paciente->id]);
		$paciente->ant_laborales = $ant_lab;

		$consulta = 'SELECT * from accid_trabajo a where a.paciente_id=:paciente_id';
		$accid_trabajo = DB::select($consulta, [':paciente_id' => $paciente->id]);
		$paciente->accid_trabajo = $accid_trabajo;

		$consulta = 'SELECT * from enfermedades_prof e where e.paciente_id=:paciente_id';
		$enfermedades_prof = DB::select($consulta, [':paciente_id' => $paciente->id]);
		$paciente->enfermedades_prof = $enfermedades_prof;



		return (array)$paciente;
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
		$pac->fecha_nac = Request::input('fecha_nac');

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