<?php namespace App\Http\Controllers\AuditSystem;

use Request;
use Hash;
use File;

use App\Http\Controllers\Controller;
use App\Http\Controllers\AuditSystem\DatosIniciales;
use App\Http\Controllers\AuditSystem\Sincronizar;
use Carbon\Carbon;
use \Log;
use App\Models\ImagenModel;
use App\Http\Controllers\AuditSystem\Models\AuUser;


use DB;

class IglesiasController extends Controller {
    
    
	public function putDeAsociacion(){
        
        $tipo_usu               = Request::input('tipo_usu');
        $usu_id                 = Request::input('usu_id');
        $asociacion_id          = Request::input('asociacion_id');
        $cambiando_asociacion   = Request::input('cambiando_asociacion');
        
        if ($cambiando_asociacion) {
            DB::update('UPDATE au_users SET asociacion_id=? WHERE id=?', [$asociacion_id, $usu_id]);
        }
        
        
        if ($tipo_usu == 'Pastor' || $tipo_usu == 'Tesorero') {
            
            $consulta       = "SELECT *, id as rowid FROM au_distritos d WHERE d.pastor_id=? AND d.deleted_at is null";
            $distritos      = DB::select($consulta, [$usu_id]);
            
            for ($i=0; $i < count($distritos); $i++) { 
                $consulta                   = "SELECT i.*, i.id as rowid, d.nombre as nombre_distrito, d.alias as alias_distrito, d.codigo as codigo_alias, CONCAT(u.nombres, ' ', u.apellidos ) as nombre_pastor, CONCAT(t.nombres, ' ', t.apellidos ) as nombre_tesorero 
                    FROM au_iglesias i 
                    LEFT JOIN au_distritos d ON d.id=i.distrito_id and d.deleted_at is null 
                    LEFT JOIN au_users u ON u.id=d.pastor_id and u.deleted_at is null 
                    LEFT JOIN au_users t ON t.id=i.tesorero_id and t.deleted_at is null 
                    WHERE i.distrito_id=? AND i.deleted_at is null";
                $distritos[$i]->iglesias    = DB::select($consulta, [ $distritos[$i]->id ]);
                
            }
            
            
            return $distritos;
        }
        
        
        if (AuUser::hasAsociacionRole($tipo_usu, true) || AuUser::hasDivisionRole($tipo_usu) || AuUser::hasUnionRole($tipo_usu)) {
            
            $consulta       = "SELECT *, id as rowid FROM au_distritos d WHERE d.asociacion_id=? AND d.deleted_at is null";
            $distritos      = DB::select($consulta, [$asociacion_id]);
            
            for ($i=0; $i < count($distritos); $i++) { 
                $consulta                   = "SELECT i.*, i.id as rowid, d.nombre as nombre_distrito, d.alias as alias_distrito, d.codigo as codigo_alias, CONCAT(u.nombres, ' ', u.apellidos ) as nombre_pastor, CONCAT(t.nombres, ' ', t.apellidos ) as nombre_tesorero 
                    FROM au_iglesias i 
                    LEFT JOIN au_distritos d ON d.id=i.distrito_id and d.deleted_at is null 
                    LEFT JOIN au_users u ON u.id=d.pastor_id and u.deleted_at is null 
                    LEFT JOIN au_users t ON t.id=i.tesorero_id and t.deleted_at is null 
                    WHERE i.distrito_id=? AND i.deleted_at is null";
                $distritos[$i]->iglesias    = DB::select($consulta, [ $distritos[$i]->id ]);
                
            }
            
            
            return $distritos;
        }
        
        
        
    }
    
	

}