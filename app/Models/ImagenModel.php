<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use DB;


class ImagenModel extends Model {
	protected $fillable = [];

	protected $table = 'images';

	use SoftDeletes;
	protected $softDelete = true;




	public static function DatosImagen($imagen_id, $user_id)
	{
		$datos_imagen = null;


		$consulta = 'SELECT u.nombres, i.nombre, u.apellidos, u.sexo, "usuario" as tipo, i.id  FROM images i 
				inner join users u on u.imagen_id=i.id and i.id=:imagen_id1
				UNION 
				SELECT p.nombres, i.nombre, p.apellidos, p.sexo, "paciente" as tipo, i.id FROM images i 
				inner join pacientes p on p.imagen_id=i.id  and i.id=:imagen_id2';

		$oficiales = DB::select(DB::raw($consulta), array(
					':imagen_id1'	=> $imagen_id,
					':imagen_id2'	=> $imagen_id,
				));


		$consulta = 'SELECT u.nombres, u.apellidos, i.nombre, u.sexo, i.id FROM images i 
				inner join users u on u.firma_id=i.id  and i.id=:imagen_id';

		$firmas = DB::select(DB::raw($consulta), array(
					':imagen_id'	=> $imagen_id
				));

		$datos_imagen = array('oficiales' => $oficiales, 'firmas' => $firmas);

		return $datos_imagen;
	}




	
	public static function imagen_de_usuario($sexo='M', $imagen_id=false)
	{

		if ($imagen_id) {

			$img = ImagenModel::find($imagen_id);

			if ($img) {

				if ($img->publica) {
					return 'publics/' . $img->nombre;
				}else{
					return 'perfil/' . $img->nombre;
				}
					
			}else{
				return ImagenModel::default_image_name($sexo);
			}
			
		}else{

			return ImagenModel::default_image_name($sexo);

		}
	}

	

	public static function default_image_id($sexo)
	{
		if ($sexo == 'F') {
			return 2;
		}else{
			return 1; // ID de la imagen masculina
		}
	}
	public static function default_image_name($sexo)
	{
		if ($sexo == 'F') {
			return 'system/avatars/female1.jpg';
		}else{
			return 'system/avatars/male1.jpg';
		}
	}


	
	public static function ruta_imagen($imagen_id=false)
	{
		if ($imagen_id) {

			$img = ImagenModel::find($imagen_id);

			if ($img) {

				if ($img->publica) {
					return 'publics/' . $img->nombre;
				}else{
					return 'perfil/' . $img->nombre;
				}

			}else{
				return 'system/avatars/no-photo.jpg';
			}


		}else{

			return 'system/avatars/no-photo.jpg';

		}
	}

	


}