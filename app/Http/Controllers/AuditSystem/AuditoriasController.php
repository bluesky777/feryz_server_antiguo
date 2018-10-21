<?php namespace App\Http\Controllers\AuditSystem;

use Request;
use Hash;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Controllers\AuditSystem\DatosIniciales;
use App\Http\Controllers\AuditSystem\Sincronizar;
use Carbon\Carbon;

use DB;

class AuditoriasController extends Controller {

	public function getLoguear()
	{
		$username 	= Request::input('username');
		$password 	= Request::input('password');
		
		$consulta 	= 'SELECT * FROM au_users WHERE username=? and password=?;';
		$usuario 	= DB::select($consulta, [$username, $password]);
		
		if (count($usuario) > 0) {
			return $usuario;
		}else{
			return abort(401, 'Datos incorrectos.');
		}
		
	}


	public function getAll()
	{
		$res = [];
		
		$res['respuestas'] 		= DB::select('SELECT * from au_respuestas;');
		$res['preguntas'] 		= DB::select('SELECT * from au_preguntas;');
		$res['gastos_mes'] 		= DB::select('SELECT * from au_gastos_mes;');
		$res['destinos_pagos'] 	= DB::select('SELECT * from au_destinos_pagos;');
		$res['destinos'] 		= DB::select('SELECT * from au_destinos;');
		$res['lib_semanales'] 	= DB::select('SELECT * from au_lib_semanales;');
		$res['lib_mensuales'] 	= DB::select('SELECT * from au_lib_mensuales;');
		$res['auditorias'] 		= DB::select('SELECT * from au_auditorias;');
		$res['iglesias'] 		= DB::select('SELECT * from au_iglesias;');
		$res['distritos'] 		= DB::select('SELECT * from au_distritos;');
		$res['asociaciones'] 	= DB::select('SELECT * from au_asociaciones;');
		$res['uniones'] 		= DB::select('SELECT * from au_uniones;');
		$res['users'] 			= DB::select('SELECT * from au_users;');
		
		return $res;
	}

	public function getInsertarDatosIniciales()
	{
		$datos 		= new DatosIniciales;
		
		$datos->insertarTaxistas();
		$datos->insertarTaxis();
		$datos->insertarCarreras();
		return 'Insertados';
	}


	// Función muy peligrosa. Debo borrarla!!!
	public function getBorrarDatosIniciales()
	{
		DB::delete('DELETE FROM tx_taxistas;');
		DB::delete('DELETE FROM tx_taxis;');
		DB::delete('DELETE FROM tx_carreras;');
		DB::delete('DELETE FROM tx_users;');
		return 'BORRADOS';
	}



	public function putSubirDatos()
	{
		
		$taxistas 	= Request::input('taxistas');
		$taxis 		= Request::input('taxis');
		$carreras 	= Request::input('carreras');
		
		$now 		= Carbon::now('America/Bogota');
		
		for ($i=0; $i < count($taxistas); $i++) { 
			$taxista 	= $taxistas[$i];
			$sincro 	= new Sincronizar();
			$sincro->syncTaxista($taxista, $now);
			
			
		}
		
		return 'Subiendo';
	}

}