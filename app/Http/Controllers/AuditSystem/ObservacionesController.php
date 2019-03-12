<?php namespace App\Http\Controllers\AuditSystem;

use Request;
use Hash;
use File;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Controllers\AuditSystem\DatosIniciales;
use App\Http\Controllers\AuditSystem\Sincronizar;
use Carbon\Carbon;
use \Log;
use App\Models\ImagenModel;

use DB;

class ObservacionesController extends Controller {
	
	public function putCorrespondientes(){
		$tipo 				= Request::input('tipo_usu');
		$id_usu 			= Request::input('id_usu');
		$recomendaciones 	= [];
		
		if ($tipo == 'Pastor') {
			
			$consulta   = "SELECT r.* FROM au_recomendaciones r 
				LEFT JOIN au_auditorias a ON a.id=r.auditoria_id and a.deleted_at is null
				LEFT JOIN au_iglesias i ON i.id=a.iglesia_id and i.deleted_at is null
				LEFT JOIN au_distritos d ON d.id=i.distrito_id and d.deleted_at is null
				LEFT JOIN au_users u ON u.id=d.pastor_id and u.deleted_at is null
				WHERE u.id=? and r.deleted_at is null";
				
			$recomendaciones     = DB::select($consulta, [$id_usu]);
		}
		
		
		if ($tipo == 'Auditor') {
			
			$consulta   = "SELECT r.* FROM au_recomendaciones r 
				LEFT JOIN au_auditorias a ON a.id=r.auditoria_id and a.deleted_at is null
				LEFT JOIN au_iglesias i ON i.id=a.iglesia_id and i.deleted_at is null
				LEFT JOIN au_distritos d ON d.id=i.distrito_id and d.deleted_at is null
				LEFT JOIN au_asociaciones aso ON aso.id=d.asociacion_id and aso.deleted_at is null
				LEFT JOIN au_users u ON u.asociacion_id=aso.id and u.deleted_at is null
				WHERE u.id=? and r.deleted_at is null";
			
			$recomendaciones     = DB::select($consulta, [$id_usu]);
				
		}
		
		
        
        return $recomendaciones;
    }
    
	
	public function putGuardarJustificacion(){
		$tipo 				= Request::input('tipo_usu');
		$id_usu 			= Request::input('id_usu');
		$recomendacion 		= Request::input('recomendacion');
		
		if ($tipo == 'Pastor') {
			
			$consulta   = "UPDATE au_recomendaciones SET justificacion=? WHERE id=?";
				
			DB::update($consulta, [$recomendacion['justificacion'], $recomendacion['id']]);
		}
		
		
		
        
        return 'Guardada';
    }
    
	
	public function putQuitarIglesia(){
        $id             = Request::input('imagen_id');
        
        $consulta   = "UPDATE au_images SET iglesia_id=NULL WHERE id=?";
        $images     = DB::update($consulta, [$id]);
        return 'Quitada';
    }
    
	


}