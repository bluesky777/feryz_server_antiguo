<?php namespace App\Http\Controllers;

use Request;
use DB;
use File;
use Image;
use \stdClass;

use App\Models\User;
use App\Models\ImagenModel;
use App\Models\Configuracion;


class ImagesController extends Controller {

	public function getIndex()
	{
		$user = User::fromToken();
		
		$imagenes = ImagenModel::where('user_id', $user['id'])
								->get();

		return $imagenes;
	}

	public function getConUsuarios()
	{
		$user = User::fromToken();

		$respuesta = [];

		$respuesta['imagenes'] = ImagenModel::where('user_id', $user['id'])
								->get();

		if ($user['is_superuser']) {
			$respuesta['usuarios'] = User::all();
		}else{
			$respuesta['usuarios'] = User::where('is_superuser', false)->get();
		}		

		return $respuesta;
	}


	public function getDatosImagen()
	{
		//$user = User::fromToken();
		$user_id = Request::input('user_id');
		$imagen_id = Request::input('imagen_id');
		

		$datos_imagen = ImagenModel::DatosImagen($imagen_id, $user_id);

		return $datos_imagen;
	}




	public function postStore()
	{
		$user = User::fromToken();

		$folder = 'images/perfil/';

		if (Request::has('foto')) {
			$newImg = $this->guardar_imagen_tomada($user);
		}else{
			$newImg = $this->guardar_imagen($user);
		}

		
		
		try {
			
			$img = Image::make($folder . $newImg->nombre);
			$img->fit(300);
			//$img->resize(300, null, function ($constraint) {
			//	$constraint->aspectRatio();
			//});
			$img->save();
		} catch (Exception $e) {
			
		}

		return $newImg;
	}



	public function postStoreIntacta()
	{
		$user = User::fromToken();
		
		$newImg = $this->guardar_imagen($user);
		$newImg->publica = true;
		$newImg->save();

		return $newImg;
	}

	public function guardar_imagen($user)
	{
		$folderName = 'user_'.$user['id'];
		$folder = 'images/perfil/'.$folderName;

		if (!File::exists($folder)) {
			File::makeDirectory($folder, $mode = 0777, true, true);
		}

		$file = Request::file("file");
		
		try {
			/**/
			//separamos el nombre de la img y la extensión
			$info = explode(".", $file->getClientOriginalName());
			//asignamos de nuevo el nombre de la imagen completo
			$miImg = $file->getClientOriginalName();
			
			//$miImg = date('Y-m-d-H:i:s'); 
		} catch (Exception $e) {
			$miImg = 'cam';
		}
		
		

		//return Request::file('file')->getMimeType(); // Puedo borrarlo
		//mientras el nombre exista iteramos y aumentamos i
		$i = 0;
		while(file_exists($folder.'/'. $miImg)){
			$i++;
			$miImg = $info[0]."(".$i.")".".".$info[1];              
		}

		//guardamos la imagen con otro nombre ej foto(1).jpg || foto(2).jpg etc
		$file->move($folder, $miImg);
		
		$newImg = new ImagenModel;
		$newImg->nombre = $folderName.'/'.$miImg;
		$newImg->user_id = $user['id'];
		$newImg->save();

		return $newImg;
	}


	public function guardar_imagen_tomada($user)
	{
		$folderName = 'user_'.$user['id'];
		$folder = 'images/perfil/'.$folderName;

		if (!File::exists($folder)) {
			File::makeDirectory($folder, $mode = 0777, true, true);
		}

		$usuario = User::find(Request::input('user_id'));
		
		$anterior = ImagenModel::find($usuario->imagen_id);
		if ($anterior) {
			$filename = 'images/perfil/'.$anterior->nombre;

			if (File::exists($filename)) {
				File::delete($filename);
				$anterior->forceDelete();
				$usuario->imagen_id = null;
			}else{
				return 'No se encuentra la imagen a eliminar. '.$img->nombre;
			}

		}

		//separamos el nombre de la img y la extensión
		$info = explode(".",  $usuario->nombres . '.jpg');
		//asignamos de nuevo el nombre de la imagen completo
		$miImg = $usuario->nombres . '.jpg';
		
		
		//mientras el nombre exista iteramos y aumentamos i
		$i = 0;
		while(file_exists($folder.'/'. $miImg)){
			$i++;
			$miImg = $info[0]."(".$i.")".".".$info[1];              
		}


		$file = Request::input("foto");
		$binary_data = base64_decode( $file );

		//guardamos la imagen con otro nombre ej foto(1).jpg || foto(2).jpg etc
		$result = file_put_contents($folder .'/'. $miImg, $binary_data);
		//$file->move($folder, $miImg);

		
		$newImg = new ImagenModel;
		$newImg->nombre = $folderName.'/'.$miImg;
		$newImg->user_id = $user['id'];
		$newImg->save();


		$usuario->image_id = $newImg->id;
		$usuario->save();
		

		return $newImg;
	}

	public function putRotarimagen($imagen_id)
	{
		$imagen = ImagenModel::findOrFail($imagen_id);

		$folderName = $imagen->nombre;
		$img_dir = 'images/perfil/'.$folderName;

		$img = Image::make($img_dir);

		$img->rotate(-90);

		$img->save();

		return $imagen->nombre;
	}



	public function putCambiarImagenPerfil($id)
	{
		$user = User::findOrFail($id);
		$user->imagen_id = Request::input('image_id');
		$user->save();
		return $user;
	}


	public function putCambiarLogo()
	{
		$user = User::fromToken();

		$conf = Configuracion::all()->first();
		$conf->logo_id = Request::input('logo_id');
		$conf->save();
		return $conf;
	}


	public function deleteDestroy($id)
	{
		$img = ImagenModel::findOrFail($id);
		
		$filename = 'images/perfil/'.$img->nombre;


		// Debería crear un código que impida borrar si la imagen es usada.


		if (File::exists($filename)) {
			File::delete($filename);
			$img->delete();
		}else{
			return 'No se encuentra la imagen a eliminar. '.$img->nombre;
		}


		// Elimino cualquier referencia que otros tengan a esa imagen borrada.
		$users = User::where('imagen_id', $id)->get();
		foreach ($users as $user) {
			$user->imagen_id = null;
			$user->save();
		}
		$confs = Configuracion::where('logo_id', $id)->get();
		foreach ($confs as $conf) {
			$conf->logo_id = null;
			$conf->save();
		}

		
		return $img;
	}

}