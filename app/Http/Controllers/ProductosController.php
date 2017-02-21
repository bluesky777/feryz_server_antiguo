<?php namespace App\Http\Controllers;

use Request;
use Hash;
use App\Models\User;
use App\Models\Proveedor;
use App\Models\Categoria;
use App\Models\Producto;

class ProductosController extends Controller {

	public function getAll()
	{
		return Producto::all();
	}

	public function postGuardar()
	{
		$user = User::fromToken();

		$prod = new Producto;

		$prod->nombre 			= Request::input('nombre');
		$prod->unidad_medida 	= Request::input('unidad_medida')['unidad'];
		$prod->categoria_id 	= Request::input('categoria')['id'];
		$prod->precio_compra 	= Request::input('precio_compra');
		$prod->precio_venta 	= Request::input('precio_venta');
		$prod->cantidad 		= Request::input('cantidad');
		$prod->nota 			= Request::input('nota');
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
		$prod->categoria_id 	= Request::input('categoria_id');
		$prod->precio_compra 	= Request::input('precio_compra');
		$prod->precio_venta 	= Request::input('precio_venta');
		$prod->cantidad 		= Request::input('cantidad');
		$prod->nota 			= Request::input('nota');
		$prod->save();

		return 'Cambiado';
	}



	public function deleteDestroy($id)
	{
		$prod = Producto::findOrFail($id);
		$prod->delete();
		return $prod;
	}

}