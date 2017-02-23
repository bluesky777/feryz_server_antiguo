<?php namespace App\Http\Controllers;

use Request;
use Hash;
use App\Models\User;
use App\Models\Proveedor;
use App\Models\Categoria;
use App\Models\Producto;
use App\Models\Compra;

class ComprasController extends Controller {

	public function getAll()
	{
		return Producto::all();
	}


	public function putDatos()
	{
		$res = [];
		$res['productos'] 	= Producto::all();
		$res['proveedores'] = Proveedor::all();
		$res['categorias'] 	= Categoria::all();

		return $res;
	}

	public function postGuardar()
	{
		$user = User::fromToken();

		$prod = new Producto;

		$prod->nombre 			= Request::input('nombre');
		$prod->unidad_medida 	= Request::input('unidad_medida')['unidad'];
		$prod->codigo_barras 	= Request::input('codigo_barras');
		$prod->categoria_id 	= Request::input('categoria')['id'];
		$prod->precio_compra 	= Request::input('precio_compra');
		$prod->precio_venta 	= Request::input('precio_venta');
		$prod->cantidad_minima 	= Request::input('cantidad_minima');
		$prod->iva 				= Request::input('iva');
		$prod->nota 			= Request::input('nota');
		$prod->activo 			= Request::input('activo');
		$prod->created_by 		= $user['id'];
		$prod->save();

		return $prod;
	}


	public function putActualizar()
	{
		$user = User::fromToken();

		$prod = Producto::find(Request::input('id'));

		if (is_array(Request::input('categoria'))) {
			Request::merge(['categoria_id' => Request::input('categoria')['id']]);
		} 
		if (is_array(Request::input('unidad_medida'))) {
			Request::merge(['unidad_medida' => Request::input('unidad_medida')['unidad']]);
		} 

		$prod->nombre 			= Request::input('nombre');
		$prod->unidad_medida 	= Request::input('unidad_medida');
		$prod->codigo_barras 	= Request::input('codigo_barras');
		$prod->categoria_id 	= Request::input('categoria_id');
		$prod->precio_compra 	= Request::input('precio_compra');
		$prod->precio_venta 	= Request::input('precio_venta');
		$prod->cantidad_minima 	= Request::input('cantidad_minima');
		$prod->iva 				= Request::input('iva');
		$prod->nota 			= Request::input('nota');
		$prod->activo 			= Request::input('activo');
		$prod->updated_by 		= $user['id'];
		$prod->save();

		return 'Cambiado';
	}



	public function deleteDestroy($id)
	{
		$user 				= User::fromToken();

		$prod 				= Producto::findOrFail($id);
		$prod->deleted_by 	= $user['id'];
		$prod->save();
		$prod->delete();
		return $prod;
	}

}