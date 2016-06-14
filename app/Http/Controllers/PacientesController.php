<?php namespace App\Http\Controllers;

use Request;
use DB;
use App\Models\Paciente;
use App\Models\Visiometria;
use App\Models\AccidenteTrabajo;
use App\Models\EnfermedadProfesional;
use App\Models\AntecedenteLaboral;
use App\Models\Vacuna;
use App\Models\Inmunizacion;
use App\Models\Habito;
use App\Models\ExamenFisico;


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


	public function putDatos()
	{
		$paciente_id = Request::input('paciente_id');
		$accTrab = AccidenteTrabajo::where('paciente_id', $paciente_id)->get();
		$antLab = AntecedenteLaboral::where('paciente_id', $paciente_id)->get();
		$enfProf = EnfermedadProfesional::where('paciente_id', $paciente_id)->get();
		$habitos = Habito::where('paciente_id', $paciente_id)->first();
		$exafis = ExamenFisico::where('paciente_id', $paciente_id)->first();
		$visiometria = Visiometria::where('paciente_id', $paciente_id)->first();
		$vacunas = Vacuna::all();

		$consulta = 'SELECT i.*, v.vacuna
						from inmunizaciones i 
						inner join vacunas v on v.id=i.vacuna_id
						where i.paciente_id=:paciente_id';
		$inmunizaciones = DB::select($consulta, [':paciente_id' => $paciente_id]);


		if (!$visiometria) {
			$visiometria = ['test_color' => 'N', 
							'estereopsis' => 'N'];
		}

		return ['accTrab' => $accTrab, 
				'antLab' => $antLab, 
				'enfProf' => $enfProf, 
				'visiometria' => $visiometria, 
				'vacunas' => $vacunas, 
				'inmunizaciones' => $inmunizaciones,
				'habitos' => $habitos,
				'examen_fisico' => $exafis];
	}


	public function getExamenIngreso()
	{
		$paciente = [];

		$consulta = 'SELECT p.*, c.id as ciudad_id, c.ciudad, c.departamento, 
							c.pais_id, pa.id as pais_id, pa.pais, pa.abrev,
							im.nombre as nombre_imagen
						from pacientes p 
						left join ciudades c on c.id=p.ciudad_nac_id
						left join paises pa on pa.id=c.pais_id
						left join antec_auditivos antec on antec.paciente_id=p.id
						left join agudeza_visual agu on agu.paciente_id=p.id 
						left join otoscopia o on o.paciente_id=p.id
						left join motilidad_ocular m on m.paciente_id=p.id
						left join pulmonar pu on pu.paciente_id=p.id
						left join visiometria vi on vi.paciente_id=p.id
						left join images im on im.id=p.image_id
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

		$consulta = 'SELECT * from habitos where paciente_id=:paciente_id';
		$habitos = DB::select($consulta, [':paciente_id' => $paciente->id]);
		$paciente->habitos = $habitos;

		$consulta = 'SELECT * from accid_trabajo a where a.paciente_id=:paciente_id';
		$accid_trabajo = DB::select($consulta, [':paciente_id' => $paciente->id]);
		$paciente->accid_trabajo = $accid_trabajo;

		$consulta = 'SELECT * from enfermedades_prof e where e.paciente_id=:paciente_id';
		$enfermedades_prof = DB::select($consulta, [':paciente_id' => $paciente->id]);
		$paciente->enfermedades_prof = $enfermedades_prof;

		$consulta = 'SELECT * from images i where i.id=:image_id';
		$images = DB::select($consulta, [':image_id' => $paciente->image_id]);
		if (count($images)>0) {
			$images = $images[0];
		}
		$paciente->imagen = $images;



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
		$pac->antec_patologicos = 'Niega alergias, enfermedades de importacia y consumo de medicamentos';
		$pac->antec_hospitalarios = 'Niega hospitalizacion';
		$pac->antec_quirurgicos = 'Niega cirugias previas';
		$pac->antec_familiares = 'Niega tener antecedentes familiares';

		$pac->save();

		$hab = new Habito;
		$hab->paciente_id = $pac->id;
		$hab->cigarrillo = Request::input('cigarrillo');
		$hab->cigarrillo_descripcion = Request::input('cigarrillo_desc');
		$hab->alcohol = Request::input('alcohol');
		$hab->alcohol_descripcion = Request::input('alcohol_desc');
		$hab->drogas = Request::input('drogas');
		$hab->drogas_descripcion = Request::input('drogas_desc');
		$hab->dieta = Request::input('dieta');
		$hab->dieta_descripcion = Request::input('dieta_desc');
		$hab->ejercicio = Request::input('ejercicio');
		$hab->ejercicio_descripcion = Request::input('ejercicio_desc');
		$hab->save();


		$exafis = new ExamenFisico;
		$exafis->paciente_id = $pac->id;
		$exafis->save();


		return $pac;
	}


	public function putActualizar()
	{

		if (Request::input('doc_tipo')) {
			if (isset( Request::input('doc_tipo')['tipo'])) {
				Request::merge(array('doc_tipo' => Request::input('doc_tipo')['tipo']));
			}
		}
		if (Request::input('ciudad_nac')) {
			if (isset( Request::input('ciudad_nac')['id'])) {
				Request::merge(array('ciudad_nac' => Request::input('ciudad_nac')['id']));
			}
		}
		$hab = Habito::where('paciente_id', Request::input('id'))->first();
		$hab->cigarrillo = Request::input('habitos')['cigarrillo'];
		$hab->cigarrillo_descripcion = Request::input('habitos')['cigarrillo_descripcion'];
		$hab->alcohol = Request::input('habitos')['alcohol'];
		$hab->alcohol_descripcion = Request::input('habitos')['alcohol_descripcion'];
		$hab->drogas = Request::input('habitos')['drogas'];
		$hab->drogas_descripcion = Request::input('habitos')['drogas_descripcion'];
		$hab->dieta = Request::input('habitos')['dieta'];
		$hab->dieta_descripcion = Request::input('habitos')['dieta_descripcion'];
		$hab->ejercicio = Request::input('habitos')['ejercicio'];
		$hab->ejercicio_descripcion = Request::input('habitos')['ejercicio_descripcion'];
		$hab->save();

		$pac = Paciente::find(Request::input('id'));
		$pac->empresa_usuaria = Request::input('empresa_usuaria');
		$pac->empresa_temporal = Request::input('empresa_temporal');
		$pac->actividad_economica = Request::input('actividad_economica');
		$pac->nombres = Request::input('nombres');
		$pac->apellidos = Request::input('apellidos');
		$pac->doc_tipo = Request::input('doc_tipo');
		$pac->doc_identidad = Request::input('doc_identidad');
		$pac->sexo = Request::input('sexo');
		$pac->direccion = Request::input('direccion');
		$pac->telefono = Request::input('telefono');
		$pac->telefono_contacto = Request::input('telefono_contacto');
		
		$pac->ciudad_nac_id = Request::input('ciudad_nac');
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

		$pac->habitos = $hab;


		$exafis = ExamenFisico::where('paciente_id', $pac->id)->first();

		if ($exafis) {
			$this->GuardarExaFis($exafis, $pac->id);
		}else{
			$exafis = new ExamenFisico;
			$this->GuardarExaFis($exafis, $pac->id);
		}
		
		return $pac;
	}


	private function GuardarExaFis($exafis, $paciente_id)
	{
		$exafis->paciente_id = $paciente_id;
		$exafis->sign_vit_fr 			= Request::input('examen_fisico')['sign_vit_fr'];
		$exafis->sign_vit_ta 			= Request::input('examen_fisico')['sign_vit_ta'];
		$exafis->sign_vit_ta1 			= Request::input('examen_fisico')['sign_vit_ta1'];
		$exafis->sign_vit_temp 			= Request::input('examen_fisico')['sign_vit_temp'];
		$exafis->sign_vit_fc 			= Request::input('examen_fisico')['sign_vit_fc'];
		$exafis->sign_vit_peso 			= Request::input('examen_fisico')['sign_vit_peso'];
		$exafis->sign_vit_talla 		= Request::input('examen_fisico')['sign_vit_talla'];
		$exafis->sign_vit_imc 			= Request::input('examen_fisico')['sign_vit_imc'];
		$exafis->estado_general 		= Request::input('examen_fisico')['estado_general']['descripcion'];
		$exafis->contitucion 			= Request::input('examen_fisico')['contitucion']['descripcion'];
		$exafis->dominancia 			= Request::input('examen_fisico')['dominancia']['descripcion'];
		$exafis->agudeza_visual 		= Request::input('examen_fisico')['agudeza_visual']['descripcion'];
		$exafis->ojo_derecho 			= Request::input('examen_fisico')['ojo_derecho']['descripcion'];
		$exafis->ojo_izquierdo			= Request::input('examen_fisico')['ojo_izquierdo']['descripcion'];
		$exafis->organos_sentidos			= Request::input('examen_fisico')['organos_sentidos']['descripcion'];
		$exafis->cardio_pulmonar			= Request::input('examen_fisico')['cardio_pulmonar']['descripcion'];
		$exafis->abdomen				= Request::input('examen_fisico')['abdomen']['descripcion'];
		$exafis->genito_urinario			= Request::input('examen_fisico')['genito_urinario']['descripcion'];
		$exafis->columna_vertebral			= Request::input('examen_fisico')['columna_vertebral']['descripcion'];
		$exafis->neurologico			= Request::input('examen_fisico')['neurologico']['descripcion'];
		$exafis->osteo_muscular			= Request::input('examen_fisico')['osteo_muscular']['descripcion'];
		$exafis->extremidades			= Request::input('examen_fisico')['extremidades']['descripcion'];
		$exafis->piel_anexos			= Request::input('examen_fisico')['piel_anexos']['descripcion'];
		$exafis->examen_mental			= Request::input('examen_fisico')['examen_mental']['descripcion'];
		$exafis->observaciones			= Request::input('examen_fisico')['observaciones']['descripcion'];
		$exafis->save();
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