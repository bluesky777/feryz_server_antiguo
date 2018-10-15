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
					(nombres, apellidos, sexo, usuario, documento, celular, password, created_at, updated_at)
				VALUES
					('Soloza', 'Gilberto', 'M', 'SolozaG', '96191454','320 856 1398', '123', '".$now."', '".$now."'),
					('Sandra Patricia', 'Navas Abril', 'F', 'SandraP', '23913131', '313 892 9533', '123', '".$now."', '".$now."'),
					('Juan Carlos ', 'Ortega ', 'M', 'JuanC23', '23913131', '320 856 1398', '123', '".$now."', '".$now."'),
					('Jesus Marino', 'Gomez Gomez', 'M', 'JesusM2', '17546992', '310 568 0860', '123', '".$now."', '".$now."'),
					('Jose David', 'Rivera Espinosa', 'M', 'Jose22', '96194337', '312 493 9028', '123', '".$now."', '".$now."'),
					('Wilmar Jesus', 'Vega Pelayo ', 'M', 'Wilmar32', '68301687', '312 801 6855', '123', '".$now."', '".$now."'),
					('Edilson', 'Riaño Bermudez ', 'M', 'Edilson5', '23913131', '320 856 1398', '123', '".$now."', '".$now."'),
					('Luz Mery', 'Reyes Leon ', 'F', 'Luz22', '68.302.732', '311 820 2654', '123', '".$now."', '".$now."'),
					('Luis Hernando ', 'Silva Bernal ', 'M', 'Luis227', '80.725.143', '311 531 2303', '123', '".$now."', '".$now."'),
					('Nilce', 'Calderon Benavides  ', 'M', 'Nilce1', '68.301.705', '312 333 5014', '123', '".$now."', '".$now."'),
					('Esteban', ' Martinez Gomez  ', 'M', 'Esteban222', '17.549.111', '312 497 4989', '123', '".$now."', '".$now."'),
					('Benjamin', 'Ochoa Castro ', 'M', 'Benjamin123', '96.192.130', '312 423 2820', '123', '".$now."', '".$now."'),
					('Jose De Jesus', 'Ortiz Ospina  ', 'M', 'Jose653', '1.039.400.302', '320 209 8524', '123', '".$now."', '".$now."'),
					('Serafin', 'Mateus Merchan ', 'M', 'Serafin33', '3.021.893', '311 854 0977', '123', '".$now."', '".$now."'),
					('Jose Agustin', 'Pineda Mendez ', 'M', 'Agustin22', '79.125.243', '320 908 1908', '123', '".$now."', '".$now."'),
					('Amin Exdunio', 'Rios Gomez ', 'M', 'Amin444', '17.547.961', '312 497 4989', '123', '".$now."', '".$now."'),
					('Edwin Jovan', 'Parra Molina ', 'M', 'Edwin77', '91.518.854', '314 254 3095', '123', '".$now."', '".$now."'),
					('Wilfer', 'Higuera Delgado ', 'M', 'Wilfer33', '91.183.816', '311 469 0924', '123', '".$now."', '".$now."'),
					('Luis Noel', 'Vega Ramos  ', 'M', 'Luis4423', '17.548.656', '311 242 7456', '123', '".$now."', '".$now."'),
					('Mauricio ', 'Pinzon Pinzon  ', 'M', 'Mauricio55', '13.958.889', '313 516 3106', '123', '".$now."', '".$now."'),
					('Gerardo', ' Benitez Sierra  ', 'M', 'Gerardo22', '96.191.318', '321 466 4823', '123', '".$now."', '".$now."'),
					('Obet', 'Parada Parada  ', 'M', 'Obet', '7.361.169', '312 482 5821', '123', '".$now."', '".$now."'),
					('Luis Eduardo', 'Albino Pinzon', 'M', 'LuisE', '5.695.514', '315 342 9342', '123', '".$now."', '".$now."'),
					('Leidy Milena', 'Angarita Saavedra ', 'F', 'Leidy22', '1.116.782.854', '310 281 3772', '123', '".$now."', '".$now."'),
					('Maria De Jesus', 'Salazar Leon  ', 'F', 'Salazar512', '24.099.415', '310 567 4501', '123', '".$now."', '".$now."'),
					('Astrid Helena ', 'Castañeda Torres ', 'F', 'Astrid11', '1.098.607.777', '313 449 2272', '123', '".$now."', '".$now."'),
					('Claudia Maria ', 'Carrillo Monar ', 'F', 'Claudia45', '68.248.987', '312 363 2064', '123', '".$now."', '".$now."'),
					('Heladio ', 'Alvarez Niño  ', 'M', 'HeladioAlv', '17.546.244', '312 377 4505', '123', '".$now."', '".$now."'),
					('Cecilio', 'Antolinez Correa ', 'M', 'Cecilio66', '96.192.103', '321 210 8932', '123', '".$now."', '".$now."'),
					('Isai', 'Rivera Espinosa  ', 'M', 'Isai15', '96.195.766', '310 2851 582', '123', '".$now."', '".$now."'),
					('Diana Lorena', 'Alvarado Velandia ', 'M', 'Diana41', '1.116.869.099', '312 402 5216', '123', '".$now."', '".$now."'),
					('Luis Fransisco', 'Parada Parada  ', 'M', 'Luis64', '7.311.169', '312 561 7271', '123', '".$now."', '".$now."'),
					('Zaida Yolima', 'Romero Chagualo ', 'M', 'Zaida33', '53.133.310', '321 398 7425', '123', '".$now."', '".$now."'),
					('Alexander', 'Ortiz  ', 'M', 'AlexanderOrt', '96.192.100', '313 261 7455', '123', '".$now."', '".$now."'),
					('Esteban Jhon Jairo', 'Gomez', 'M', 'Esteban622', '96.195.304', '312 554 8299', '123', '".$now."', '".$now."'),
					('Maria De Jesus ', 'Salazar Leon   ', 'F', 'Salazar512', '24.099.415', '310 567 4501', '123', '".$now."', '".$now."'),
					('Arnovis', 'Olaya Ortiz  ', 'M', 'Arnovis33', '17.588.825', '320 275 7062', '123', '".$now."', '".$now."'),
					('Reynaldo', 'Rodriguez Infante  ', 'M', 'Reynaldo22', '17.549.988', '312 432 3114', '123', '".$now."', '".$now."'),
					('Ricardo', 'Roa Daza  ', 'M', 'Ricardo11', '96.195.119', '311 233 0602', '123', '".$now."', '".$now."'),
					('Heris', 'Albarracin Arismendi  ', 'F', 'Heris33', '17.549.126', '314 402 1829', '123', '".$now."', '".$now."'),
					('Ana Leidis', 'Olivos Dulcey  ', 'F', 'Ana20', '68.290.339', '310 773 8148', '123', '".$now."', '".$now."'),
					('Jimmy Arturo', 'Niño Lavados   ', 'M', 'JimmyLa', '96.192.906', '312 573 2895', '123', '".$now."', '".$now."'),
					('Odila', 'Solano Rodriguez  ', 'F', 'OdilaSo', '68.306.982', '3108579063', '123', '".$now."', '".$now."'),
					('Faber Giovanny', 'Parales Barrera  ', 'M', 'Giovanny', '1.116.853.819', '3311 484 4932', '123', '".$now."', '".$now."'),
					('Carlos Andres', 'Avila Castiblanco ', 'M', 'Andres22', '96.194.131', '313 232 8642', '123', '".$now."', '".$now."'),
					('Edgar Esneyder ', 'Carrera Yunda  ', 'M', 'Esneyder', '1.116.863.223', '3222914708', '123', '".$now."', '".$now."'),
					('Martha Nancy', 'Solano Rodriguez  ', 'F', 'Martha', '40.774.728', '310 862 1183', '123', '".$now."', '".$now."'),
					('Jose Tebaldo', 'Solano Leon   ', 'M', 'Tebaldo', '74.300.064', '313 821 5679', '123', '".$now."', '".$now."'),
					('Alonso ', 'Florez Heber  ', 'M', 'Alonso', '96.192.501', '3114445393', '123', '".$now."', '".$now."'),
					('Roberth Leandro ', 'Parales Barrera  ', 'M', 'Roberth', '1.116.863.405', '320 242 2938', '123', '".$now."', '".$now."'),
					('Gladys ', 'Castillo Torres   ', 'F', 'Gladys', '24.245.406', '3208568416 ', '123', '".$now."', '".$now."'),
					('Lida Rocio ', 'Cruz Lizcano   ', 'M', 'Lida', '60.335.897', '3112679405', '123', '".$now."', '".$now."'),
					('Faber Giovanny ', 'Parales Barrera  ', 'M', 'Faber', '1.116.853.819', '311 484 4932', '123', '".$now."', '".$now."'),
					('Romulo Jose  ', 'Bello Ramirez  ', 'M', 'Romulo', '86.088.510', '3146562341', '123', '".$now."', '".$now."'),
					('Deibin Johan ', 'Olaya Goyeneche  ', 'M', 'Deibin', '1.116.856.895', '3125045393', '123', '".$now."', '".$now."'),
					('Jaider  ', 'Castillo Campos   ', 'M', 'Jaider11', '5.047.642', '311233526', '123', '".$now."', '".$now."'),
					('Luis Alberto ', 'Rodriguez Rodriguez  ', 'M', 'Luis51', '19.381.240', '310 766 9570', '123', '".$now."', '".$now."'),
					('Jorge Alberto  ', 'Sosa Valderrama  ', 'M', 'Jorge22', '7.217.328', '3115571308', '123', '".$now."', '".$now."'),
					('Ivan ', 'Ariza Niño  ', 'M', 'Ivan', '96.191.672', '3125422882', '123', '".$now."', '".$now."'),
					('Elvis Moises ', 'Valbuena Cobos  ', 'M', 'Elvis', '1.116.852.129', '3508216117', '123', '".$now."', '".$now."'),
					('Humberto  ', 'Herrera Rodriguez   ', 'M', 'Humberto', '96.194.752', '3115859125', '123', '".$now."', '".$now."'),
					('Carlina ', 'Correa Antolinez ', 'M', 'Carlina', '24.248.877', '3124819799', '123', '".$now."', '".$now."'),
					('Maria Kaory ', 'Rojas Lagos ', 'M', 'Maria22', '68.305.243', '3202758531', '123', '".$now."', '".$now."'),
					('Marisol ', 'Rivera Espinosa   ', 'M', 'Marisol', '68.304.364', '3142679470', '123', '".$now."', '".$now."'),
					('Amin Exdunio ', 'Rios Gomez ', 'M', 'Amin', '17.547.961', '3124974989', '123', '".$now."', '".$now."'),
					('Ildebrando ', 'Leal Carvajal ', 'M', 'Ildebrando', '19.397.853', '3107704276', '123', '".$now."', '".$now."'),
					('Willian Fernando  ', 'Duque Acosta', 'M', 'Willian', '17.548.791', '3103231887', '123', '".$now."', '".$now."'),
					('Nancy Consuelo ', 'Martinez Leon ', 'F', 'Nancy', '23.588.863', '3142996805', '123', '".$now."', '".$now."'),
					('Judith ', 'Manrique Peña  ', 'F', 'Judith', '51.707.358', '3163607652', '123', '".$now."', '".$now."'),
					('German	 ', 'Mora Gutierrez ', 'M', 'German', '96.189.594', '3203439507', '123', '".$now."', '".$now."')
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
					(placa, numero, taxista_id, created_at, updated_at)
				VALUES
					('SMJ-594', '017', 1, '".$now."', '".$now."'),
					('SMJ-686', '019', 2, '".$now."', '".$now."'),
					('SMJ-648', '024', 3, '".$now."', '".$now."'),
					('SMJ-577', '025', 4, '".$now."', '".$now."'),
					('SMJ-639', '035', 5, '".$now."', '".$now."'),
					('YAU-308', '045', 6, '".$now."', '".$now."'),
					('YAU-119', '047', 7, '".$now."', '".$now."'),
					('SMJ-688', '048', 8, '".$now."', '".$now."'),
					('YAU-191', '051', 9, '".$now."', '".$now."'),
					('YAU-108', '057', 10, '".$now."', '".$now."'),
					('SMJ-627', '059', 11, '".$now."', '".$now."'),
					('YAU-128', '062', 13, '".$now."', '".$now."'),
					('SMJ-670', '063', 14, '".$now."', '".$now."'),
					('SMJ-607', '071', 15, '".$now."', '".$now."'),
					('YAU-287', '076', 16, '".$now."', '".$now."'),
					('YAU-249', '078', 17, '".$now."', '".$now."'),
					('SMJ-517', '079', 18, '".$now."', '".$now."'),
					('YAU-243', '082', 19, '".$now."', '".$now."'),
					('SMJ-668', '084', 20, '".$now."', '".$now."'),
					('YAU-214', '085', 21, '".$now."', '".$now."'),
					('YAU-239', '086', 22, '".$now."', '".$now."'),
					('YAU-220', '088', 23, '".$now."', '".$now."'),
					('SMJ-679', '092', 24, '".$now."', '".$now."'),
					('SMJ-671', '093', 25, '".$now."', '".$now."'),
					('YAU-268', '094', 26, '".$now."', '".$now."'),
					('YAU-241', '099', 27, '".$now."', '".$now."'),
					('SMJ-605', '100', 28, '".$now."', '".$now."'),
					('SMJ-519', '102', 29, '".$now."', '".$now."'),
					('SMJ-532', '104', 30, '".$now."', '".$now."'),
					('SMJ-506', '105', 31, '".$now."', '".$now."'),
					('SMJ-512', '107', 32, '".$now."', '".$now."'),
					('YAU-115', '110', 33, '".$now."', '".$now."'),
					('SMJ-564', '112', 34, '".$now."', '".$now."'),
					('SMJ-608', '113', 35, '".$now."', '".$now."'),
					('SMJ-692', '115', 36, '".$now."', '".$now."'),
					('YAU-336', '116', 37, '".$now."', '".$now."'),
					('YAU-327', '118', 38, '".$now."', '".$now."'),
					('SMJ-554', '119', 39, '".$now."', '".$now."'),
					('SMJ-603', '122', 40, '".$now."', '".$now."'),
					('SMJ-573', '123', 41, '".$now."', '".$now."'),
					('SMJ-547', '124', 42, '".$now."', '".$now."'),
					('YAU-132', '125', 43, '".$now."', '".$now."'),
					('SMJ-568', '128', 44, '".$now."', '".$now."'),
					('SMJ-561', '130', 45, '".$now."', '".$now."'),
					('SMJ-581', '131', 46, '".$now."', '".$now."'),
					('SMJ-591', '132', 47, '".$now."', '".$now."'),
					('SMJ-601', '133', 48, '".$now."', '".$now."'),
					('SMJ-597', '134', 49, '".$now."', '".$now."'),
					('SMJ-538', '136', 50, '".$now."', '".$now."'),
					('SMJ-520', '139', 51, '".$now."', '".$now."'),
					('SMJ-579', '140', 52, '".$now."', '".$now."'),
					('SMJ-582', '142', 53, '".$now."', '".$now."'),
					('SMJ-604', '143', 54, '".$now."', '".$now."'),
					('SMJ-595', '145', 55, '".$now."', '".$now."'),
					('SMJ-628', '147', 56, '".$now."', '".$now."'),
					('SMJ-566', '148', 57, '".$now."', '".$now."'),
					('SMJ-584', '149', 58, '".$now."', '".$now."'),
					('SMJ-658', '151', 59, '".$now."', '".$now."'),
					('SMJ-575', '152', 60, '".$now."', '".$now."'),
					('YAU-215', '153', 61, '".$now."', '".$now."'),
					('SMJ-539', '156', 62, '".$now."', '".$now."'),
					('YAU-297', '159', 63, '".$now."', '".$now."'),
					('SMJ-500', '160', 64, '".$now."', '".$now."'),
					('SMJ-643', '165', 65, '".$now."', '".$now."'),
					('YAU-298', '166', 66, '".$now."', '".$now."'),
					('SMJ-657', '170', 67, '".$now."', '".$now."'),
					('SMJ-563', '171', 68, '".$now."', '".$now."'),
					('SMJ-696', '173', 69, '".$now."', '".$now."'),
					('SMJ-689', '174', 70, '".$now."', '".$now."'),
					('SMJ-693', '176', 71, '".$now."', '".$now."')
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
					(taxi_id, taxista_id, zona, fecha_ini, lugar_inicio, lugar_fin, fecha_fin, estado, created_at, updated_at)
				VALUES
					(2,2,'z1','2018-07-22 16:26','el parque','el parque2','2018-07-22','Cancelada', '".$now."', '".$now."'),
					(3,3,'z1','2018-07-22','los lanceros','el parque2','2018-07-22','Cancelada', '".$now."', '".$now."'),
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
					(nombres, apellidos, usuario, password, tipo, sexo, created_at, updated_at)
				VALUES
					('Admin', 'Peñarredonda Silva', 'Guillermo',  '123', 'Admin', 'M', '".$now."', '".$now."'),
					('Marinella', 'Silva Gonzalez', 'Mary',  '123', 'Admin', 'F', '".$now."', '".$now."'),
					('Jenny', 'Villareal', 'jenny',  '123', 'Operador', 'F', '".$now."', '".$now."')
					;";
					
			DB::insert($consulta);
		}
		return 'Insertando';
	}


}