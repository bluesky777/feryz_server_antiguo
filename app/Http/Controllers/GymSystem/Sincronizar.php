<?php namespace App\Http\Controllers\TaxiDriver;

use Request;
use Hash;

use DB;
use Carbon\Carbon;
use \Log;

class Sincronizar {

    
	public function syncTaxista($tax, $now)
	{
		if (!$tax['id']) {
            $consulta = 'INSERT INTO tx_taxistas(nombres, apellidos, sexo, usuario, documento, celular, password, created_at, updated_at) 
                VALUES(?,?,?,?,?,?,?,?,?);';
            DB::insert($consulta, [$tax['nombres'], $tax['apellidos'], $tax['sexo'], $tax['usuario'], $tax['documento'], $tax['celular'], $tax['password'], $now, $now ]);
        }
        elseif($tax['modificado']){
            Log::info($tax);
            $consulta = 'UPDATE tx_taxistas SET 
                nombres=?, apellidos=?, sexo=?, usuario=?, documento=?, celular=?, password=?, updated_at=? 
                WHERE id=?;';
            DB::update($consulta, [$tax['nombres'], $tax['apellidos'], $tax['sexo'], $tax['usuario'], $tax['documento'], $tax['celular'], $tax['password'], $now, $tax['id'] ]);
        }
        elseif($tax['eliminado']){
            DB::delete('DELETE FROM tx_taxistas WHERE id=?;', [$tax['id']]);
        }
		
		
		return 'Sync';
	}




	public function syncUsers($tax, $now)
	{
		if (!$tax['id']) {
            $consulta = 'INSERT INTO tx_users(nombres, apellidos, sexo, usuario, password, email, fecha_nac, tipo, celular, created_at, updated_at) 
                VALUES(?,?,?,?,?,?,?,?,?,?,?);';
            DB::insert($consulta, [$tax['nombres'], $tax['apellidos'], $tax['sexo'], $tax['usuario'], $tax['password'], $tax['email'], $tax['fecha_nac'], $tax['tipo'], $tax['celular'], $now, $now ]);
        }
        elseif($tax['modificado']){
            $consulta = 'UPDATE tx_users SET 
                nombres=?, apellidos=?, sexo=?, usuario=?, password=?, email=?, fecha_nac=?, tipo=?, celular=?, created_at=?
                WHERE id=?;';
            DB::update($consulta, [$tax['nombres'], $tax['apellidos'], $tax['sexo'], $tax['usuario'], $tax['password'], $tax['email'], $tax['fecha_nac'], $tax['tipo'], $tax['celular'], $now, $tax['id'] ]);
        }
        elseif($tax['eliminado']){
            DB::delete('DELETE FROM tx_users WHERE id=?;', [$tax['id']]);
        }
		
		
		return 'Sync';
	}




}