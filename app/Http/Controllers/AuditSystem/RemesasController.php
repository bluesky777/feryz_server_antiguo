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
		if(Request::hasFile('file')){
			$path = Request::file('file')->getRealPath();

			$rr = Excel::load($path, function($reader){
				
				$now 		= Carbon::now('America/Bogota');
                $results 	= $reader->all();
                
                if (count($results) > 0) {
                    DB::delete('DELETE FROM au_remesas');
                }
				
				for ($i=0; $i < count($results); $i++) {
					$remesa = $results[$i];
					
					$fecha_format = null;
					
					if ($remesa->fecha) {
						$fecha_format = Carbon::parse($remesa->fecha);
					}
					
					
                    $consulta 	= 'INSERT INTO au_remesas(num_diario, linea, tipo_diario, num_secuencia, periodo, fecha, referencia, cod_cuenta, nombre_cuenta, descripcion_transaccion, cantidad, 
                            iva, moneda, recurso, funcion, restr, org_id, empleados, concepto, created_at, updated_at) 
                        VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);';
                    
                    $datos = [ $remesa->num_diario, $remesa->linea, $remesa->tipo_diario, $remesa->num_secuencia, $remesa->periodo, $remesa->fecha_format, $remesa->referencia, $remesa->cod_cuenta, $remesa->nombre_cuenta, $remesa->descripcion_transaccion, $remesa->cantidad, 
                        $remesa->iva, $remesa->moneda, $remesa->recurso, $remesa->funcion, $remesa->restr, $remesa->orgid, $remesa->empleados, $remesa->concepto, $now, $now ];
                    
                        
                    DB::insert($consulta, $datos);					
						
					
				}
                Log::info('Remesa') ;
				
			});
		}
		return $rr->parsed;
		
	}



}