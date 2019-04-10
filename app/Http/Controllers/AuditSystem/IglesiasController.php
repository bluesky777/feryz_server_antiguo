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

class IglesiasController extends Controller {
    
    
	public function putIndex(){
        
        $tipo_usu   = Request::input('tipo_usu');
        $usu_id     = Request::input('usu_id');
        $asociacion_id     = Request::input('asociacion_id');
        
        
        if ($tipo_usu == 'Pastor') {
            
            $consulta       = "SELECT *, id as rowid FROM au_distritos d WHERE d.pastor_id=? AND d.deleted_at is null";
            $distritos      = DB::select($consulta, [$usu_id]);
            
            for ($i=0; $i < count($distritos); $i++) { 
                $consulta                   = "SELECT *, id as rowid FROM au_iglesias i WHERE i.distrito_id=? AND i.deleted_at is null";
                $distritos[$i]->iglesias    = DB::select($consulta, [ $distritos[$i]->id ]);
                
            }
            
            
            return $distritos;
        }
        
        if ($tipo_usu == 'Auditor') {
            
            
            $consulta       = "SELECT *, id as rowid FROM au_distritos d WHERE d.asociacion_id=? AND d.deleted_at is null";
            $distritos      = DB::select($consulta, [$asociacion_id]);
            
            for ($i=0; $i < count($distritos); $i++) { 
                $consulta                   = "SELECT *, id as rowid FROM au_iglesias i WHERE i.distrito_id=? AND i.deleted_at is null";
                $distritos[$i]->iglesias    = DB::select($consulta, [ $distritos[$i]->id ]);
                
            }
            
            
            return $distritos;
        }
        
    }
    
	

}