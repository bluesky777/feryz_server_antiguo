<?php namespace App\Http\Controllers\AuditSystem;

use Request;
use Hash;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Controllers\AuditSystem\DatosIniciales;
use App\Http\Controllers\AuditSystem\Sincronizar;
use App\Http\Controllers\AuditSystem\Models\DatosDescarga;
use App\Http\Controllers\AuditSystem\Models\AuUser;
use Carbon\Carbon;
use \Log;

use DB;

class LoginController extends Controller {

	public function postLoguear()
	{
		$username 	= Request::input('username');
		$password 	= Request::input('password');
		
		$consulta 	= 'SELECT * FROM au_users WHERE username=? and password=?;';
		$usuario 	= DB::select($consulta, [$username, $password]);
		
		if (count($usuario) > 0) {
            $usuario = $usuario[0];

			
            if(AuUser::hasDivisionRole($usuario->tipo, true)){
                
                $consulta 	= 'SELECT * FROM au_uniones WHERE deleted_at is null';
                $usuario->uniones 	= DB::select($consulta);
                
                if($usuario->union_id > 0){
                    
                    $consulta 	= 'SELECT * FROM au_asociaciones WHERE union_id=? and deleted_at is null';
                    $usuario->asociaciones 	= DB::select($consulta, [$usuario->union_id]);
                    
                }
			}
			
			if($usuario->iglesia_id > 0){
                    
				$consulta 	= 'SELECT i.*, d.nombre as distrito_nombre, d.alias as distrito_alias,
						t.nombres as tesorero_nombres, t.apellidos as tesorero_apellidos, 
                		p.nombres as pastor_nombres, p.apellidos as pastor_apellidos
					FROM au_iglesias i 
					LEFT JOIN au_distritos d ON d.id=i.distrito_id AND d.deleted_at is null 
					LEFT JOIN au_users t ON t.tipo="Tesorero distrital" and t.id=d.tesorero_id and t.deleted_at is null
					LEFT JOIN au_users p ON p.tipo="Pastor" and p.id=d.pastor_id and p.deleted_at is null
					WHERE i.id=? and i.deleted_at is null';
				$iglesia 	= DB::select($consulta, [$usuario->iglesia_id]);
				
				if (count($iglesia) > 0) {
					$usuario->iglesia_nombre 	= $iglesia[0]->nombre;
					$usuario->iglesia_alias 	= $iglesia[0]->alias;
					$usuario->iglesia_codigo 	= $iglesia[0]->codigo;
					$usuario->distrito_nombre 	= $iglesia[0]->distrito_nombre;
					$usuario->distrito_alias 	= $iglesia[0]->distrito_alias;
					$usuario->distrito_pastor 	= $iglesia[0]->pastor_nombres . ' ' . $iglesia[0]->pastor_apellidos;
					$usuario->distrito_tesorero = $iglesia[0]->tesorero_nombres . ' ' . $iglesia[0]->tesorero_apellidos;
				}
				
			}
            
            
			return [$usuario];
		}else{
			return abort(401, 'Datos incorrectos.');
		}
		
	}



}