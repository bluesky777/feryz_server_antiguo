<?php namespace App\Http\Controllers\TaxiDriver;

use Request;
use Hash;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Controllers\TaxiDriver\DatosIniciales;
use App\Http\Controllers\TaxiDriver\Sincronizar;

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