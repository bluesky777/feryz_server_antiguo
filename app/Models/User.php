<?php namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Database\Eloquent\SoftDeletes;

use DB;


class User extends Authenticatable
{
    use SoftDeletes;

    protected $softDelete = true;
    
    protected $table = 'users';

    public static $default_female = 'system/avatars/female1.jpg';
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

        
         $cons = 'SELECT c.nombre_empresa, c.telefono, c.logo_id, c.ciudad_id, c.direccion, c.impuesto1, c.impuesto2, c.impuesto3, 
                    c.utilidad1, c.utilidad2, c.utilidad3, c.deci_entrada, c.deci_salida, c.deci_total, 
                    u.id, u.username, u.nombres, u.apellidos, u.sexo, u.email, i.id as image_id, u.is_superuser, u.tipo,  
                     IFNULL(i.nombre, if(u.sexo="F", "'.User::$default_female.'", "'.User::$default_male.'") ) as image_nombre
                  FROM configuracion c, users u
                  left join images i on i.id=u.imagen_id
                  where u.id=? and i.deleted_at is null and u.deleted_at is null';
         
         $user = DB::select($cons, [$usuario->id]);

         if (count($user)>0) {
            $user = $user[0];
         }

        return $user;
    }

}
