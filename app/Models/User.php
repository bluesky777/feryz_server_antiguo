<?php namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

use App\Models\ImagenModel;

class User extends Authenticatable
{

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

        $usuario->imagen_nombre = ImagenModel::imagen_de_usuario($usuario->sexo, $usuario->imagen_id);

        $usuario->token = $token;

        return $usuario;
    }
    public static function datos_usuario_logueado(&$usuario)
    {

        User::roles_y_permisos($usuario);

        $usuario->imagen_nombre = ImagenModel::imagen_de_usuario($usuario->sexo, $usuario->imagen_id);


        return $usuario;
    }

}
