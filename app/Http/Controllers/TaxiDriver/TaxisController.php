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

	public function postLoguear()
	{
		$username 	= Request::input('username');
		$password 	= Request::input('password');
		
		$consulta 	= 'SELECT * FROM tx_users WHERE usuario=? and password=?;';
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
		
		$username 	= Request::input('username');
		$password 	= Request::input('password');
		
		$res['taxis'] 		= DB::select('SELECT * from tx_taxis;');
		$res['taxistas'] 	= DB::select('SELECT * from tx_taxistas;');
		$res['carreras'] 	= DB::select('SELECT * from tx_carreras;');
		$res['usuarios'] 	= DB::select('SELECT * from tx_users WHERE usuario=? and password=?;', [$username, $password]);

		
		return $res;
	}
	
	// /feryz_server/public/taxis/insertar-datos-iniciales
	public function getInsertarDatosIniciales()
	{
		$datos 		= new DatosIniciales;
		
		$datos->insertarTaxistas();
		$datos->insertarTaxis();
		$datos->insertarCarreras();
		$datos->insertarUsuarios();
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


	public function putGuardarPosicion()
	{
		$now 		= Carbon::now('America/Bogota');
		
		$consulta 	= 'INSERT INTO tx_posiciones(taxi_id, latitud, longitud, altitud, fecha_hora) VALUES(?,?,?,?,?);';
		
		DB::insert($consulta, 
			[Request::input('taxi_id'), Request::input('latitud'), Request::input('longitud'), Request::input('altitud'), $now]);
		
			
		$id = DB::getPdo()->lastInsertId();
		$posicion = DB::select('SELECT * FROM tx_posiciones WHERE id='.$id);
			
		return ['posicion' => $posicion];
	}


	public function putTraerPosiciones()
	{
		$now 		= Carbon::now('America/Bogota');
		$taxi_id 	= Request::input('taxi_id');
		
		$posiciones = DB::select('SELECT * FROM tx_posiciones WHERE taxi_id=? limit 30', [$taxi_id]);
			
		return ['posiciones' => $posiciones];
	}



	public function putSubirDatos()
	{
		
		$taxistas 	= Request::input('taxistas');
		$taxis 		= Request::input('taxis');
		$carreras 	= Request::input('carreras');
		$usuarios 	= Request::input('usuarios');
		
		$now 		= Carbon::now('America/Bogota');
		
		$rTaxis 		= [];
		$rTaxistas 		= [];
		$rCarreras 		= [];
		$rUsuarios 		= [];
		
		$sqlTaxis 		= '';
		$sqlTaxistas 	= '';
		$sqlCarreras 	= '';
		$sqlUsuarios 	= '';

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
		
		for ($i=0; $i < count($usuarios); $i++) { 
			$usuario 	= $usuarios[$i];
			$sincro 	= new Sincronizar();
			$sincro->syncUsers($usuario, $now);
			
			if (!$usuario['id']) {
				if (strlen($sqlUsuarios) > 0) {
					$sqlUsuarios .= ' OR id=' . $usuario['rowid'];
				}else{
					$sqlUsuarios .= ' id=' . $usuario['rowid'];
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
		
		if (strlen($sqlUsuarios) > 0) {
			$consulta = 'SELECT * FROM tx_users WHERE ' . $sqlUsuarios;
			$rUsuarios = DB::select($consulta);
		}
		

		return ['taxis' => $rTaxis,
			'taxistas' => $rTaxistas,
			'carreras' => $rCarreras,
			'usuarios' => $rUsuarios,
		];
	}

}