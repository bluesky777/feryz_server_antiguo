<?php namespace App\Http\Controllers;

use Request;
use Hash;
use App\Models\User;
use App\Models\Proveedor;
use App\Models\Categoria;
use App\Models\Producto;
use App\Models\Inventario;
use Excel;
use Carbon\Carbon;

use DB;

class InventariosController extends Controller {

	public function putDatos()
	{
		$user = User::fromToken();

		$res = [];

		$cons 			= "SELECT * FROM inventarios i WHERE i.deleted_at is null order by i.fecha desc";
		$inventarios 	= DB::select($cons);

		if (count($inventarios) == 0) {
			$inventarios = $this->crearInventarioInicial();
		}

		$res['inventarios'] = $inventarios;

		foreach ($inventarios as $key => $inventario) {
			if ($inventario->actual == true) {
				$res['inventario_actual'] = $inventario;
			}
		}

		$cons 		= "SELECT i.id as det_id, i.producto_id, i.precio_costo, i.precio_venta, i.cantidad, i.updated_by, i.updated_at, p.nombre, p.unidad_medida, p.categoria_id, p.iva
						FROM inventarios_detalles i
						INNER JOIN productos p ON p.id=i.producto_id
						WHERE i.inventario_id=:inventario_id";
						
		$detalles 	= DB::select($cons, [ 'inventario_id' => $res['inventario_actual']->id ]);
			
		$res['detalles_inventario_actual'] = $detalles;	

		return $res;
	}


	private function crearInventarioInicial(){
		$ahora = Carbon::now();
		$ahora = $ahora->toDateString();

		$inventario 			= new Inventario;
		$inventario->fecha 		= $ahora;
		$inventario->actual 	= true;
		$inventario->save();


		$cons 			= "SELECT * FROM productos p WHERE p.deleted_at is null order by p.nombre asc";
		$productos 		= DB::select($cons);
		$cant_p			= count($productos);

		for ($i=0; $i < $cant_p; $i++) { 
			
			$cons = "INSERT INTO inventarios_detalles(inventario_id, producto_id, precio_costo, precio_venta, cantidad) VALUES(:inventario_id, :producto_id, :precio_costo, :precio_venta, 0)";
			DB::insert($cons, [':inventario_id' => $inventario->id, ':producto_id' => $productos[$i]->id, ':precio_costo' => $productos[$i]->precio_costo, ':precio_venta' => $productos[$i]->precio_venta ]);

		}




		$cons 			= "SELECT * FROM inventarios i WHERE i.deleted_at is null order by i.fecha desc";
		$inventarios 	= DB::select($cons);


		return $inventarios;
	}

	public function getIndex()
	{
		

		Excel::create('Feryz', function($excel) {

			$excel->sheet('Productos', function($sheet) {

				$cons = "SELECT * FROM productos p WHERE p.deleted_at is null";
				$productos = DB::select($cons);
				
				//$sheet->setBorder('A1:F10');
				//$sheet->setFreeze('A2');

				$sheet->loadView('inventarios.productos', ['productos' => $productos]);

			});


		})->export('xls');
	}


}