<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Empleado;


class EmpleadosController extends Controller
{
    public function getAll()
   {
   		return Empleado::all();
   }

   public function postGuardar()
   {
   	$emp = new Empleado;
   	$emp->nombre= Request::input('nombre');
   	$emp->cargo= Request::input('cargo');
   	$emp->salario= Request::input('salario');
   	$emp->save();

   	return $emp;
   }
   public function putActualizar()
   {
   	$emp = Empleado::find(Request::input('id'));
   	$emp->nombre= input('nombre');
   	$emp->cargo= input('cargo');
   	$emp->salario= input('salario');
   	$emp->save();	
   	return $emp;
   }
   public function deleteEliminar($id)
   {
   	$emp= Empleado::findOrFail($id);
   	$emp->delete();

   	return $emp;
   }
}
