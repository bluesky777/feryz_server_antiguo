<?php namespace App\Http\Controllers\AuditSystem\Models;


use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Database\Eloquent\SoftDeletes;

use DB;
use Request;


class AuUser
{
    
    public static $default_female = 'system/avatars/female1.jpg';
    public static $default_male = 'system/avatars/male1.jpg';
    public static $perfil_path = 'perfil/';




    public static function identificar()
    {
        $usuario    = [];
        $auth       = Request::input('auth');

        $cons = 'SELECT u.*, null as password
            FROM au_users u
            where u.deleted_at is null and u.username=? and u.password=?';

        $user = DB::select($cons, [ $auth['username'], $auth['password'] ]);

        if (count($user)>0) {
            $user = $user[0];
        }else{
            abort(401, 'Usuario inválido');
        }

        return $user;
    }
    
}
