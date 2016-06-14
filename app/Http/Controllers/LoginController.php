<?php

namespace App\Http\Controllers;

use JWTAuth;
use Request;
use Auth;
use DB;


use App\Http\Controllers\Controller;

use App\Models\User;

class LoginController extends Controller
{
   
   public function postLogin()
   {
      $credentials = [
         'username'=> Request::input('username'),
         'password'=> (string)Request::input('password')
      ];

      if (Auth::attempt($credentials)) {
         $user = Auth::user();

         $cons = 'SELECT u.id, u.username, u.nombres, u.apellidos, u.sexo, u.email, i.id as image_id, u.is_superuser, u.tipo_usu_id,  
                     IFNULL(i.nombre, if(u.sexo="F", "'.User::$default_female.'", "'.User::$default_male.'") ) as image_nombre
                  from users u
                  left join images i on i.id=u.image_id
                  where u.id=? and i.deleted_at is null and u.deleted_at is null';
         
         $user = DB::select($cons, [$user->id]);

         if (count($user)>0) {
            $user = $user[0];
         }

         if (! $token = JWTAuth::attempt($credentials)){
            return abort(400, 'Token pailas');
         }else{
            $user->token = $token;
         }
      }else {
         return abort(400, 'Credenciales invalidas');
      }

   	return (array)$user;
   }

   public function postVerificar()
   {
      try{
         $user = JWTAuth::parseToken()->authenticate();
         $user = User::datos_usuario_logueado($user);
      } catch (JWTException $e){
         return response()->json(['errror '=>'Al parecer el token expiro'], 401);
      }
      return (array)$user;
   }

   public function putLogout()
   {
      return $usu;
   }

}
