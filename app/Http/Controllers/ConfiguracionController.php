<?php namespace App\Http\Controllers;

use Request;
use DB;
use App\Models\Configuracion;

class ConfiguracionController extends Controller {

	public function getAll()
	{	
		$cons = 'SELECT cf.*, c.pais_id, c.departamento FROM configuracion cf
				left join ciudades c on c.id=cf.ciudad_id;';

		$res = DB::select($cons);
		return $res;
	}

	
	public function putActualizar()
	{
		$Conf = Configuracion::find(Request::input('id'));
		$Conf->nombre_ips = Request::input('nombre_ips');
		$Conf->telefono = Request::input('telefono');
		//Conf$pac->logo_id = Request::input('logo_id');
		$Conf->ciudad_id = Request::input('ciudad_id')['id'];
		

		$Conf->save();

		return $Conf;
	}

	/*public function putActualizarAntecLaborales()
	{
		$pac = Paciente::findOrFail($id);
		$pac->delete();
		return $pac;
	}*/

	public function deleteDestroy($id)
	{
		$Conf = Configuracion::findOrFail($id);
		$Conf->delete();
		return $Conf;
	}

}