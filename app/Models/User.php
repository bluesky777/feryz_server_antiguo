<?php namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

use DB;


class User extends Authenticatable
{
    protected $table = 'users';

    public static $default_female = 'system/avatars/famale1.jpg';
    public static $default_male = 'system/avatars/male1.jpg';
    public static $perfil_path = 'perfil/';



    protected $hidden = [
        'password', 'remember_token',
    ];


    public static function fromToken($already_parsed=false)
    {
        $usuario = [];
        $token = [];
        try
        {
            if ($already_parsed) {

                $token = $already_parsed;
                $usuario = JWTAuth::toUser($token);

            }else{

                $token = JWTAuth::parseToken();
                
                if ($token){

                    try {
                        $usuario = $token->toUser();
                    } catch (Exception $e) {
                        //Request::header();
                        abort(401, 'error con $token->toUser()');
                    }
                    
                }else if ( !(Request::has('username')) )  {
                    abort(401, 'No existe Token');
                }
            }


            if (!$usuario) {
                abort(401, 'Token inválido, prohibido entrar.');
            }



        }
        catch(JWTException $e)
        {
            abort(401, 'token_expired');
        }


        // *************************************************
        //    Traeremos los roles y permisos
        // *************************************************
        //User::roles_y_permisos($usuario);

        $usuario = User::datos_usuario_logueado($usuario);

        $usuario->token = $token;

        return (array)$usuario;
    }
    public static function datos_usuario_logueado(&$usuario)
    {

        
         $cons = 'SELECT u.id, u.username, u.nombres, u.apellidos, u.sexo, u.email, i.id as image_id, u.is_superuser, u.tipo_usu_id,  
                     IFNULL(i.nombre, if(u.sexo="F", "'.User::$default_female.'", "'.User::$default_male.'") ) as image_nombre
                  FROM users u
                  left join images i on i.id=u.image_id
                  where u.id=? and i.deleted_at is null and u.deleted_at is null';
         
         $user = DB::select($cons, [$usuario->id]);

         if (count($user)>0) {
            $user = $user[0];
         }

        return $user;
    }

}
