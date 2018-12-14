<?php namespace App\Http\Controllers\AuditSystem;

use Request;
use Hash;
use Excel;

use App\Http\Controllers\AuditSystem\Models\AuUser;
use App\Http\Controllers\Controller;
use App\Http\Controllers\AuditSystem\DatosIniciales;
use App\Http\Controllers\AuditSystem\Sincronizar;
use Carbon\Carbon;
use \Log;

use DB;

class AuUsuariosController extends Controller {
	
	
	

	public function postStore()
	{
        $user   = AuUser::identificar();
        $now 	= Carbon::now('America/Bogota');
        $data   = Request::input('data');
        
        if (($data['tipo'] == 'Tesorero asociación' || $data['tipo'] == 'Admin') && ($user->tipo == 'Pastor' || $user->tipo == 'Tesorero' || $user->tipo == 'Auditor')) {
            abort(404, 'No puede crear un tipo mayor que usted');
        }
        
        $consulta = 'INSERT INTO au_users(nombres, apellidos, sexo, username, password, email, fecha, tipo, celular, created_by, created_at, updated_at) 
            VALUES(?,?,?,?,?,?,?,?,?,?,?,?)';
            
        DB::insert($consulta, [$data['nombres'], $data['apellidos'], $data['sexo'], $data['username'], $data['password'], $data['email'],
            $data['email'], $data['tipo'], $data['celular'], $user->id, $now, $now]);
        
        $last_id = DB::getPdo()->lastInsertId();
        
        $consulta = 'SELECT u.*, null as password
            FROM au_users u
            where u.deleted_at is null and u.id=?';
            
        $usuario = DB::select($consulta, [$last_id])[0];
        
            
		return (array)$usuario;
		
	}

    
	public function putAll()
	{
        $user   = AuUser::identificar();
        $tipo   = $user->tipo;
        $datos 	= [];
        
        if ($tipo == 'Auditor' || $tipo == 'Tesorero asociación' || $tipo == 'Admin') {
            $consulta 	= "SELECT *, null as password FROM au_users WHERE deleted_at is null ORDER BY id DESC";
        }else if($tipo == 'Tesorero' || $tipo == 'Pastor'){
            //$consulta 	= "SELECT *, null as password FROM au_users WHERE deleted_at is null and (tipo=? or tipo=?) ORDER BY id DESC";
            //$datos 		= ['Tesorero', 'Pastor'];
            abort(404, 'No puede ver usuarios');
        }
        
		$usuarios = DB::select($consulta, $datos);

		return ['usuarios'=> $usuarios];
		
	}
	
	
	public function putUpdate()
	{
        $user = AuUser::identificar();
        $now 	= Carbon::now('America/Bogota');
        $data   = Request::input('data');
        
        if ($data['password']) {
            
            $consulta = 'UPDATE au_users SET nombres=?, apellidos=?, sexo=?, email=?, username=?, password=?,
                fecha=?, tipo=?, celular=?, updated_by=?, updated_at=? WHERE id=?';
                
            DB::update($consulta, [$data['nombres'], $data['apellidos'], $data['sexo'], $data['email'], $data['username'], $data['password'], 
                $data['fecha'], $data['tipo'], $data['celular'], $user->id, $now, $data['id']]);
        }else{
            
            $consulta = 'UPDATE au_users SET nombres=?, apellidos=?, sexo=?, email=?, username=?,
                fecha=?, tipo=?, celular=?, updated_by=?, updated_at=? WHERE id=?';
            
            DB::update($consulta, [$data['nombres'], $data['apellidos'], $data['sexo'], $data['email'], $data['username'], 
                $data['fecha'], $data['tipo'], $data['celular'], $user->id, $now, $data['id']]);
        }
        

		return 'Cambiado';
		
	}
    
    
	public function putUpdateField()
	{
        $user   = AuUser::identificar();
        $now 	= Carbon::now('America/Bogota');
        $data   = Request::input('data');
        
        $consulta = 'UPDATE au_users SET '.$data['field'].'=?, updated_by=?, updated_at=? WHERE id=?';
		DB::update($consulta, [$data['valor'], $user->id, $now, $data['id']]);

		return 'Cambiado';
		
	}
	
    
	public function putDestroy()
	{
        $user   = AuUser::identificar();
        $now 	= Carbon::now('America/Bogota');
        $data   = Request::input('data');
        
        $consulta = 'UPDATE au_users SET deleted_by=?, deleted_at=? WHERE id=?';
		DB::update($consulta, [$user->id, $now, $data['id']]);

		return 'Enviado a papelera';
		
	}
	
	



}