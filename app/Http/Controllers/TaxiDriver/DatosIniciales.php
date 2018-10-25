<?php namespace App\Http\Controllers\TaxiDriver;

use Request;
use Hash;

use DB;
use Carbon\Carbon;

class DatosIniciales {

	public function insertarTaxistas()
	{
		
		$taxis 		= DB::select('SELECT * from tx_taxistas;');
		
		if (count($taxis) == 0) {
			$now = Carbon::now('America/Bogota');
			
			$consulta = "INSERT INTO tx_taxistas
					(id, nombres, apellidos, sexo, usuario, documento, celular, password, created_at, updated_at)
				VALUES
					(1, 'Soloza', 'Gilberto', 'M', 'SolozaG', '96191454','320 856 1398', '123', '".$now."', '".$now."'),
					(2, 'Sandra Patricia', 'Navas Abril', 'F', 'SandraP', '23913131', '313 892 9533', '123', '".$now."', '".$now."'),
					(3, 'Juan Carlos ', 'Ortega ', 'M', 'JuanC23', '23913131', '320 856 1398', '123', '".$now."', '".$now."'),
					(4, 'Jesus Marino', 'Gomez Gomez', 'M', 'JesusM2', '17546992', '310 568 0860', '123', '".$now."', '".$now."'),
					(5, 'Jose David', 'Rivera Espinosa', 'M', 'Jose22', '96194337', '312 493 9028', '123', '".$now."', '".$now."'),
					(6, 'Wilmar Jesus', 'Vega Pelayo ', 'M', 'Wilmar32', '68301687', '312 801 6855', '123', '".$now."', '".$now."'),
					(7, 'Edilson', 'Riaño Bermudez ', 'M', 'Edilson5', '23913131', '320 856 1398', '123', '".$now."', '".$now."'),
					(8, 'Luz Mery', 'Reyes Leon ', 'F', 'Luz22', '68.302.732', '311 820 2654', '123', '".$now."', '".$now."'),
					(9, 'Luis Hernando ', 'Silva Bernal ', 'M', 'Luis227', '80.725.143', '311 531 2303', '123', '".$now."', '".$now."'),
					(10, 'Nilce', 'Calderon Benavides  ', 'M', 'Nilce1', '68.301.705', '312 333 5014', '123', '".$now."', '".$now."'),
					(11, 'Esteban', ' Martinez Gomez  ', 'M', 'Esteban222', '17.549.111', '312 497 4989', '123', '".$now."', '".$now."'),
					(12, 'Benjamin', 'Ochoa Castro ', 'M', 'Benjamin123', '96.192.130', '312 423 2820', '123', '".$now."', '".$now."'),
					(13, 'Jose De Jesus', 'Ortiz Ospina  ', 'M', 'Jose653', '1.039.400.302', '320 209 8524', '123', '".$now."', '".$now."'),
					(14, 'Serafin', 'Mateus Merchan ', 'M', 'Serafin33', '3.021.893', '311 854 0977', '123', '".$now."', '".$now."'),
					(15, 'Jose Agustin', 'Pineda Mendez ', 'M', 'Agustin22', '79.125.243', '320 908 1908', '123', '".$now."', '".$now."'),
					(16, 'Amin Exdunio', 'Rios Gomez ', 'M', 'Amin444', '17.547.961', '312 497 4989', '123', '".$now."', '".$now."'),
					(17, 'Edwin Jovan', 'Parra Molina ', 'M', 'Edwin77', '91.518.854', '314 254 3095', '123', '".$now."', '".$now."'),
					(18, 'Wilfer', 'Higuera Delgado ', 'M', 'Wilfer33', '91.183.816', '311 469 0924', '123', '".$now."', '".$now."'),
					(19, 'Luis Noel', 'Vega Ramos  ', 'M', 'Luis4423', '17.548.656', '311 242 7456', '123', '".$now."', '".$now."'),
					(20, 'Mauricio ', 'Pinzon Pinzon  ', 'M', 'Mauricio55', '13.958.889', '313 516 3106', '123', '".$now."', '".$now."'),
					(21, 'Gerardo', ' Benitez Sierra  ', 'M', 'Gerardo22', '96.191.318', '321 466 4823', '123', '".$now."', '".$now."'),
					(22, 'Obet', 'Parada Parada  ', 'M', 'Obet', '7.361.169', '312 482 5821', '123', '".$now."', '".$now."'),
					(23, 'Luis Eduardo', 'Albino Pinzon', 'M', 'LuisE', '5.695.514', '315 342 9342', '123', '".$now."', '".$now."'),
					(24, 'Leidy Milena', 'Angarita Saavedra ', 'F', 'Leidy22', '1.116.782.854', '310 281 3772', '123', '".$now."', '".$now."'),
					(25, 'Maria De Jesus', 'Salazar Leon  ', 'F', 'Salazar512', '24.099.415', '310 567 4501', '123', '".$now."', '".$now."'),
					(26, 'Astrid Helena ', 'Castañeda Torres ', 'F', 'Astrid11', '1.098.607.777', '313 449 2272', '123', '".$now."', '".$now."'),
					(27, 'Claudia Maria ', 'Carrillo Monar ', 'F', 'Claudia45', '68.248.987', '312 363 2064', '123', '".$now."', '".$now."'),
					(28, 'Heladio ', 'Alvarez Niño  ', 'M', 'HeladioAlv', '17.546.244', '312 377 4505', '123', '".$now."', '".$now."'),
					(29, 'Cecilio', 'Antolinez Correa ', 'M', 'Cecilio66', '96.192.103', '321 210 8932', '123', '".$now."', '".$now."'),
					(30,'Isai', 'Rivera Espinosa  ', 'M', 'Isai15', '96.195.766', '310 2851 582', '123', '".$now."', '".$now."'),
					(31, 'Diana Lorena', 'Alvarado Velandia ', 'M', 'Diana41', '1.116.869.099', '312 402 5216', '123', '".$now."', '".$now."'),
					(32, 'Luis Fransisco', 'Parada Parada  ', 'M', 'Luis64', '7.311.169', '312 561 7271', '123', '".$now."', '".$now."'),
					(33, 'Zaida Yolima', 'Romero Chagualo ', 'M', 'Zaida33', '53.133.310', '321 398 7425', '123', '".$now."', '".$now."'),
					(34, 'Alexander', 'Ortiz  ', 'M', 'AlexanderOrt', '96.192.100', '313 261 7455', '123', '".$now."', '".$now."'),
					(35, 'Esteban Jhon Jairo', 'Gomez', 'M', 'Esteban622', '96.195.304', '312 554 8299', '123', '".$now."', '".$now."'),
					(36, 'Maria De Jesus ', 'Salazar Leon   ', 'F', 'Salazar512', '24.099.415', '310 567 4501', '123', '".$now."', '".$now."'),
					(37, 'Arnovis', 'Olaya Ortiz  ', 'M', 'Arnovis33', '17.588.825', '320 275 7062', '123', '".$now."', '".$now."'),
					(38, 'Reynaldo', 'Rodriguez Infante  ', 'M', 'Reynaldo22', '17.549.988', '312 432 3114', '123', '".$now."', '".$now."'),
					(39, 'Ricardo', 'Roa Daza  ', 'M', 'Ricardo11', '96.195.119', '311 233 0602', '123', '".$now."', '".$now."'),
					(40, 'Heris', 'Albarracin Arismendi  ', 'F', 'Heris33', '17.549.126', '314 402 1829', '123', '".$now."', '".$now."'),
					(41, 'Ana Leidis', 'Olivos Dulcey  ', 'F', 'Ana20', '68.290.339', '310 773 8148', '123', '".$now."', '".$now."'),
					(42, 'Jimmy Arturo', 'Niño Lavados   ', 'M', 'JimmyLa', '96.192.906', '312 573 2895', '123', '".$now."', '".$now."'),
					(43, 'Odila', 'Solano Rodriguez  ', 'F', 'OdilaSo', '68.306.982', '3108579063', '123', '".$now."', '".$now."'),
					(44, 'Faber Giovanny', 'Parales Barrera  ', 'M', 'Giovanny', '1.116.853.819', '3311 484 4932', '123', '".$now."', '".$now."'),
					(45, 'Carlos Andres', 'Avila Castiblanco ', 'M', 'Andres22', '96.194.131', '313 232 8642', '123', '".$now."', '".$now."'),
					(46, 'Edgar Esneyder ', 'Carrera Yunda  ', 'M', 'Esneyder', '1.116.863.223', '3222914708', '123', '".$now."', '".$now."'),
					(47, 'Martha Nancy', 'Solano Rodriguez  ', 'F', 'Martha', '40.774.728', '310 862 1183', '123', '".$now."', '".$now."'),
					(48, 'Jose Tebaldo', 'Solano Leon   ', 'M', 'Tebaldo', '74.300.064', '313 821 5679', '123', '".$now."', '".$now."'),
					(49, 'Alonso ', 'Florez Heber  ', 'M', 'Alonso', '96.192.501', '3114445393', '123', '".$now."', '".$now."'),
					(50, 'Roberth Leandro ', 'Parales Barrera  ', 'M', 'Roberth', '1.116.863.405', '320 242 2938', '123', '".$now."', '".$now."'),
					(51, 'Gladys ', 'Castillo Torres   ', 'F', 'Gladys', '24.245.406', '3208568416 ', '123', '".$now."', '".$now."'),
					(52, 'Lida Rocio ', 'Cruz Lizcano   ', 'M', 'Lida', '60.335.897', '3112679405', '123', '".$now."', '".$now."'),
					(53, 'Faber Giovanny ', 'Parales Barrera  ', 'M', 'Faber', '1.116.853.819', '311 484 4932', '123', '".$now."', '".$now."'),
					(54, 'Romulo Jose  ', 'Bello Ramirez  ', 'M', 'Romulo', '86.088.510', '3146562341', '123', '".$now."', '".$now."'),
					(55, 'Deibin Johan ', 'Olaya Goyeneche  ', 'M', 'Deibin', '1.116.856.895', '3125045393', '123', '".$now."', '".$now."'),
					(56, 'Jaider  ', 'Castillo Campos   ', 'M', 'Jaider11', '5.047.642', '311233526', '123', '".$now."', '".$now."'),
					(57, 'Luis Alberto ', 'Rodriguez Rodriguez  ', 'M', 'Luis51', '19.381.240', '310 766 9570', '123', '".$now."', '".$now."'),
					(58, 'Jorge Alberto  ', 'Sosa Valderrama  ', 'M', 'Jorge22', '7.217.328', '3115571308', '123', '".$now."', '".$now."'),
					(59, 'Ivan ', 'Ariza Niño  ', 'M', 'Ivan', '96.191.672', '3125422882', '123', '".$now."', '".$now."'),
					(60, 'Elvis Moises ', 'Valbuena Cobos  ', 'M', 'Elvis', '1.116.852.129', '3508216117', '123', '".$now."', '".$now."'),
					(61, 'Humberto  ', 'Herrera Rodriguez   ', 'M', 'Humberto', '96.194.752', '3115859125', '123', '".$now."', '".$now."'),
					(62, 'Carlina ', 'Correa Antolinez ', 'M', 'Carlina', '24.248.877', '3124819799', '123', '".$now."', '".$now."'),
					(63, 'Maria Kaory ', 'Rojas Lagos ', 'M', 'Maria22', '68.305.243', '3202758531', '123', '".$now."', '".$now."'),
					(64, 'Marisol ', 'Rivera Espinosa   ', 'M', 'Marisol', '68.304.364', '3142679470', '123', '".$now."', '".$now."'),
					(65, 'Amin Exdunio ', 'Rios Gomez ', 'M', 'Amin', '17.547.961', '3124974989', '123', '".$now."', '".$now."'),
					(66, 'Ildebrando ', 'Leal Carvajal ', 'M', 'Ildebrando', '19.397.853', '3107704276', '123', '".$now."', '".$now."'),
					(67, 'Willian Fernando  ', 'Duque Acosta', 'M', 'Willian', '17.548.791', '3103231887', '123', '".$now."', '".$now."'),
					(68, 'Nancy Consuelo ', 'Martinez Leon ', 'F', 'Nancy', '23.588.863', '3142996805', '123', '".$now."', '".$now."'),
					(69, 'Judith ', 'Manrique Peña  ', 'F', 'Judith', '51.707.358', '3163607652', '123', '".$now."', '".$now."'),
					(70, 'German	 ', 'Mora Gutierrez ', 'M', 'German', '96.189.594', '3203439507', '123', '".$now."', '".$now."')
					;";
					
			DB::insert($consulta);
		}
		return 'Insertando';
	}


	public function insertarTaxis()
	{
		
		$taxis 		= DB::select('SELECT * from tx_taxis;');
		
		if (count($taxis) == 0) {
			$now = Carbon::now('America/Bogota');
			
			$consulta = "INSERT INTO tx_taxis
					(id, placa, numero, taxista_id, created_at, updated_at)
				VALUES
					(1, 'SMJ-594', '017', 1, '".$now."', '".$now."'),
					(2, 'SMJ-686', '019', 2, '".$now."', '".$now."'),
					(3, 'SMJ-648', '024', 3, '".$now."', '".$now."'),
					(4, 'SMJ-577', '025', 4, '".$now."', '".$now."'),
					(5, 'SMJ-639', '035', 5, '".$now."', '".$now."'),
					(6, 'YAU-308', '045', 6, '".$now."', '".$now."'),
					(7, 'YAU-119', '047', 7, '".$now."', '".$now."'),
					(8, 'SMJ-688', '048', 8, '".$now."', '".$now."'),
					(9, 'YAU-191', '051', 9, '".$now."', '".$now."'),
					(10, 'YAU-108', '057', 10, '".$now."', '".$now."'),
					(11, 'SMJ-627', '059', 11, '".$now."', '".$now."'),
					(12, 'YAU-128', '062', 13, '".$now."', '".$now."'),
					(13, 'SMJ-670', '063', 14, '".$now."', '".$now."'),
					(14, 'SMJ-607', '071', 15, '".$now."', '".$now."'),
					(15, 'YAU-287', '076', 16, '".$now."', '".$now."'),
					(16, 'YAU-249', '078', 17, '".$now."', '".$now."'),
					(17, 'SMJ-517', '079', 18, '".$now."', '".$now."'),
					(18, 'YAU-243', '082', 19, '".$now."', '".$now."'),
					(19, 'SMJ-668', '084', 20, '".$now."', '".$now."'),
					(20, 'YAU-214', '085', 21, '".$now."', '".$now."'),
					(21, 'YAU-239', '086', 22, '".$now."', '".$now."'),
					(22, 'YAU-220', '088', 23, '".$now."', '".$now."'),
					(23, 'SMJ-679', '092', 24, '".$now."', '".$now."'),
					(24, 'SMJ-671', '093', 25, '".$now."', '".$now."'),
					(25, 'YAU-268', '094', 26, '".$now."', '".$now."'),
					(26, 'YAU-241', '099', 27, '".$now."', '".$now."'),
					(27, 'SMJ-605', '100', 28, '".$now."', '".$now."'),
					(28, 'SMJ-519', '102', 29, '".$now."', '".$now."'),
					(29, 'SMJ-532', '104', 30, '".$now."', '".$now."'),
					(30, 'SMJ-506', '105', 31, '".$now."', '".$now."'),
					(31, 'SMJ-512', '107', 32, '".$now."', '".$now."'),
					(32, 'YAU-115', '110', 33, '".$now."', '".$now."'),
					(33, 'SMJ-564', '112', 34, '".$now."', '".$now."'),
					(34, 'SMJ-608', '113', 35, '".$now."', '".$now."'),
					(35, 'SMJ-692', '115', 36, '".$now."', '".$now."'),
					(36, 'YAU-336', '116', 37, '".$now."', '".$now."'),
					(37, 'YAU-327', '118', 38, '".$now."', '".$now."'),
					(38, 'SMJ-554', '119', 39, '".$now."', '".$now."'),
					(39, 'SMJ-603', '122', 40, '".$now."', '".$now."'),
					(40, 'SMJ-573', '123', 41, '".$now."', '".$now."'),
					(41, 'SMJ-547', '124', 42, '".$now."', '".$now."'),
					(42, 'YAU-132', '125', 43, '".$now."', '".$now."'),
					(43, 'SMJ-568', '128', 44, '".$now."', '".$now."'),
					(44, 'SMJ-561', '130', 45, '".$now."', '".$now."'),
					(45, 'SMJ-581', '131', 46, '".$now."', '".$now."'),
					(46, 'SMJ-591', '132', 47, '".$now."', '".$now."'),
					(47, 'SMJ-601', '133', 48, '".$now."', '".$now."'),
					(48, 'SMJ-597', '134', 49, '".$now."', '".$now."'),
					(49, 'SMJ-538', '136', 50, '".$now."', '".$now."'),
					(50, 'SMJ-520', '139', 51, '".$now."', '".$now."'),
					(51, 'SMJ-579', '140', 52, '".$now."', '".$now."'),
					(52, 'SMJ-582', '142', 53, '".$now."', '".$now."'),
					(53, 'SMJ-604', '143', 54, '".$now."', '".$now."'),
					(54, 'SMJ-595', '145', 55, '".$now."', '".$now."'),
					(55, 'SMJ-628', '147', 56, '".$now."', '".$now."'),
					(56, 'SMJ-566', '148', 57, '".$now."', '".$now."'),
					(57, 'SMJ-584', '149', 58, '".$now."', '".$now."'),
					(58, 'SMJ-658', '151', 59, '".$now."', '".$now."'),
					(59, 'SMJ-575', '152', 60, '".$now."', '".$now."'),
					(60, 'YAU-215', '153', 61, '".$now."', '".$now."'),
					(61, 'SMJ-539', '156', 62, '".$now."', '".$now."'),
					(62, 'YAU-297', '159', 63, '".$now."', '".$now."'),
					(63, 'SMJ-500', '160', 64, '".$now."', '".$now."'),
					(64, 'SMJ-643', '165', 65, '".$now."', '".$now."'),
					(65, 'YAU-298', '166', 66, '".$now."', '".$now."'),
					(66, 'SMJ-657', '170', 67, '".$now."', '".$now."'),
					(67, 'SMJ-563', '171', 68, '".$now."', '".$now."'),
					(68, 'SMJ-696', '173', 69, '".$now."', '".$now."'),
					(69, 'SMJ-689', '174', 70, '".$now."', '".$now."'),
					(70, 'SMJ-693', '176', 71, '".$now."', '".$now."')
					;";
					
			DB::insert($consulta);
		}
		return 'Insertando';
	}
	

	public function insertarCarreras()
	{
		
		$carreras 		= DB::select('SELECT * from tx_carreras;');
		
		if (count($carreras) == 0) {
			$now = Carbon::now('America/Bogota');
			
			$consulta = "INSERT INTO tx_carreras
					(id, taxi_id, taxista_id, zona, fecha_ini, lugar_ini, lugar_fin, fecha_fin, estado, created_at, updated_at)
				VALUES
					(1, 2,2,'z1','2018-07-22 16:26','el parque','el parque2','2018-07-22','Cancelada', '".$now."', '".$now."'),
					(2, 3,3,'z1','2018-07-22','los lanceros','el parque2','2018-07-22','Cancelada', '".$now."', '".$now."')
					;";
					
			DB::insert($consulta);
		}
		return 'Insertando';
	}


	public function insertarUsuarios()
	{
		
		$users 		= DB::select('SELECT * from tx_users;');
		
		if (count($users) == 0) {
			$now = Carbon::now('America/Bogota');
			
			$consulta = "INSERT INTO tx_users
					(id, nombres, apellidos, usuario, password, tipo, sexo, created_at, updated_at)
				VALUES
					(1, 'Admin', 'Peñarredonda Silva', 'Guillermo',  '123', 'Admin', 'M', '".$now."', '".$now."'),
					(2, 'Marinella', 'Silva Gonzalez', 'Mary',  '123', 'Admin', 'F', '".$now."', '".$now."'),
					(3, 'Jenny', 'Villareal', 'jenny',  '123', 'Operador', 'F', '".$now."', '".$now."')
					;";
					
			DB::insert($consulta);
		}
		return 'Insertando';
	}


}