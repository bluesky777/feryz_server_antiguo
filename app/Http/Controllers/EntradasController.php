<?php namespace App\Http\Controllers;

use Request;
use Hash;
use App\Models\User;
use App\Models\Proveedor;
use App\Models\Categoria;
use App\Models\Producto;
use App\Models\Entrada;

use DB;
use Carbon\Carbon;

class EntradasController extends Controller {

	public function getAll()
	{
		return Producto::all();
	}

	public function putAll()
	{
		$res = [];

		$cons = "SELECT * FROM entradas c WHERE c.deleted_at is null";
		$entradas = DB::select($cons);

		$res['entradas'] = $entradas;

		return $res;
	}


	public function putDatos()
	{
		$res = [];



		$cons = "SELECT i.id as det_id, i.producto_id, i.precio_costo, i.precio_venta, i.cantidad, i.updated_by, i.updated_at, p.nombre, p.unidad_medida, p.categoria_id, p.iva
						FROM inventarios_detalles i
						INNER JOIN productos p ON p.id=i.producto_id
						INNER JOIN inventarios inv ON inv.id=i.inventario_id and inv.actual=true
						WHERE i.deleted_at is null";
						
		$res['productos'] = DB::select($cons);
			

		$res['proveedores'] = Proveedor::all();
		$res['categorias'] 	= Categoria::all();

		$cons = "SELECT id, codigo_barras, nombre FROM productos WHERE codigo_barras is not null and codigo_barras!='' and deleted_at is null";
		$codigos_barras = DB::select($cons);

		$res['codigos_barras'] 	= $codigos_barras;

		return $res;
	}

	public function postGuardar()
	{
		$user = User::fromToken();

		$fecha 			= Request::input('entrada')['fecha'];
		$proveedor_id 	= Request::input('entrada')['proveedor']['id'];

		//$date = Carbon::createFromFormat('Y-m-d H:i:s', new \DateTime());
		$now = new \DateTime();
		$now->format('Y-m-d H:i:s');

		$consulta = "INSERT INTO entradas(fecha, proveedor_id, created_by, created_at, updated_at) VALUES (:fecha, :proveedor_id, :user_id, :created_at, :updated_at)";
		$insertado = DB::insert($consulta, [ ':fecha' => $fecha, ':proveedor_id' => $proveedor_id, ':user_id' => $user['id'], ':created_at' => $now, ':updated_at' => $now ]);

		$entrada_id = DB::getPdo()->lastInsertId();

		
		$productos 	= Request::input('productos');
		$cant 		= count($productos);

		for ($i=0; $i < $cant; $i++) { 
			
			$consulta = "INSERT INTO entradas_detalles(entrada_id, producto_id, cantidad, precio_costo, precio_venta) VALUES (:costo_id, :producto_id, :cantidad, :precio_costo, :precio_venta)";
			$insertado = DB::insert($consulta, [ ':entrada_id' 		=> $entrada_id, 
												':producto_id' 		=> $productos[$i]['producto_id'], 
												':cantidad' 		=> $productos[$i]['cantidad'], 
												':precio_costo' 	=> $productos[$i]['precio_costo'], 
												':precio_venta' 	=> $productos[$i]['precio_venta'] ]);

		}

		return $entrada_id;
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
		$prod->precio_costo 	= Request::input('precio_costo');
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