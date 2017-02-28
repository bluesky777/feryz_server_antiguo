<?php namespace App\Http\Controllers;

use Request;
use Hash;
use App\Models\User;
use App\Models\Proveedor;
use App\Models\Categoria;
use App\Models\Producto;
use App\Models\Compra;

use DB;
use Carbon\Carbon;

class ComprasController extends Controller {

	public function getAll()
	{
		return Producto::all();
	}

	public function putAll()
	{
		$res = [];

		$cons = "SELECT * FROM compras c WHERE c.deleted_at is null";
		$compras = DB::select($cons);

		$res['compras'] = $compras;

		return $res;
	}


	public function putDatos()
	{
		$res = [];
		$res['productos'] 	= Producto::all();
		$res['proveedores'] = Proveedor::all();
		$res['categorias'] 	= Categoria::all();

		$cons = "SELECT id, codigo_barras, nombre FROM productos WHERE codigo_barras is not null and deleted_at is null";
		$codigos_barras = DB::select($cons);

		$res['codigos_barras'] 	= $codigos_barras;

		return $res;
	}

	public function postGuardar()
	{
		$user = User::fromToken();

		$fecha 			= Request::input('compra')['fecha'];
		$proveedor_id 	= Request::input('compra')['proveedor']['id'];

		//$date = Carbon::createFromFormat('Y-m-d H:i:s', new \DateTime());
		$now = new \DateTime();
		$now->format('Y-m-d H:i:s');

		$consulta = "INSERT INTO compras(fecha, proveedor_id, created_by, created_at, updated_at) VALUES (:fecha, :proveedor_id, :user_id, :created_at, :updated_at)";
		$insertado = DB::insert($consulta, [ ':fecha' => $fecha, ':proveedor_id' => $proveedor_id, ':user_id' => $user['id'], ':created_at' => $now, ':updated_at' => $now ]);

		$compra_id = DB::getPdo()->lastInsertId();

		
		$productos 	= Request::input('productos');
		$cant 		= count($productos);

		for ($i=0; $i < $cant; $i++) { 
			
			$consulta = "INSERT INTO compra_detalles(compra_id, producto_id, cantidad, precio_compra, precio_venta) VALUES (:compra_id, :producto_id, :cantidad, :precio_compra, :precio_venta)";
			$insertado = DB::insert($consulta, [ ':compra_id' 		=> $compra_id, 
												':producto_id' 		=> $productos[$i]['producto_id'], 
												':cantidad' 		=> $productos[$i]['cantidad'], 
												':precio_compra' 	=> $productos[$i]['precio_compra'], 
												':precio_venta' 	=> $productos[$i]['precio_venta'] ]);

		}

		return $compra_id;
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