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

class RemesasController extends Controller {
	
	
	

	public function postUpload()
	{
		//Log::info('asociacion_id: '. Request::input('asociacion_id'));
		if(Request::hasFile('file')){
			$path = Request::file('file')->getRealPath();

			$rr = Excel::load($path, function($reader){
				
				
				$results 	= $reader->all();
				
				if (count($results) > 0) {

					if (isset($results[0]->orgid)) {
						$this->insertarRemesas($results);
					}else{
						for ($i=0; $i < count($results); $i++) { 

							if (count($results[$i]) > 0) {
								
								if (isset($results[$i][0]->orgid)) {
									$this->insertarRemesas($results[$i]);
								}
							}
							
						}
					}
				}
                
			});
		}

		return DB::select('SELECT * FROM au_remesas WHERE asociacion_id=?', [Request::input('asociacion_id')]);
		
		//return $rr->parsed;
		
	}
	
	
	public function insertarRemesas($results){
		
		DB::delete('DELETE FROM au_remesas WHERE asociacion_id=' . Request::input('asociacion_id') );
		
		$now 		= Carbon::now('America/Bogota');
		

		for ($i=0; $i < count($results); $i++) {
			$remesa = $results[$i];
			
			$fecha_format = null;
			
			if ($remesa->fecha) {
				$fecha_format = Carbon::parse($remesa->fecha);
			}
			
			if (!$remesa->periodo) {
				return;
			}
			
			
			$consulta 	= 'INSERT INTO au_remesas(num_diario, linea, tipo_diario, num_secuencia, periodo, fecha, referencia, cod_cuenta, nombre_cuenta, descripcion_transaccion, cantidad, 
					iva, moneda, recurso, funcion, restr, org_id, empleados, concepto, asociacion_id, created_at, updated_at) 
				VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);';
			
			$datos = [ $remesa->num_diario, $remesa->linea, $remesa->tipo_diario, $remesa->num_secuencia, $remesa->periodo, $remesa->fecha, $remesa->referencia, $remesa->cod_cuenta, $remesa->nombre_de_cuenta, $remesa->descripcion_transaccion, $remesa->cantidad, 
				$remesa->iva, $remesa->moneda, $remesa->recurso, $remesa->funcion, $remesa->restr, $remesa->orgid, $remesa->empleados, $remesa->concepto, Request::input('asociacion_id'), $now, $now ];
			
				
			DB::insert($consulta, $datos);					
				
			
		}
	}



}