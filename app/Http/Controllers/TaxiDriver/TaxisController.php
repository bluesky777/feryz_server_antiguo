<?php namespace App\Http\Controllers\TaxiDriver;

use Request;
use Hash;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Controllers\TaxiDriver\DatosIniciales;
use App\Http\Controllers\TaxiDriver\Sincronizar;
use Carbon\Carbon;
use \Log;

use DB;

class TaxisController extends Controller {

	public function getLoguear()
	{
		$username 	= Request::input('username');
		$password 	= Request::input('password');
		
		$consulta 	= 'SELECT * FROM tx_users WHERE username=? and password=?;';
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
		
		$res['taxis'] 		= DB::select('SELECT * from tx_taxis;');
		$res['taxistas'] 	= DB::select('SELECT * from tx_taxistas;');
		$res['carreras'] 	= DB::select('SELECT * from tx_carreras;');
		$res['usuarios'] 	= DB::select('SELECT * from tx_users;');
		
		return $res;
	}
	
	// /feryz_server/public/taxis/insertar-datos-iniciales
	public function getInsertarDatosIniciales()
	{
		$datos 		= new DatosIniciales;
		
		$datos->insertarTaxistas();
		$datos->insertarTaxis();
		$datos->insertarCarreras();
		return 'Insertados';
	}


	// /feryz_server/public/taxis/borrar-datos-iniciales
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
		
		$rTaxis 		= [];
		$rTaxistas 		= [];
		$rCarreras 		= [];
		
		$sqlTaxis 		= '';
		$sqlTaxistas 	= '';
		$sqlCarreras 	= '';

		for ($i=0; $i < count($taxistas); $i++) { 
			$taxista 	= $taxistas[$i];
			
			$sincro 	= new Sincronizar();
			$sincro->syncTaxista($taxista, $now);
			
			if (!$taxista['id']) {
				if (strlen($sqlTaxis) > 0) {
					$sqlTaxis .= ' OR id=' . $taxista['rowid'];
				}else{
					$sqlTaxis .= ' id=' . $taxista['rowid'];
				}
			}
		}
		Log::info('Despues PRIMER for');
		
		for ($i=0; $i < count($taxis); $i++) { 
			$taxi 	= $taxis[$i];
			$sincro 	= new Sincronizar();
			$sincro->syncTaxis($taxi, $now);
			
			if (!$taxi['id']) {
				if (strlen($sqlTaxistas) > 0) {
					$sqlTaxistas .= ' OR id=' . $taxi['rowid'];
				}else{
					$sqlTaxistas .= ' id=' . $taxi['rowid'];
				}
			}
		}

		
		for ($i=0; $i < count($carreras); $i++) { 
			$carrera 	= $carreras[$i];
			$sincro 	= new Sincronizar();
			$sincro->syncCarreras($carrera, $now);
			
			if (!$carrera['id']) {
				if (strlen($sqlCarreras) > 0) {
					$sqlCarreras .= ' OR id=' . $carrera['rowid'];
				}else{
					$sqlCarreras .= ' id=' . $carrera['rowid'];
				}
			}
		}

		
		
		if (strlen($sqlTaxis) > 0) {
			$consulta = 'SELECT * FROM tx_taxis WHERE ' . $sqlTaxis;
			$rTaxis = DB::select($consulta);
		}
		
		if (strlen($sqlTaxistas) > 0) {
			$consulta = 'SELECT * FROM tx_taxistas WHERE ' . $sqlTaxistas;
			$rTaxistas = DB::select($consulta);
		}
		
		if (strlen($sqlCarreras) > 0) {
			$consulta = 'SELECT * FROM tx_carreras WHERE ' . $sqlCarreras;
			$rCarreras = DB::select($consulta);
		}
		

		return ['taxis' => $rTaxis,
			'taxistas' => $rTaxistas,
			'carreras' => $rCarreras,
			];
	}

}