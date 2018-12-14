<?php namespace App\Http\Controllers\AuditSystem;

use Request;
use Hash;
use Excel;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Controllers\AuditSystem\DatosIniciales;
use App\Http\Controllers\AuditSystem\Sincronizar;
use Carbon\Carbon;
use \Log;

use DB;

class AuUsuarioController extends Controller {
	
	
	

	public function putCambiarTema()
	{
        $consulta = 'UPDATE au_users SET tema=? WHERE id=?';
		DB::update($consulta, [Request::input('tema'), Request::input('user_id')]);

		return 'Cambiado';
		
	}
	
	
	public function putCambiarIdioma()
	{
        $consulta = 'UPDATE au_users SET idioma=? WHERE id=?';
		DB::update($consulta, [Request::input('idioma'), Request::input('user_id')]);

		return 'Cambiado';
		
	}
	
	



}