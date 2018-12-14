<?php namespace App\Http\Controllers\AuditSystem;

use Request;
use Hash;

use DB;
use Carbon\Carbon;

class DatosIniciales {

	public function insertarUnionAudit()
	{
		
		$uniones 	= DB::select('SELECT * from au_uniones;');
		
		if (count($uniones) == 0) {
			$now = Carbon::now('America/Bogota');
			
			$consulta = "INSERT INTO au_uniones
					(id, nombre, alias, codigo, created_at, updated_at)
				VALUES
					(1, 'UNION COLOMBIANA DEL NORTE', 'AGC111', 'AGC111', '".$now."', '".$now."')
					;";
					
			DB::insert($consulta);
			
			$consulta = "INSERT INTO au_auditorias
					(fecha, hora, iglesia_id, created_at, updated_at)
				VALUES
					('2018-10-01', '10:10:00am', 1, '".$now."', '".$now."')
					;";
					
			DB::insert($consulta);
		}
		return 'Insertando';
	}


	public function insertarAsociaciones()
	{
		
		$taxis 		= DB::select('SELECT * from au_asociaciones;');
		
		if (count($taxis) == 0) {
			$now = Carbon::now('America/Bogota');
			
			$consulta = "INSERT INTO au_asociaciones
					(id, nombre, alias, codigo, union_id, created_at, updated_at)
				VALUES
					(1, 'ASOCIACIÓN DEL ORIENTE', 'AGC811', 'AGC811', 1, '".$now."', '".$now."'),
					(2, 'ASOCIACIÓN DEL NORESTE', 'AGCN11', 'AGCN11', 1, '".$now."', '".$now."'),
					(3, 'ASOCIACIÓN DEL CENTRO ORIENTE', 'AGCT11', 'AGCT11' , 1, '".$now."', '".$now."'),
					(4, 'ASOCIACIÓN DEL CARIBE', 'AGCC11', 'AGCC11' , 1, '".$now."', '".$now."'),
					(5, 'ASOCIACIÓN DEL ATLANTICO', 'AGC211', 'AGC211' , 1, '".$now."', '".$now."'),
					(6, 'ASOCIACIÓN ISLAS', 'AGC611', 'AGC611' , 1, '".$now."', '".$now."'),
					(7, 'ASOCIACIÓN CENTRO OCCIDENTAL', 'AGCW11', 'AGCW11' , 1, '".$now."', '".$now."'),
					(8, 'ASOCIACIÓN SUR OCCIDENTAL', 'AGCS11', 'AGCS11' , 1, '".$now."', '".$now."')
					;";
					
			DB::insert($consulta);
		}
		return 'Insertando';
	}
	

	public function insertarDistritos()
	{
		
		$elems 		= DB::select('SELECT * from au_distritos;');
		
		if (count($elems) == 0) {
			$now = Carbon::now('America/Bogota');
			
			$consulta = "INSERT INTO au_distritos
					(id, nombre, alias, codigo, asociacion_id, pastor_id, created_at, updated_at)
				VALUES
					(1, 'Arauca Central', 'DSARAUC01', 'DSARAUC01', 2, 1, '".$now."', '".$now."'),
					(2, 'Arauca Betania', 'DSARABE01', 'DSARABE01', 2,  1, '".$now."', '".$now."'),
					(3, 'Arauquita', 'DSARAUQ01', 'DSARAUQ01', 2,  1, '".$now."', '".$now."'),
					(4, 'Arauquita Maranatha', 'DSARAUQ02', 'DSARAUQ02', 2,  1, '".$now."', '".$now."'),
					(5, 'Bethel', 'DSBETHE01', 'DSBETHE01', 2,  1, '".$now."', '".$now."'),
					(6, 'Cúcuta Central', 'DSCUCUC01', 'DSCUCUC01', 2,  1, '".$now."', '".$now."'),
					(7, 'Canaán', 'DSCANAA01', 'DSCANAA01', 2,  1, '".$now."', '".$now."'),
					(8, 'Fortul', 'DSFORTU01', 'DSFORTU01', 2,  1, '".$now."', '".$now."'),
					(9, 'Juan Atalaya', 'DSJUANA01', 'DSJUANA01', 2,  1, '".$now."', '".$now."'),
					(10, 'Libertad', 'DSLIBER01', 'DSLIBER01', 2,  1, '".$now."', '".$now."'),
					(11, 'Nuevo Caranal', 'DSCARAN01', 'DSCARAN01', 2,  1, '".$now."', '".$now."'),
					(12, 'Ocaña', 'DSOCAÑA01', 'DSOCAÑA01', 2,  1, '".$now."', '".$now."'),
					(13, 'Palestina', 'DSPALES01', 'DSPALES01', 2,  1, '".$now."', '".$now."'),
					(14, 'Pamplona', 'DSPAMPL01', 'DSPAMPL01', 2,  1, '".$now."', '".$now."'),
					(15, 'Patios', 'DSPATIO01', 'DSPATIO01', 2,  1, '".$now."', '".$now."'),
					(16, 'Pueblo Nuevo', 'DSPUEBL01', 'DSPUEBL01', 2,  1, '".$now."', '".$now."'),
					(17, 'Redención', 'DSREDEN01', 'DSREDEN01', 2,  1, '".$now."', '".$now."'),
					(18,'Renacer', 'DSRENAC01', 'DSRENAC01', 2,  1, '".$now."', '".$now."'),
					(19,'Cubará', 'DSREDCU01', 'DSREDCU01', 2,  1, '".$now."', '".$now."'),
					(20,'Saravena Central', 'DSSARAV01', 'DSSARAV01', 2,  1, '".$now."', '".$now."'),
					(21,'Tame Central', 'DSTAMEA01', 'DSTAMEA01', 2,  1, '".$now."', '".$now."'),
					(22,'Tame Oriental', 'DSTAMET01', 'DSTAMET01', 2,  1, '".$now."', '".$now."'),
					(23,'Tibú', 'DSTIBUN01', 'DSTIBUN01', 2,  1, '".$now."', '".$now."'),
					(24,'Cúcuta Sión', 'DSSIONA01', 'DSSIONA01', 2,  1, '".$now."', '".$now."'),
					(25,'Vichada', 'DSVICHA01', 'DSVICHA01', 2,  1, '".$now."', '".$now."'),
					(26,'Getsemani', 'DSVILGE01', 'DSVILGE01', 2,  1, '".$now."', '".$now."'),
					(27,'Villa del Rosario', 'DSVILLA01', 'DSVILLA01', 2,  1, '".$now."', '".$now."'),
					(28,'Tame Enmanuel', 'DSTAMEE01', 'DSTAMEE01', 2,  1, '".$now."', '".$now."')
				
					;";
					
			DB::insert($consulta);
		}
		return 'Insertando';
	}


	public function insertarUsuarios()
	{
		
		$users 		= DB::select('SELECT * from au_users;');
		
		if (count($users) == 0) {
			$now = Carbon::now('America/Bogota');
			
			$consulta = "INSERT INTO au_users
					(id, nombres, apellidos, email, username, password, tipo, sexo, union_id, asociacion_id, created_at, updated_at)
				VALUES
					(1, 'Joseth D', 'Guerrero', 'davidguerrero777@gmail.com', 'joseth', '456', 'Admin', 'M', 1, 2, '".$now."', '".$now."'),
					(2, 'Gustavo', 'Pérez', null, 'gustavo',  '123', 'Auditor', 'M', null, 2, '".$now."', '".$now."'),
					(3, 'Daniel', 'Grandas', null, 'daniel',  '123', 'Pastor', 'M', null, 2, '".$now."', '".$now."'),
					(4, 'Edilson', 'Marquez', null, 'edilson',  '123', 'Tesorero', 'M', null, 2, '".$now."', '".$now."'),
					(5, 'Cesar', 'Saldariaga', null, 'cesar',  '123', 'Tesorero asociación', 'M', null, 2, '".$now."', '".$now."'),
					(6, 'Felix', 'Díaz', null, 'felix',  '123', 'Pastor', 'M', null, 2, '".$now."', '".$now."')
					;";
					
			DB::insert($consulta);
		}
		return 'Insertando';
	}



	public function insertarIglesias()
	{
		
		$users 		= DB::select('SELECT * from au_iglesias;');
		
		if (count($users) == 0) {
			$now = Carbon::now('America/Bogota');
			
			$consulta = "INSERT INTO au_iglesias
					(id, nombre, alias, codigo, distrito_id, created_at, updated_at)
				VALUES
					(1, 'Alfa y Omega -  Pueblo Nuevo', 'CALFAY01', 'CALFAY01', 16, '".$now."', '".$now."'),
					(2, 'Alfa y Omega -  Redencion', 'CALFAY02', 'CALFAY02',  17, '".$now."', '".$now."'),
					(3, 'Alfa y Omega - Tame Central', 'CALFAY03', 'CALFAY03',  21, '".$now."', '".$now."'),
					(4, 'Alfa y Omega - Tame Central', 'CALFAY03', 'CALFAY03',  9, '".$now."', '".$now."'),
					(5, 'Alfa y Omega - D. Atalaya', 'CALFAY04', 'CALFAY04',  3, '".$now."', '".$now."'),
					(6, 'Alfa y Omega - Arauquita Central', 'CALFAY05', 'CALFAY05',  1, '".$now."', '".$now."'),
					(7, 'Arauca -  Arauca Central', 'CARAUC01', 'CARAUC01',  3, '".$now."', '".$now."'),
					(8, 'Arauquita -  Arauquita', 'CARAUQ01', 'CARAUQ01',  3, '".$now."', '".$now."'),
					(9, 'Bendición- Reiner -  Arauquita ', 'CBENDI01', 'CBENDI01',  3, '".$now."', '".$now."'),
					(10, 'Berea -  Vichada', 'CBEREA01', 'CBEREA01',  25, '".$now."', '".$now."'),
					(11, 'Betania Malvinas -  Nuevo Caranal', 'CBETAN01', 'CBETAN01',  11, '".$now."', '".$now."'),
					(12, 'Betania -  Arauca Betania', 'CBETAN02', 'CBETAN02',  2, '".$now."', '".$now."'),
					(13, 'Betania -  Cubará', 'CBETAN03', 'CBETAN03',  19, '".$now."', '".$now."'),
					(14, 'Betenia -  Juan Atalaya', 'CBETAN04', 'CBETAN04',  9, '".$now."', '".$now."'),
					(15, 'Betania - D. Fortul', 'CBETAN05', 'CBETAN05',  8, '".$now."', '".$now."'),
					(16, 'Betania - Palestina', 'CBETAN06', 'CBETAN06',  13, '".$now."', '".$now."'),
					(17, 'Bethel -  Bethel', 'CBETHE01', 'CBETHE01',  5, '".$now."', '".$now."'),
					(18, 'Bethel -  Cucuta Sión', 'CBETHE02', 'CBETHE02',  24, '".$now."', '".$now."'),
					(19, 'Bethel - Abrego D. Ocaña', 'CBETHE03', 'CBETHE03',  12, '".$now."', '".$now."'),
					(20, 'Brasilia -  Arauquita Maranatha', 'CBRASI01', 'CBRASI01',  4, '".$now."', '".$now."'),
					(21, 'Buenos Aires -  Pueblo Nuevo', 'CBUENO01', 'CBUENO01',  16, '".$now."', '".$now."'),
					(22, 'El Buen Pastor -  Pueblo Nuevo', 'CBUENP01', 'CBUENP01',  16, '".$now."', '".$now."'),
					(23, 'Cabssel -  D. Tibú', 'CCABSS01', 'CCABSS01',  23, '".$now."', '".$now."'),
					(24, 'Caled -  Juan Atalaya', 'CCALED01', 'CCALED01',  9, '".$now."', '".$now."'),
					(25, 'Caleb - Caranal', 'CCALEB01', 'CCALEB01',  11, '".$now."', '".$now."'),
					(26, 'Canaan -  Saravena Bethel', 'CCANAA01', 'CCANAA01',  5, '".$now."', '".$now."'),
					(27, 'Canaan -  Cubará', 'CCANAA02', 'CCANAA02',  19, '".$now."', '".$now."'),
					(28, 'Canaan -  D. Patios', 'CCANAA03', 'CCANAA03',  15, '".$now."', '".$now."'),
					(29, 'Canaan -  D. Canaan', 'CCANAA04', 'CCANAA04',  7, '".$now."', '".$now."'),
					(30, 'Canaan - D. Tame Central', 'CCANAA05', 'CCANAA05',  21, '".$now."', '".$now."'),
					(31, 'Canaan - D. Ocaña', 'CCANAA06', 'CCANAA06',  12, '".$now."', '".$now."'),
					(32, 'Caño Cristal -  Fortul', 'CCAÑOC01', 'CCAÑOC01',  8, '".$now."', '".$now."'),
					(33, 'Central de Cúcuta -  Cucuta Central', 'CCENTR01', 'CCENTR01',  6, '".$now."', '".$now."'),
					(34, 'Casa de Oración - D. Renacer', 'CCASAO01', 'CCASAO01',  18, '".$now."', '".$now."'),
					(35, 'Costa Hermosa -  Arauca Betania', 'CCOSTA01', 'CCOSTA01',  2, '".$now."', '".$now."'),
					(36, 'Cravonorte -  Arauca Betania', 'CCRAVO01', 'CCRAVO01',  2, '".$now."', '".$now."'),
					(37, 'Cristo la Esperanza -  Getsemani', 'CCRIST01', 'CCRIST01',  26, '".$now."', '".$now."'),
					(38, 'Cristo Redentor - Patios', 'CCRIRE01', 'CCRIRE01',  15, '".$now."', '".$now."'),
					(39, 'Ebenezer -  Tame Central', 'CEBENE01', 'CEBENE01',  21, '".$now."', '".$now."'),
					(40, 'Ebenezer-Oasis -  Arauquita Maranatha', 'CEBENE02', 'CEBENE02',  4, '".$now."', '".$now."'),
					(41, 'Ebenezer -  Palestina', 'CEBENE03', 'CEBENE03',  13, '".$now."', '".$now."'),
					(42, 'Ebenezer -  Redencion', 'CEBENE04', 'CEBENE04',  17, '".$now."', '".$now."'),
					(43, 'Ebenezer Chitaga - D Pamplona', 'CEBENE05', 'CEBENE05',  14, '".$now."', '".$now."'),
					(44, 'Eden -  Arauquita Maranatha', 'CEDENI01', 'CEDENI01',  4, '".$now."', '".$now."'),
					(45, 'Eden -  Saravena Central', 'CEDENI02', 'CEDENI02',  20, '".$now."', '".$now."'),
					(46, 'Eden -  Villa Del Rosario', 'CEDENI03', 'CEDENI03',  27, '".$now."', '".$now."'),
					(47, 'Eden -  Ocaña', 'CEDENI04', 'CEDENI04',  12, '".$now."', '".$now."'),
					(48, 'Eden Brisas - Tame Central', 'CEDENT01', 'CEDENT01',  21, '".$now."', '".$now."'),
					(49, 'Efeso -  Tame Oriental', 'CEFESO01', 'CEFESO01',  22, '".$now."', '".$now."'),
					(50, 'Emaus -  Pamplona', 'CEMAUS01', 'CEMAUS01',  14, '".$now."', '".$now."'),
					(51, 'Emaus -  Patios', 'CEMAUS02', 'CEMAUS02',  15, '".$now."', '".$now."'),
					(52, 'Emaus -  D. Cubará', 'CEMAUS03', 'CEMAUS03',  19, '".$now."', '".$now."'),
					(53, 'Emaus - D. Bethel', 'CEMAUS04', 'CEMAUS04',  5, '".$now."', '".$now."'),
					(54, 'Embajadores - Cúcuta Central', 'CEMBAJ01', 'CEMBAJ01',  6, '".$now."', '".$now."'),
					(55, 'Enacore - Tame central', 'CENACO01', 'CENACO01',  21, '".$now."', '".$now."'),
					(56, 'Enmanuel -  Tame Enmanuel', 'CENMAN01', 'CENMAN01',  28, '".$now."', '".$now."'),
					(57, 'Enmanuel-Pesquera -  Arauquita', 'CENMAN02', 'CENMAN02',  3, '".$now."', '".$now."'),
					(58, 'Enmanuel -  Redencion', 'CENMAN03', 'CENMAN03',  17, '".$now."', '".$now."'),
					(59, 'Enmanuel -  Juan Atalaya', 'CENMAN04', 'CENMAN04',  9, '".$now."', '".$now."'),
					(60, 'Enmanuel - Arauquita  Maranatha', 'CENMAN06', 'CENMAN06',  4, '".$now."', '".$now."'),
					(61, 'Enmanuel - Pueblo Nuevo', 'CENMAN07', 'CENMAN07',  16, '".$now."', '".$now."'),
					(62, 'Esmirna - Tame Oriental', 'CESMIR01', 'CESMIR01',  22, '".$now."', '".$now."'),
					(63, 'Estrella del Amanecer -  Cucuta Central', 'CESTRE01', 'CESTRE01',  6, '".$now."', '".$now."'),
					(64, 'Estrella de Jacob - Arauca Central', 'CESTRE02', 'CESTRE02',  1, '".$now."', '".$now."'),
					(65, 'Filadelfia -  Cubará', 'CFILAD02', 'CFILAD02',  19, '".$now."', '".$now."'),
					(66, 'Filadelfia -  D. Patios', 'CFILAD03', 'CFILAD03',  15, '".$now."', '".$now."'),
					(67, 'Filadelfia -  Juan Atalaya', 'CFILAD04', 'CFILAD04',  9, '".$now."', '".$now."'),
					(68, 'Filadefia -  Ocaña', 'CFILAD05', 'CFILAD05',  12, '".$now."', '".$now."'),
					(69, 'Filadelfia - Redención', 'CFILAD06', 'CFILAD06',  17, '".$now."', '".$now."'),
					(70, 'Fortul -  Fortul', 'CFORTU01', 'CFORTU01',  8, '".$now."', '".$now."'),
					(71, 'Fuerte Pregon -  Villa Del Rosario', 'CFUERT01', 'CFUERT01',  27, '".$now."', '".$now."'),
					(72, 'Galaad -  Patios', 'CGALAA01', 'CGALAA01',  15, '".$now."', '".$now."'),
					(73, 'Galilea -  Pamplona', 'CGALIL01', 'CGALIL01',  14, '".$now."', '".$now."'),
					(74, 'Genezareth -  Bethel', 'CGENEZ01', 'CGENEZ01',  5, '".$now."', '".$now."'),
					(75, 'Genezareth -  Villa Del Rosario', 'CGENEZ02', 'CGENEZ02',  27, '".$now."', '".$now."'),
					(76, 'Gerisim - Villa del Rosario', 'CGERIS01', 'CGERIS01',  27, '".$now."', '".$now."'),
					(77, 'Gerizin - Palestina', 'CGERIZ01', 'CGERIZ01',  13, '".$now."', '".$now."'),
					(78, 'Getsemany -  Nuevo Caranal', 'CGETSE01', 'CGETSE01',  11, '".$now."', '".$now."'),
					(79, 'Getsemany -  Bethel', 'CGETSE02', 'CGETSE02',  5, '".$now."', '".$now."'),
					(80, 'Getsemany -  Cubará', 'CGETSE03', 'CGETSE03',  19, '".$now."', '".$now."'),
					(81, 'Getsemani -  Getsemani', 'CGETSE04', 'CGETSE04',  26, '".$now."', '".$now."'),
					(82, 'Getsemany -  Juan Atalaya', 'CGETSE05', 'CGETSE05',  9, '".$now."', '".$now."'),
					(83, 'Getsemani - Ocaña', 'CGETSE06', 'CGETSE06',  12, '".$now."', '".$now."'),
					(84, 'Genezaret - Atalaya', 'CGENEZ03', 'CGENEZ03',  9, '".$now."', '".$now."'),
					(85, 'Glondrinas -  Palestina', 'CGLOND01', 'CGLOND01',  13, '".$now."', '".$now."'),
					(86, 'Gran Faro Toledo - Pamplona', 'CGRAFA01', 'CGRAFA01',  14, '".$now."', '".$now."'),
					(87, 'Hashen-Peralonso -  Arauquita Maranatha', 'CHASHE01', 'CHASHE01',  4, '".$now."', '".$now."'),
					(88, 'Heraldo -  Bethel', 'CHERAL0', 'CHERAL0',  5, '".$now."', '".$now."'),
					(89, 'Hebron - Tame Central', 'CHEBRO01', 'CHEBRO01',  21, '".$now."', '".$now."'),
					(90, 'Hebron - Bethel', 'CHEBRO02', 'CHEBRO02',  5, '".$now."', '".$now."'),
					(91, 'Horeb, La Hermosa -  Oriental', 'CHOREB01', 'CHOREB01',  22, '".$now."', '".$now."'),
					(92, 'Horeb- San Luis -  Arauquita Maranatha', 'CHOREB02', 'CHOREB02',  4, '".$now."', '".$now."'),
					(93, 'Horeb -  Saravena Bethel', 'CHOREB03', 'CHOREB03',  5, '".$now."', '".$now."'),
					(94, 'Horeb -  Patios', 'CHOREB04', 'CHOREB04',  15, '".$now."', '".$now."'),
					(95, 'Gr. Horeb - D. Libertad', 'CHOREB05', 'CHOREB05',  10, '".$now."', '".$now."'),
					(96, 'Grupo Horeb - Cubará', 'CHOREB06', 'CHOREB06',  19, '".$now."', '".$now."'),
					(97, 'Horeb - Palestina', 'CHOREB08', 'CHOREB08',  13, '".$now."', '".$now."'),
					(98, 'Jehova Jireth - Vichada', 'CJEHOV01', 'CJEHOV01',  25, '".$now."', '".$now."'),
					(99, 'Jerico -  D. Renacer', 'CJERIC01', 'CJERIC01',  18, '".$now."', '".$now."'),
					(100, 'Jerusalen -  Tame Central', 'CJERUS01', 'CJERUS01',  21, '".$now."', '".$now."'),
					(101, 'Jerusalen -  Palestina', 'CJERUS02', 'CJERUS02',  13, '".$now."', '".$now."'),
					(102, 'Jerusalen -  Cucuta Sión', 'CJERUS03', 'CJERUS03',  24, '".$now."', '".$now."'),
					(103, 'Jerusalen - Pueblo Nuevo', 'CJERUS06', 'CJERUS06',  16, '".$now."', '".$now."'),
					(104, 'Jerusalen -  Patios', 'CJERUS04', 'CJERUS04',  15, '".$now."', '".$now."'),
					(105, 'Jerusalen Holanda - Tame Central', 'CJERHO01', 'CJERHO01',  21, '".$now."', '".$now."'),
					(106, 'Jezreel - Libertad', 'CJEZRE01', 'CJEZRE01',  10, '".$now."', '".$now."'),
					(107, 'Jerusalen - Cubará', 'CJERUS07', 'CJERUS07',  19, '".$now."', '".$now."'),
					(108, 'Jireh - Arauquita', 'CJIREH01', 'CJIREH01',  3, '".$now."', '".$now."'),
					(109, 'La Esperanza - Getsemani', 'CJESUS05', 'CJESUS05',  26, '".$now."', '".$now."'),
					(110, 'Jehova Nisi - D. Pueblo Nuevo', 'CJOHOV01', 'CJOHOV01',  16, '".$now."', '".$now."'),
					(111, 'Jordan -  Pueblo Nuevo', 'CJORDA01', 'CJORDA01',  16, '".$now."', '".$now."'),
					(112, 'La Roca -  Libertad', 'CLAROC01', 'CLAROC01',  10, '".$now."', '".$now."'),
					(113, 'Legado -  Cucuta Sión', 'CLEGAD01', 'CLEGAD01',  24, '".$now."', '".$now."'),
					(114, 'La Hermosa - Fortul', 'CLAHER01', 'CLAHER01',  8, '".$now."', '".$now."'),
					(115, 'La Hermosa - Cúcuta Sión', 'CLAHER02', 'CLAHER02',  24, '".$now."', '".$now."'),
					(116, 'Mahanain -  Arauquita Maranatha', 'CMAHAN01', 'CMAHAN01',  4, '".$now."', '".$now."'),
					(117, 'Mahanain -  Cubará', 'CMAHAN02', 'CMAHAN02',  19, '".$now."', '".$now."'),
					(118, 'Mahanain -  Pamplona', 'CMAHAN03', 'CMAHAN03',  14, '".$now."', '".$now."'),
					(119, 'Manantial - D. Cubará', 'CMANAN02', 'CMANAN02',  19, '".$now."', '".$now."'),
					(120, 'Maranatha -  Arauquita Maranatha', 'CMARAN01', 'CMARAN01',  4, '".$now."', '".$now."'),
					(121, 'Maranatha -  Palestina', 'CMARAN02', 'CMARAN02',  13, '".$now."', '".$now."'),
					(122, 'Maranatha -  Juan Atalaya', 'CMARAN03', 'CMARAN03',  9, '".$now."', '".$now."'),
					(123, 'Maranatha -  Vichada', 'CMARAN04', 'CMARAN04',  25, '".$now."', '".$now."'),
					(124, 'Maranatha -  Ocaña', 'CMARAN05', 'CMARAN05',  12, '".$now."', '".$now."'),
					(125, 'Orion - Tame Oriental', 'CMARAN06', 'CMARAN06',  22, '".$now."', '".$now."'),
					(126, 'Maranatha - Arauca Betenia', 'CMARAN07', 'CMARAN07',  2, '".$now."', '".$now."'),
					(127, 'Mies -  Nuevo Caranal', 'CMIESI01', 'CMIESI01',  11, '".$now."', '".$now."'),
					(128, 'Monte de los Olivos -  Palestina', 'CMONTE01', 'CMONTE01',  13, '".$now."', '".$now."'),
					(129, 'Monte Carmelo -  Cubará', 'CMONTE02', 'CMONTE02',  19, '".$now."', '".$now."'),
					(130, 'Monte Alto -  D. Tibú', 'CMONTE03', 'CMONTE03',  23, '".$now."', '".$now."'),
					(131, 'Moriach - Pueblo Nuevo', 'CMORIA01', 'CMORIA01',  16, '".$now."', '".$now."'),
					(132, 'Nueva Jerusalen  -  Pamplona', 'CNUEVA01', 'CNUEVA01',  14, '".$now."', '".$now."'),
					(133, 'Nueva Jerusalen -  Getsemani ', 'CNUEVA02', 'CNUEVA02',  26, '".$now."', '".$now."'),
					(134, 'Nueva Jerusalen - Atalaya ', 'CNUEJE01', 'CNUEJE01',  9, '".$now."', '".$now."'),
					(135, 'Nueva Esperanza -  Libertad ', 'CNUEVA03', 'CNUEVA03',  10, '".$now."', '".$now."'),
					(136, 'Nueva Galilea - Cúcuta Sión ', 'CNVAGA01', 'CNVAGA01',  24, '".$now."', '".$now."'),
					(137, 'Nueva Esperanza - Ocaña ', 'CNUEVA04', 'CNUEVA04',  12, '".$now."', '".$now."'),
					(138, 'Nuevo Eden -  Nuevo Caranal ', 'CNUEVO01', 'CNUEVO01',  11, '".$now."', '".$now."'),
					(139, 'Ocaña -  Ocaña ', 'COCAÑA01', 'COCAÑA01',  12, '".$now."', '".$now."'),
					(140, 'Olivares -  Pueblo Nuevo ', 'COLIVA01', 'COLIVA01',  16, '".$now."', '".$now."'),
					(141, 'Orión -  Fortul ', 'CORION01', 'CORION01',  8, '".$now."', '".$now."'),
					(142, 'Orion -  Cúbará ', 'CORION02', 'CORION02',  19, '".$now."', '".$now."'),
					(143, 'Ovejas -  Libertad ', 'COVEJA01', 'COVEJA01',  10, '".$now."', '".$now."'),
					(144, 'Paraiso Pachelly -  D. Tibú ', 'CPACHE01', 'CPACHE01',  23, '".$now."', '".$now."'),
					(145, 'Palestina -  Palestina ', 'CPALES01', 'CPALES01',  13, '".$now."', '".$now."'),
					(146, 'Palestina -  Libertad ', 'CPALES02', 'CPALES02',  10, '".$now."', '".$now."'),
					(147, 'Paraiso -  Arauca Betania', 'CPARAI01', 'CPARAI01',  2, '".$now."', '".$now."'),
					(148, 'Paraiso -  Palestina', 'CPARAI02', 'CPARAI02',  13, '".$now."', '".$now."'),
					(149, 'Paraiso Bochalema -  Patios', 'CPARAI03', 'CPARAI03',  15, '".$now."', '".$now."'),
					(150, 'Paraiso -  Getsemani', 'CPARAI04', 'CPARAI04',  26, '".$now."', '".$now."'),
					(151, 'Paraiso - D. Bethel', 'CPARAI05', 'CPARAI05',  5, '".$now."', '".$now."'),
					(152, 'Peniel -  Bethel', 'CPENIE01', 'CPENIE01',  5, '".$now."', '".$now."'),
					(153, 'Peniel -  Cúbará', 'CPENIE02', 'CPENIE02',  19, '".$now."', '".$now."'),
					(154, 'Peniel -  Libertad', 'CPENIE03', 'CPENIE03',  10, '".$now."', '".$now."'),
					(155, 'Peniel Simon - Pamplona', 'CPENIEL04', 'CPENIEL04',  14, '".$now."', '".$now."'),
					(156, 'Peniel - Arauquita central', 'CPENIE05', 'CPENIE05',  3, '".$now."', '".$now."'),
					(157, 'Peniel - Tame Oriental', 'CPENIE06', 'CPENIE06',  22, '".$now."', '".$now."'),
					(158, 'Puerto Rico - Redencion', 'CPTORI01', 'CPTORI01',  17, '".$now."', '".$now."'),
					(159, 'Puerto Rondon -  Tame Central', 'CPUERT01', 'CPUERT01',  21, '".$now."', '".$now."'),
					(160, 'Ragonvalia - Villa del Rosario', 'CRAGON01', 'CRAGON01',  27, '".$now."', '".$now."'),
					(161, 'Redención -  Redencion', 'CREDEN01', 'CREDEN01',  17, '".$now."', '".$now."'),
					(162, 'Redención -  Ocaña', 'CREDEN02', 'CREDEN02',  12, '".$now."', '".$now."'),
					(163, 'Redención - Cúcuta Sión', 'CREDEN03', 'CREDEN03',  24, '".$now."', '".$now."'),
					(164, 'Refugio -  D. Atalaya', 'CREFUG01', 'CREFUG01',  9, '".$now."', '".$now."'),
					(165, 'Remanente -  Nuevo Caranal', 'CREMAN01', 'CREMAN01',  11, '".$now."', '".$now."'),
					(166, 'Filial Remanente - D. Arauquita', 'CREMAN02', 'CREMAN02',  3, '".$now."', '".$now."'),
					(167, 'Renacer-Maporita -  Arauquita', 'CRENAC01', 'CRENAC01',  3, '".$now."', '".$now."'),
					(168, 'Renacer -  Redención', 'CRENAC02', 'CRENAC02',  17, '".$now."', '".$now."'),
					(169, 'Renacer -  D. Renacer', 'CRENAC03', 'CRENAC03',  18, '".$now."', '".$now."'),
					(170, 'Renacer -  Vichada', 'CRENAC04', 'CRENAC04',  25, '".$now."', '".$now."'),
					(171, 'Renacer -  Ocaña', 'CRENAC05', 'CRENAC05',  12, '".$now."', '".$now."'),
					(172, 'Renacer - Nuevo Caranal', 'CRENAC07', 'CRENAC07',  11, '".$now."', '".$now."'),
					(173, 'Renacer - Tame Oriental', 'CRENAC06', 'CRENAC06',  22, '".$now."', '".$now."'),
					(174, 'Renacer - D. Arauca Central', 'CRENAC08', 'CRENAC08',  1, '".$now."', '".$now."'),
					(175, 'Renacer - D. Libertad', 'CRENAC09', 'CRENAC09',  10, '".$now."', '".$now."'),
					(176, 'Renacer - Saravena Central', 'CRENAC10', 'CRENAC10',  20, '".$now."', '".$now."'),
					(177, 'Renacer - Arauquita Maranatha', 'CRENAC011', 'CRENAC011',  4, '".$now."', '".$now."'),
					(178, 'Salen -  Tame Oriental', 'CSALEN01', 'CSALEN01',  22, '".$now."', '".$now."'),
					(179, 'Sama -  Nuevo Caranal', 'CSAMAI01', 'CSAMAI01',  11, '".$now."', '".$now."'),
					(180, 'Siloe -  Pamplona', 'CSAMAR01', 'CSAMAR01',  14, '".$now."', '".$now."'),
					(181, 'Samaritana -  Ocaña', 'CSAMAR02', 'CSAMAR02',  12, '".$now."', '".$now."'),
					(182, 'Horeb - San francisco  - D. Nuevo Caranal', 'CHOREB07', 'CHOREB07',  11, '".$now."', '".$now."'),
					(183, 'Saravena Central -  Saravena Central', 'CSARAV01', 'CSARAV01',  20, '".$now."', '".$now."'),
					(184, 'Salvación -  Ocaña', 'CSALVA01', 'CSALVA01',  12, '".$now."', '".$now."'),
					(185, 'Sardis - D. Sión', 'CZARDI01', 'CZARDI01',  24, '".$now."', '".$now."'),
					(186, 'Sarón -  Arauca Central', 'CSARON01', 'CSARON01',  1, '".$now."', '".$now."'),
					(187, 'Saron -  Palestina', 'CSARON02', 'CSARON02',  13, '".$now."', '".$now."'),
					(188, 'Saron -  Bethel', 'CSARON03', 'CSARON03',  5, '".$now."', '".$now."'),
					(189, 'Sarón - Pamplona', 'CSARON04', 'CSARON04',  14, '".$now."', '".$now."'),
					(190, 'Shaday - Bethel', 'CSHADA01', 'CSHADA01',  5, '".$now."', '".$now."'),
					(191, 'Shalon, Panama -  Pueblo Nuevo', 'CSHALO01', 'CSHALO01',  16, '".$now."', '".$now."'),
					(192, 'Senderos - Villa del Rosario', 'CSENDE01', 'CSENDE01',  27, '".$now."', '".$now."'),
					(193, 'Shalon -  Bethel', 'CSHALO02', 'CSHALO02',  5, '".$now."', '".$now."'),
					(194, 'Valle de Sarón - D. Cucuta Central', 'CSHALO03', 'CSHALO03',  6, '".$now."', '".$now."'),
					(195, 'Siloe -  Tame Central', 'CSILOE01', 'CSILOE01',  21, '".$now."', '".$now."'),
					(196, 'Siloe -  Arauquita Maranatha', 'CSILOE02', 'CSILOE02',  4, '".$now."', '".$now."'),
					(197, 'Siloe -  Bethel', 'CSILOE03', 'CSILOE03',  5, '".$now."', '".$now."'),
					(198, 'Siloe - Ocaña', 'CSILOE04', 'CSILOE04',  12, '".$now."', '".$now."'),
					(199, 'Sinai -  Cubará', 'CSINAI01', 'CSINAI01',  19, '".$now."', '".$now."'),
					(200, 'Sinai -  Patios', 'CSINAI02', 'CSINAI02',  15, '".$now."', '".$now."'),
					(201, 'Sinai - D. Pueblo Nuevo', 'CSINAI03', 'CSINAI03',  16, '".$now."', '".$now."'),
					(202, 'Sinai - Vichada', 'CSINAI04', 'CSINAI04',  25, '".$now."', '".$now."'),
					(203, 'Grupo Sion - Cubará', 'CSIONG01', 'CSIONG01',  19, '".$now."', '".$now."'),
					(204, 'Sion -  Bethel', 'CSIONI01', 'CSIONI01',  5, '".$now."', '".$now."'),
					(205, 'Sion -  Cucuta Sión', 'CSIONI02', 'CSIONI02',  24, '".$now."', '".$now."'),
					(206, 'Sión -  Ocaña', 'CSIONI03', 'CSIONI03',  12, '".$now."', '".$now."'),
					(207, 'Smirna -  Cucuta Central', 'CSMIRN01', 'CSMIRN01',  6, '".$now."', '".$now."'),
					(208, 'Soledad -  D. Tibú', 'CSOLED01', 'CSOLED01',  23, '".$now."', '".$now."'),
					(209, 'Sucot  -  Fortul', 'CSUCOT01', 'CSUCOT01',  8, '".$now."', '".$now."'),
					(210, 'El Caucho - D. Arauquita', 'CCAUCH01', 'CCAUCH01',  3, '".$now."', '".$now."'),
					(211, 'Amanecer - Nuevo Caranal', 'CAMANE01', 'CAMANE01',  11, '".$now."', '".$now."'),
					(212, 'Grupo Tabiro - D. Cúcuta Central', 'CTABIR01', 'CTABIR01',  6, '".$now."', '".$now."'),
					(213, 'Grupo Torcoroma 3 - D. Libertad', 'CTORCO03', 'CTORCO03',  10, '".$now."', '".$now."'),
					(214, 'Tres Angeles -  Villa Del Rosario', 'CTRESA01', 'CTRESA01',  27, '".$now."', '".$now."'),
					(215, 'El Vergel -  Pueblo Nuevo', 'CVERGE01', 'CVERGE01',  16, '".$now."', '".$now."'),
					(216, 'Villa de Emaus -  Tame Central', 'CVILLA01', 'CVILLA01',  21, '".$now."', '".$now."'),
					(217, 'Voz de Salvación -  Palestina', 'CVOZDE01', 'CVOZDE01',  13, '".$now."', '".$now."'),
					(218, 'Zulia  -  D. Atalaya', 'CZULIA01', 'CZULIA01',  9, '".$now."', '".$now."')
					;";
					
			DB::insert($consulta);
		}
		return 'Insertando';
	}


}