<?php namespace App\Http\Controllers\AuditSystem;

use Request;
use Hash;

use DB;
use Carbon\Carbon;
use \Log;

class Sincronizar {

	public function syncUniones($elem, $now)
	{
		if (!isset($elem['id'])) {
            $consulta = 'INSERT INTO au_uniones(nombre, alias, codigo, presidente, pais, division_id, created_at, updated_at) 
                VALUES(?,?,?,?,?,?,?,?);';
            DB::insert($consulta, [$elem['nombre'], $elem['alias'], $elem['codigo'], $elem['presidente'], $elem['pais'], $elem['division_id'], $now, $now ]);
        }
        elseif($elem['modificado']){
            $consulta = 'UPDATE au_uniones SET 
                nombre=?, alias=?, codigo=?, presidente=?, pais=?, division_id=?, updated_at=? 
                WHERE id=?;';
            DB::update($consulta, [$elem['nombre'], $elem['alias'], $elem['codigo'], $elem['presidente'], $elem['pais'], $elem['division_id'], $now, $elem['id'] ]);
        }
        elseif($elem['eliminado']){
            DB::delete('DELETE FROM au_uniones WHERE id=?;', [$elem['id']]);
        }
		
		
		return 'Sync';
	}


	public function syncAsociaciones($elem, $now)
	{
		if (!isset($elem['id'])) {
            $consulta = 'INSERT INTO au_asociaciones(nombre, alias, codigo, zona, union_id, tesorero_id, created_at, updated_at) 
                VALUES(?,?,?,?,?,?,?,?);';
            DB::insert($consulta, [$elem['nombre'], $elem['alias'], $elem['codigo'], $elem['zona'], $elem['union_id'], $elem['tesorero_id'], $now, $now ]);
        }
        elseif($elem['modificado']){
            $consulta = 'UPDATE au_asociaciones SET 
                nombre=?, alias=?, codigo=?, zona=?, union_id=?, tesorero_id=?, updated_at=? 
                WHERE id=?;';
            DB::update($consulta, [$elem['nombre'], $elem['alias'], $elem['codigo'], $elem['zona'], $elem['union_id'], $elem['tesorero_id'], $now, $elem['id'] ]);
        }
        elseif($elem['eliminado']){
            DB::delete('DELETE FROM au_asociaciones WHERE id=?;', [$elem['id']]);
        }
		
		
		return 'Sync';
	}


	public function syncDistritos($elem, $now)
	{
		if (!isset($elem['id'])) {
            $consulta = 'INSERT INTO au_distritos(nombre, alias, codigo, zona, pastor_id, tesorero_id, created_at, updated_at) 
                VALUES(?,?,?,?,?,?,?,?);';
            DB::insert($consulta, [$elem['nombre'], $elem['alias'], $elem['codigo'], $elem['zona'], $elem['pastor_id'], $elem['tesorero_id'], $now, $now ]);
        }
        elseif($elem['modificado']){
            $consulta = 'UPDATE au_distritos SET 
                nombre=?, alias=?, codigo=?, zona=?, pastor_id=?, tesorero_id=?, updated_at=? 
                WHERE id=?;';
            DB::update($consulta, [$elem['nombre'], $elem['alias'], $elem['codigo'], $elem['zona'], $elem['pastor_id'], $elem['tesorero_id'], $now, $elem['id'] ]);
        }
        elseif($elem['eliminado']){
            DB::delete('DELETE FROM au_distritos WHERE id=?;', [$elem['id']]);
        }
		
		
		return 'Sync';
	}



	public function syncIglesias($elem, $now)
	{
		if (!isset($elem['id'])) {
            $consulta = 'INSERT INTO au_iglesias(nombre, alias, codigo, zona, distrito_id, tesorero_id, secretario_id, created_at, updated_at, tipo_propiedad, anombre_propiedad, fecha_propiedad, fecha_fin, tipo_propiedad2, anombre_propiedad2, fecha_propiedad2, fecha_fin2, tipo_propiedad3, anombre_propiedad3, fecha_propiedad3, fecha_fin3) 
                VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);';
            DB::insert($consulta, [$elem['nombre'], $elem['alias'], $elem['codigo'], $elem['zona'], $elem['distrito_id'], $elem['tesorero_id'], $elem['secretario_id'], $now, $now, $elem['tipo_propiedad'], $elem['anombre_propiedad'], $elem['fecha_propiedad'], $elem['fecha_fin'], $elem['tipo_propiedad2'], $elem['anombre_propiedad2'], $elem['fecha_propiedad2'], $elem['fecha_fin2'], $elem['tipo_propiedad3'], $elem['anombre_propiedad3'], $elem['fecha_propiedad3'], $elem['fecha_fin3'] ]);
        }
        elseif($elem['modificado']){
            $consulta = 'UPDATE au_iglesias SET 
                nombre=?, alias=?, codigo=?, zona=?, distrito_id=?, tesorero_id=?, secretario_id=?, updated_at=?, tipo_propiedad=?, anombre_propiedad=?, fecha_propiedad=?, fecha_fin=?, tipo_propiedad2=?, anombre_propiedad2=?, fecha_propiedad2=?, fecha_fin2=?, tipo_propiedad3=?, anombre_propiedad3=?, fecha_propiedad3=?, fecha_fin3=? 
                WHERE id=?;';
            DB::update($consulta, [$elem['nombre'], $elem['alias'], $elem['codigo'], $elem['zona'], $elem['distrito_id'], $elem['tesorero_id'], $elem['secretario_id'], $now, $elem['tipo_propiedad'], $elem['anombre_propiedad'], $elem['fecha_propiedad'], $elem['fecha_fin'], $elem['tipo_propiedad2'], $elem['anombre_propiedad2'], $elem['fecha_propiedad2'], $elem['fecha_fin2'], $elem['tipo_propiedad3'], $elem['anombre_propiedad3'], $elem['fecha_propiedad3'], $elem['fecha_fin3'], $elem['id'] ]);
        }
        elseif($elem['eliminado']){
            DB::delete('DELETE FROM au_iglesias WHERE id=?;', [$elem['id']]);
        }
		
		
		return 'Sync';
	}


	public function syncUsuarios($elem, $now)
	{
		if (!isset($elem['id'])) {
            $consulta = 'INSERT INTO au_users(nombres, apellidos, email, sexo, fecha, tipo, is_active, created_at, updated_at, distrito_id, iglesia_id, auditoria_id, celular, usuario, password) 
                VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);';
            DB::insert($consulta, [$elem['nombres'], $elem['apellidos'], $elem['email'], $elem['sexo'], $elem['fecha'], $elem['tipo'], $elem['is_active'], $now, $now, $elem['distrito_id'], $elem['iglesia_id'], $elem['auditoria_id'], $elem['celular'], $elem['username'], $elem['password'] ]);
            Log::info($consulta. $elem['nombres'].' - '. $elem['apellidos'].' - '. $elem['email'].' - '. $elem['sexo'].' - '. $elem['fecha'].' - '. $elem['tipo'].' - '. $elem['is_active'].' - '. $elem['distrito_id'].' - '. $elem['iglesia_id'].' - '. $elem['auditoria_id'].' - '. $elem['celular'].' - '. $elem['username'].' - '.$elem['password']);
        }
        elseif($elem['modificado']){
            $consulta = 'UPDATE au_users SET 
                nombres=?, apellidos=?, email=?, sexo=?, fecha=?, tipo=?, is_active=?, updated_at=?, distrito_id=?, iglesia_id=?, auditoria_id=?, celular=?, usuario=?, password=? 
                WHERE id=?;';
            DB::update($consulta, [$elem['nombres'], $elem['apellidos'], $elem['email'], $elem['sexo'], $elem['fecha'], $elem['tipo'], $elem['is_active'], $now, $elem['distrito_id'], $elem['iglesia_id'], $elem['auditoria_id'], $elem['celular'], $elem['username'], $elem['password'] ]);
        }
        elseif($elem['eliminado']){
            DB::delete('DELETE FROM au_users WHERE id=?;', [$elem['id']]);
        }
		
		
		return 'Sync';
	}


	public function syncAuditorias($elem, $now)
	{
		if (!isset($elem['id'])) {
            $consulta = 'INSERT INTO au_auditorias(fecha, hora, saldo_ant, ingre_por_registrar, ingre_sabados, cta_por_pagar, ajuste_por_enviar, saldo_banco, consig_fondos_confia, gastos_mes_por_regis, dinero_efectivo, cta_por_cobrar, iglesia_id, created_at, updated_at) 
                VALUES(?,?,?,?,?,?);';
            DB::insert($consulta, [$elem['fecha'], $elem['hora'], $elem['saldo_ant'], $elem['ingre_por_registrar'], $elem['ingre_sabados'], $elem['cta_por_pagar'], $elem['ajuste_por_enviar'], $elem['saldo_banco'], $elem['consig_fondos_confia'], $elem['gastos_mes_por_regis'], $elem['dinero_efectivo'], $elem['cta_por_cobrar'], $elem['iglesia_id'], $now, $now ]);
        }
        elseif($elem['modificado']){
            $consulta = 'UPDATE au_auditorias SET 
                fecha=?, hora=?, saldo_ant=?, ingre_por_registrar=?, ingre_sabados=?, cta_por_pagar=?, ajuste_por_enviar=?, saldo_banco=?, consig_fondos_confia=?, gastos_mes_por_regis=?, dinero_efectivo=?, cta_por_cobrar=?, iglesia_id=?, updated_at=? 
                WHERE id=?;';
            DB::update($consulta, [$elem['fecha'], $elem['hora'], $elem['saldo_ant'], $elem['ingre_por_registrar'], $elem['ingre_sabados'], $elem['cta_por_pagar'], $elem['ajuste_por_enviar'], $elem['saldo_banco'], $elem['consig_fondos_confia'], $elem['gastos_mes_por_regis'], $elem['dinero_efectivo'], $elem['cta_por_cobrar'], $elem['iglesia_id'], $now, $elem['id'], $elem['id'] ]);
        }
        elseif($elem['eliminado']){
            DB::delete('DELETE FROM au_auditorias WHERE id=?;', [$elem['id']]);
        }
		
		
		return 'Sync';
	}


	public function syncLib_mensuales($elem, $now)
	{
		if (!isset($elem['id'])) {
            $consulta = 'INSERT INTO au_lib_mensuales(year, mes, orden, auditoria_id, diezmos, ofrendas, especiales, gastos, gastos_soportados, remesa_enviada, created_at, updated_at) 
                VALUES(?,?,?,?,?,?,?,?,?,?,?,?);';
            DB::insert($consulta, [$elem['year'], $elem['mes'], $elem['orden'], $elem['auditoria_id'], $elem['diezmos'], $elem['ofrendas'], $elem['especiales'], $elem['gastos'], $elem['gastos_soportados'], $elem['remesa_enviada'], $now, $now ]);
        }
        elseif($elem['modificado']){
            $consulta = 'UPDATE au_lib_mensuales SET 
                year=?, mes=?, orden=?, auditoria_id=?, diezmos=?, ofrendas=?, especiales=?, gastos=?, gastos_soportados=?, remesa_enviada=?, updated_at=? 
                WHERE id=?;';
            DB::update($consulta, [$elem['year'], $elem['mes'], $elem['orden'], $elem['auditoria_id'], $elem['diezmos'], $elem['ofrendas'], $elem['especiales'], $elem['gastos'], $elem['gastos_soportados'], $elem['remesa_enviada'], $now, $elem['id'] ]);
        }
        elseif($elem['eliminado']){
            DB::delete('DELETE FROM au_lib_mensuales WHERE id=?;', [$elem['id']]);
        }
		
		
		return 'Sync';
	}


	public function syncLib_semanales($elem, $now)
	{
		if (!isset($elem['id'])) {
            $consulta = 'INSERT INTO au_lib_semanales(year, mes, orden, auditoria_id, diezmos, ofrendas, especiales, gastos, gastos_soportados, remesa_enviada, created_at, updated_at) 
                VALUES(?,?,?,?,?,?,?,?,?,?,?,?);';
            DB::insert($consulta, [$elem['year'], $elem['mes'], $elem['orden'], $elem['auditoria_id'], $elem['diezmos'], $elem['ofrendas'], $elem['especiales'], $elem['gastos'], $elem['gastos_soportados'], $elem['remesa_enviada'], $now, $now ]);
        }
        elseif($elem['modificado']){
            $consulta = 'UPDATE au_lib_semanales SET 
                year=?, mes=?, orden=?, auditoria_id=?, diezmos=?, ofrendas=?, especiales=?, gastos=?, gastos_soportados=?, remesa_enviada=?, updated_at=? 
                WHERE id=?;';
            DB::update($consulta, [$elem['year'], $elem['mes'], $elem['orden'], $elem['auditoria_id'], $elem['diezmos'], $elem['ofrendas'], $elem['especiales'], $elem['gastos'], $elem['gastos_soportados'], $elem['remesa_enviada'], $now ]);
        }
        elseif($elem['eliminado']){
            DB::delete('DELETE FROM au_lib_semanales WHERE id=?;', [$elem['id']]);
        }
		
		
		return 'Sync';
	}


	public function syncDestinos($elem, $now)
	{
		if (!isset($elem['id'])) {
            $consulta = 'INSERT INTO au_destinos(iglesia_id, nombre, descripcion, created_at, updated_at) 
                VALUES(?,?,?,?,?,?,?,?,?,?,?,?);';
            DB::insert($consulta, [$elem['iglesia_id'], $elem['nombre'], $elem['descripcion'], $now, $now ]);
        }
        elseif($elem['modificado']){
            $consulta = 'UPDATE au_destinos SET 
                iglesia_id=?, nombre=?, descripcion=?, updated_at=? 
                WHERE id=?;';
            DB::update($consulta, [$elem['iglesia_id'], $elem['nombre'], $elem['descripcion'], $now ]);
        }
        elseif($elem['eliminado']){
            DB::delete('DELETE FROM au_destinos WHERE id=?;', [$elem['id']]);
        }
		
		
		return 'Sync';
	}


	public function syncDestinos_pagos($elem, $now)
	{
		if (!isset($elem['id'])) {
            $consulta = 'INSERT INTO au_destinos_pagos(destino_id, libro_mes_id, pago, fecha, descripcion, created_at, updated_at) 
                VALUES(?,?,?,?,?,?,?);';
            DB::insert($consulta, [$elem['destino_id'], $elem['libro_mes_id'], $elem['pago'], $elem['fecha'], $elem['descripcion'], $now, $now ]);
        }
        elseif($elem['modificado']){
            $consulta = 'UPDATE au_destinos_pagos SET 
                destino_id=?, libro_mes_id=?, pago=?, fecha=?, descripcion=?, updated_at=? 
                WHERE id=?;';
            DB::update($consulta, [$elem['destino_id'], $elem['libro_mes_id'], $elem['pago'], $elem['fecha'], $elem['descripcion'], $now ]);
        }
        elseif($elem['eliminado']){
            DB::delete('DELETE FROM au_destinos_pagos WHERE id=?;', [$elem['id']]);
        }
		
		
		return 'Sync';
	}

    
	public function syncGastos_mes($elem, $now)
	{
		if (!isset($elem['id'])) {
            $consulta = 'INSERT INTO au_gastos_mes(libro_mes_id, auditoria_id, valor, descripcion, created_at, updated_at) 
                VALUES(?,?,?,?,?,?);';
            DB::insert($consulta, [$elem['libro_mes_id'], $elem['auditoria_id'], $elem['valor'], $elem['descripcion'], $now, $now ]);
        }
        elseif($elem['modificado']){
            $consulta = 'UPDATE au_gastos_mes SET 
                libro_mes_id=?, auditoria_id=?, valor=?, descripcion=?, updated_at=? 
                WHERE id=?;';
            DB::update($consulta, [$elem['libro_mes_id'], $elem['auditoria_id'], $elem['valor'], $elem['descripcion'], $now, $elem['id'] ]);
        }
        elseif($elem['eliminado']){
            DB::delete('DELETE FROM au_gastos_mes WHERE id=?;', [$elem['id']]);
        }
		return 'Sync';
	}


	public function syncDinero_efectivo($elem, $now)
	{
		if (!isset($elem['id'])) {
            $consulta = 'INSERT INTO au_dinero_efectivo(auditoria_id, valor, descripcion, created_at, updated_at) 
                VALUES(?,?,?,?,?,?);';
            DB::insert($consulta, [$elem['auditoria_id'], $elem['valor'], $elem['descripcion'], $now, $now ]);
        }
        elseif($elem['modificado']){
            $consulta = 'UPDATE au_dinero_efectivo SET 
                auditoria_id=?, valor=?, descripcion=?, updated_at=? 
                WHERE id=?;';
            DB::update($consulta, [$elem['auditoria_id'], $elem['valor'], $elem['descripcion'], $now, $elem['id'] ]);
        }
        elseif($elem['eliminado']){
            DB::delete('DELETE FROM au_dinero_efectivo WHERE id=?;', [$elem['id']]);
        }
		return 'Sync';
	}


    
	public function syncPreguntas($elem, $now)
	{
		if (!isset($elem['id'])) {
            $consulta = 'INSERT INTO au_preguntas(definition, tipo, option1, option2, option3, option4, created_at, updated_at) 
                VALUES(?,?,?,?,?,?,?,?);';
            DB::insert($consulta, [$elem['definition'], $elem['tipo'], $elem['option1'], $elem['option2'], $elem['option3'], $elem['option4'], $now, $now ]);
        }
        elseif($elem['modificado']){
            $consulta = 'UPDATE au_preguntas SET 
                destino_id=?, definition=?, tipo=?, option1=?, option2=?, option3=?, option4=?, updated_at=? 
                WHERE id=?;';
            DB::update($consulta, [$elem['destino_id'], $elem['definition'], $elem['option1'], $elem['option2'], $elem['option3'], $elem['option4'], $now, $elem['id'] ]);
        }
        elseif($elem['eliminado']){
            DB::delete('DELETE FROM au_preguntas WHERE id=?;', [$elem['id']]);
        }
		return 'Sync';
	}


	public function syncRespuestas($elem, $now)
	{
		if (!isset($elem['id'])) {
            $consulta = 'INSERT INTO au_respuestas(pregunta_id, auditoria_id, respuestas, created_at, updated_at) 
                VALUES(?,?,?,?,?);';
            DB::insert($consulta, [$elem['pregunta_id'], $elem['auditoria_id'], $elem['respuestas'], $now, $now ]);
        }
        elseif($elem['modificado']){
            $consulta = 'UPDATE au_respuestas SET 
                pregunta_id=?, auditoria_id=?, tipo=?, respuestas=?, updated_at=? 
                WHERE id=?;';
            DB::update($consulta, [$elem['pregunta_id'], $elem['auditoria_id'], $elem['respuestas'], $now, $elem['id'] ]);
        }
        elseif($elem['eliminado']){
            DB::delete('DELETE FROM au_respuestas WHERE id=?;', [$elem['id']]);
        }
		return 'Sync';
	}


	public function syncRecomendas($elem, $now)
	{
		if (!isset($elem['id'])) {
            Log::info('Recomendacion: '.$elem['auditoria_id']. ' - '. $elem['recomendacion']);
            $consulta = 'INSERT INTO au_recomendaciones(auditoria_id, hallazgo, recomendacion, justificacion, superada, fecha, tipo, created_at, updated_at) 
                VALUES(?,?,?,?,?,?,?,?,?);';
            DB::insert($consulta, [$elem['auditoria_id'], $elem['hallazgo'], $elem['recomendacion'], $elem['justificacion'], $elem['superada'], $elem['fecha'], $elem['tipo'], $now, $now ]);
        }
        elseif($elem['modificado']){
            $consulta = 'UPDATE au_recomendaciones SET 
                auditoria_id=?, hallazgo=?, recomendacion=?, justificacion=?, superada=?, fecha=?, tipo=?, updated_at=? 
                WHERE id=?;';
            DB::update($consulta, [$elem['auditoria_id'], $elem['hallazgo'], $elem['recomendacion'], $elem['justificacion'], $elem['superada'], $elem['fecha'], $elem['tipo'], $now, $elem['id'] ]);
        }
        elseif($elem['eliminado']){
            DB::delete('DELETE FROM au_recomendaciones WHERE id=?;', [$elem['id']]);
        }
		return 'Sync';
	}





}