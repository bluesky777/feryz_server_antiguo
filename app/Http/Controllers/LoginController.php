<?php

namespace App\Http\Controllers;

use JWTAuth;
use Request;
use Auth;


use App\Http\Controllers\Controller;

use App\Models\Usuario;

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
         if (! $token = JWTAuth::attempt($credentials)){
            return abort(400, 'Token pailas');
         }else{
            $user->token = $token;
         }
      }else {
         return abort(400, 'Credenciales invalidas');
      }

   	return $user;
   }

   public function postVerificar()
   {
      try{
         $user = JWTAuth::parseToken()->authenticate();
         User::datos_usuario_logueado($user);
      } catch (JWTException $e){
         return response()->json(['errror '=>'Al parecer el token expiro'], 401);
      }
      return $user;
   }

   public function putLogout()
   {
      return $usu;
   }

}
