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

class AsociacionesController extends Controller {
    
    
	public function putDeUnion(){
        
        $tipo_usu               = Request::input('tipo_usu');
        $usu_id                 = Request::input('usu_id');
        $union_id               = Request::input('union_id');
        $cambiando_union        = Request::input('cambiando_union');
        
        if ($cambiando_union) {
            DB::update('UPDATE au_users SET union_id=? WHERE id=?', [$union_id, $usu_id]);
        }
    
    
        $consulta       = "SELECT *, id as rowid FROM au_asociaciones d WHERE d.union_id=? AND d.deleted_at is null";
        $asociaciones   = DB::select($consulta, [$union_id]);
        
        
        
        return $asociaciones;

        
        
        
    }
    
	

}