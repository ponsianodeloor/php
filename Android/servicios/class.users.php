<?php
require_once("class.database.php");
date_default_timezone_set("America/Guayaquil");
setlocale(LC_MONETARY, 'en_US'); //echo money_format('%i', $number) . "\n";
$fecha_system = date('Y-m-d');
$hora_system  = date('H:i:s');
$fecha_hora_system = date("Y-m-d H:i:s");

class Users extends Database
{
	function __construct(){
                parent::__construct();
    }
	function session_php(){
		if (!isset($_SESSION)){
			 session_start();
		}
	}
	function execSQL($sql){
		$this->dbh->exec($sql);
	}
	function getRows($sql){
                $st = $this->dbh->prepare($sql);
                $st->execute();
                return $st->fetchAll();
 }
	function get_id($campo_id, $tabla){
		$sql = "SELECT MAX(".$campo_id.") AS get_id FROM ".$tabla."";
		isset($RsGet_id);
		$RsGet_id = $this->getRows($sql);
		foreach($RsGet_id as $row_RsGet_id){}
		return ($row_RsGet_id['get_id']);
	}
	function actualizarRegistro($tabla, $campos, $valores, $condicion){
		$sql = "UPDATE ".$tabla." SET ";
		$cant_campos = 0;
		foreach($campos as $row_campos){ $cant_campos++;}
		foreach($valores as $row_valores){ }
		for($i=0;$i<$cant_campos;$i++){
			$sql .= $campos[$i] ." = '".$valores[$i]."', ";
		}
		$sql = substr($sql, 0, -2).' '.$condicion;
		$this->execSQL($sql);
	}
	function actualizarRegistroUnCampo($tabla, $campos, $valores, $condicion){
		$sql = "UPDATE ".$tabla." SET ";
		$cant_campos = 0;
		foreach($campos as $row_campos){ $cant_campos++;}
		foreach($valores as $row_valores){ }
		for($i=0;$i<$cant_campos;$i++){
			$sql .= $campos[$i] ." = '".$valores[$i]."'";
		}
		$sql .= ' '.$condicion;
		$this->execSQL($sql);
	}
	function CalculaEdad($fecha){
		list($Y,$m,$d) = explode("-",$fecha);
		return( date("md") < $m.$d ? date("Y")-$Y-1 : date("Y")-$Y );
	}
	//Funciones para Crear Imagenes Livianas
	function CargarJpeg($imagen)
	{
		/* Intentar abrir */
		$im = @imagecreatefromjpeg($imagen);
		/* Ver si falló */
		if(!$im)
		{
			/* Crear una imagen en blanco */
			$im  = imagecreatetruecolor(150, 30);
			$fondo = imagecolorallocate($im, 255, 255, 255);
			$ct  = imagecolorallocate($im, 0, 0, 0);
			imagefilledrectangle($im, 0, 0, 150, 30, $fondo);
			/* Imprimir un mensaje de error */
			imagestring($im, 1, 5, 5, 'Error cargando ' . $imagen, $ct);
		}
		return $im;
	}
	//*Funciones para Crear Imagenes Livianas
	function contarAtrasos($campo, $tablaWhere){
		$sql = "SELECT count($campo) as contar_atrasos FROM $tablaWhere";
		$RsContarAtrasos = $this->getRows($sql);
		@@$cant_registros_encontrados = is_null();
		foreach($RsContarAtrasos as $row_RsContarAtrasos){
		$cant_registros_encontrados = $row_RsContarAtrasos['contar_atrasos'];
		}
		return ($cant_registros_encontrados);
	}
	function comprobarRegistro($campo, $tabla, $condicion){
		$sql = "SELECT count($campo) as comprobarRegistro FROM $tabla WHERE $condicion";
		$RsComprobarRegistro = $this->getRows($sql);
		foreach($RsComprobarRegistro as $row_RsComprobarRegistro){}
		return ($row_RsComprobarRegistro['comprobarRegistro']);
	}
	function contarSQL($campo, $tablaWhere){
		$sql = "SELECT count($campo) as contar_sql FROM $tablaWhere";
		$RsContarRegistro = $this->getRows($sql);
		@@$cant_registros_encontrados = is_null();
		foreach($RsContarRegistro as $row_RsContarRegistro){
		$cant_registros_encontrados = $row_RsContarRegistro['contar_sql'];
		}
		return ($cant_registros_encontrados);
	}
	function formatear_fecha($fecha_time){
		return strtotime($fecha_time) * 1000;
	}

	function get_sum($campo_id, $tabla_condicion){
		$sql = "SELECT SUM(".$campo_id.") AS suma FROM ".$tabla_condicion."";
		$RsGet_id = $this->getRows($sql);
		foreach($RsGet_id as $row_RsGet){}
			if($row_RsGet['suma'] == ''){
				$row_RsGet['suma'] = 0;
			}
		return ($row_RsGet['suma']);
	}
	function insertarRegistroUnCampo($tabla, $campos, $valores){
		$sql = "INSERT INTO ".$tabla."(";
		foreach($campos as $row){ $sql .=$row; }
		$sql.=") VALUES (";
		foreach($valores as $row){ $sql .="'".$row."'"; }
		echo $sql.= ");";
		$this->execSQL($sql);
	}
	function insertarRegistro($tabla, $campos, $valores){
		$sql = "INSERT INTO ".$tabla."(";
		foreach($campos as $row){ 	$sql .=$row.", "; }
		$sql = substr($sql, 0, -2).") VALUES (";
		foreach($valores as $row){ 	$sql .="'".$row."', "; }
		$sql = substr($sql, 0, -2).");";
		$this->execSQL($sql);
	}
	function login($user, $pass){
		if($user <> "" and $pass <>""){
			$sql = "SELECT * FROM usuarios WHERE (usuario_cedula = '$user'
			OR usuario = '$user' OR usuario_email = '$user')
			AND usuario_pass_md5_sha1 = '".sha1(md5($pass))."';";

			$RsGetEstado_id = $this->getRows($sql);
			foreach($RsGetEstado_id as $row_RsGetEstado_id){}

			$_SESSION['usuario_id']	= @@$row_RsGetEstado_id['usuario_id'];
			$_SESSION['rol']		= @@$row_RsGetEstado_id['usuario_usuario_rol_id'];
			$_SESSION['username']	= @@$row_RsGetEstado_id['usuario'];
			$_SESSION['where_eventos'] = 'WHERE paciente_tratamiento_asignacion_paciente_id='.@@$row_RsGetEstado_id['usuario_id'];
			return (@@$row_RsGetEstado_id['usuario_estado_id'].
				"/".@@$row_RsGetEstado_id['usuario_usuario_rol_id'].
				"/".@@$row_RsGetEstado_id['usuario_id']."/");
		}
	}
	function login_android($user, $pass){
		if($user <> "" and $pass <>""){
			$sql = "SELECT * FROM usuarios WHERE (usuario_cedula = '$user'
			OR usuario = '$user' OR usuario_email = '$user')
			AND usuario_pass_md5_sha1 = '".sha1(md5($pass))."';";

			$RsGetEstado_id = $this->getRows($sql);
			foreach($RsGetEstado_id as $row_RsGetEstado_id){}

			$_SESSION['id']			= @@$row_RsGetEstado_id['usuario_id'];
			$_SESSION['rol']		= @@$row_RsGetEstado_id['usuario_usuario_rol_id'];
			$_SESSION['username']	= @@$row_RsGetEstado_id['usuario'];
			$_SESSION['where_eventos'] = 'WHERE paciente_tratamiento_asignacion_paciente_id='.@@$row_RsGetEstado_id['usuario_id'];
			return (@@$row_RsGetEstado_id['usuario_usuario_rol_id']);
		}
	}
	function lstSql($sql){
		foreach($this->getRows($sql) as $row){
			echo '<option value = '.$row[0].'>'.$row[1].'</option>';
		}
	}
	function lstSqlSelected($sql, $id_selected){
		foreach($this->getRows($sql) as $row_lst_selected){
			if($row_lst_selected[0] == $id_selected){$selected ="selected=\"selected\"";}else{$selected="";}
			echo '<option value = '.$row_lst_selected[0].' '.$selected.'>'.$row_lst_selected[1].'</option>';
		}
	}
	function lstSql_x2_campos($sql, $separador){
		foreach($this->getRows($sql) as $row){
			echo '<option value = '.$row[0].'>'.$row[1].$separador.$row[2].$separador.$row[3].$separador.$row[4].$separador.$row[5].$separador.'</option>';
		}
	}//se debe obtener la cantidad de campos y realizar un for por campos

	function lstSql_x_campos_separador($sql, $campos, $separador){
		foreach($this->getRows($sql) as $row){
			//echo '<option value = '.$row[0].'>'.$row[1].$separador.$row[2].$separador.$row[3].$separador.$row[4].$separador.$row[5].$separador;
			echo '<option value = '.$row[0].'>';
			for($i=1;$i<=$campos;$i++){
				echo $row[$i].$separador;
			}
			echo "</option>'";
		}
	}
	function lstSql_x_campos_separador_selected($sql, $campos, $separador, $id_selected){
		foreach($this->getRows($sql) as $row_lst_selected){
			if($row_lst_selected[0] == $id_selected){$selected ="selected=\"selected\"";}else{$selected="";}
			echo '<option value = '.$row_lst_selected[0].' '.$selected.'>';
			for($i=1;$i<=$campos;$i++){
				echo $row_lst_selected[$i].$separador;
			}
			echo "</option>'";
		}
	}

	function tablaSql($cabecera, array $campos,$tabla_vista_condicion,$botones){
		$campos_count = count($cabecera);
		echo "<table class ='table table-hover'>";
			if ($botones == "") { $acciones = ""; }else{ $acciones = "Acciones"; }
			echo "<tr>";echo "<td>$acciones</td>";
				foreach($cabecera as $fila){
					if($fila == 'id'){
						goto anclaje;
					}
					echo "<td>".$fila."</td>";
					anclaje:
				}
			echo "</tr>";
		$campos = str_replace(']',"",
							  str_replace('[',"",
										  str_replace('"',"",json_encode($campos))
										 )
							 );
		$sql = 'SELECT '.$campos.' FROM '.$tabla_vista_condicion;
		foreach($this->getRows($sql) as $row){
			echo '<tr>';
			echo "<td>".str_replace("row",$row[0],$botones)."</td>";
			for($i = 1;$i<$campos_count;$i++){
				echo '<td>'.$row[$i].'</td>';
			}
			echo '</tr>';
		}
		echo "</table>";
	}
	function tablaSqlImg($cabecera, array $campos,$tabla_vista_condicion,$botones, $directorio){
		echo '<div class="docs-galley">';
			$campos_count = count($cabecera);
			echo "<table class ='table'>";
				echo "<tr>";echo '<td>Acciones</td>';
					foreach($cabecera as $fila){
						if($fila == 'id'){
							goto anclaje;
						}
						echo "<td>".$fila."</td>";
						anclaje:
					}
				echo "</tr>";
			$campos = str_replace(']',"",
								  str_replace('[',"",
											  str_replace('"',"",json_encode($campos))
											 )
								 );
			$sql = 'SELECT '.$campos.' FROM '.$tabla_vista_condicion;
			foreach($this->getRows($sql) as $row){
				echo '<tr>';
				echo "<td>".str_replace("row",$row[0],$botones)."</td>";
				for($i = 1;$i<$campos_count;$i++){
					$row_explode = explode(".", $row[$i]);
					$extension = @@$row_explode[1];
					echo '<td>';
					//echo $row[$i].' '.$extension;
					if($extension =='jpg' || $extension =='png' || $extension =='jpeg'){
						echo '<div class="docs-galley">';
							echo '<ul class="docs-pictures clearfix">';
								echo '<li><img data-original="'.$directorio.$row[$i].'" src="'.$directorio.$row[$i].'" height = "25%" width = "25%"></li>';
							echo '</ul>';
						echo '</div>';
					}elseif($extension=='pdf'){
							//echo $row[$i];
							echo '<li><img data-original="'.$directorio.$row[$i].'" src="'."img/pdf.png".'" height = "10%" width = "10%"></li>';
					}elseif($extension=='doc' || $extension=='docx'){
							//echo $row[$i];
							echo '<li><img data-original="'.$directorio.$row[$i].'" src="'."img/doc.png".'" height = "10%" width = "10%"></li>';
					}elseif($extension=='nef'){
							//echo $row[$i];
							echo '<li><img data-original="'.$directorio.$row[$i].'" src="'."img/nef.png".'" height = "10%" width = "20%"></li>';
					}else{

						echo $row[$i];

					}
					echo '</td>';

				}
				echo '</tr>';
			}
			echo "</table>";
		echo "<div>";
	}
	function tablaSqlPdf($cabecera, array $campos,$tabla_vista_condicion,$cabecera_botones,$botones){
		$campos_count = count($cabecera);
		echo "<table border='1' style='font: 12px times new roman; border: rgb(96,20,64); border-collapse: collapse;'>";
			echo "<tr>";echo "<td>$cabecera_botones</td>";
				foreach($cabecera as $fila){
					if($fila == 'id'){
						goto anclaje;
					}
					echo "<td>".$fila."</td>";
					anclaje:
				}
			echo "</tr>";
		$campos = str_replace(']',"",
							  str_replace('[',"",
										  str_replace('"',"",json_encode($campos))
										 )
							 );
		$sql = 'SELECT '.$campos.' FROM '.$tabla_vista_condicion;
		foreach($this->getRows($sql) as $row){
			echo '<tr>';
			echo "<td>".str_replace("row",$row[0],$botones)."</td>";
			for($i = 1;$i<$campos_count;$i++){
				echo '<td>'.$row[$i].'</td>';
			}
			echo '</tr>';
		}
		echo "</table>";
	}
	function tablaSqlPdf2Columnas($cabecera, array $campos,$tabla_vista_condicion,$cabecera_botones,$botones){
		//Normalmente se usa el primer campo como fecha
		$campos_count = count($cabecera);
		echo "<table border='1' style='font: 12px times new roman; border: rgb(96,20,64); border-collapse: collapse;'>";
			echo "<tr>";echo "<td>$cabecera_botones</td>";
				foreach($cabecera as $fila){
					if($fila == 'id'){
						goto anclaje;
					}
					echo "<td>".$fila."</td>";
					anclaje:
				}
			echo "</tr>";
		$campos = str_replace(']',"",
							  str_replace('[',"",
										  str_replace('"',"",json_encode($campos))
										 )
							 );
		$sql = 'SELECT '.$campos.' FROM '.$tabla_vista_condicion;
		foreach($this->getRows($sql) as $row){
			echo '<tr>';
			echo "<td>".str_replace("row",$row[0],$botones)."</td>";
			for($i = 1;$i<$campos_count;$i++){
				//Se realizan modificaciones para que el primer campo no se aumenten  los pixeles
				if($i > 1){
					echo '<td style=\'width: 580px\'>'.$row[$i].'</td>';
				}else{
					echo '<td>'.$row[$i].'</td>';
				}

			}
			echo '</tr>';
		}
		echo "</table>";
	}






	//fechas datetime
	function sumar_restar_dias_fecha($fecha, $dias){
		$dias.=' days';
		$fecha = date_create($fecha);
		date_add($fecha, date_interval_create_from_date_string($dias));
		return (date_format($fecha, 'Y-m-d'));
	}
	function comparar_fechas($fecha_1, $fecha_2){
		$datetime1 = date_create("$fecha_1 00:00:01");
		$datetime2 = date_create("$fecha_2 00:00:01");
		$interval = date_diff($datetime1, $datetime2);

		//$interval->format('%R%a días %H horas %I minutos %S segundos');
		return $interval->format('%R%a');
	}
	function diferencias_fechas($fecha_1, $fecha_2){
		//Formato de la fecha "2015-02-14" "2015-02-16"
		$date1 = new DateTime($fecha_1);
		$date2 = new DateTime($fecha_2);
		$diff = $date1->diff($date2);
		// will output 2 days
		return $diff->days;
	}



	//Funcion Dame tiempo
	function dameTiempo(){
		$fecha = date('2015-10-01');
		switch (date("l")){
			case "Monday": 		$dia = "Lunes";		break;
			case "Tuesday":		$dia = "Martes";	break;
			case "Wednesday": 	$dia = "Miercoles"; break;
			case "Thursday":	$dia = "Jueves";	break;
			case "Friday":		$dia = "Viernes";	break;
			case "Saturday":	$dia = "S&aacute;bado";	break;
			case "Sunday":		$dia = "Domingo";	break;
			}
		switch (date("F")){
			case "January":		$mes = "Enero";		break;
			case "February":	$mes = "Febrero";	break;
			case "March":		$mes = "Marzo";		break;
			case "April":		$mes = "Abril";		break;
			case "May":			$mes = "Mayo";		break;
			case "June":		$mes = "Junio";		break;
			case "July":		$mes = "Julio";		break;
			case "August":		$mes = "Agosto";	break;
			case "September":	$mes = "Septiembre";break;
			case "October":		$mes = "Octubre";	break;
			case "November":	$mes = "Noviembre";	break;
			case "December":	$mes = "Diciembre";	break;
			}
	return ("Hoy es ".$dia.", ".date("j")." de ".$mes." del ".date("Y"));
	}
	//*Funcion Dame Tiempo
	//fechas datetime
	//Calculos String
	//Saludar
	function saludar(){
		$today = getdate();
		$hora=$today["hours"];
		if ($hora<6){
			return(" Hoy has madrugado mucho... ");
		}elseif($hora<12){
			return(" Buen día ");
			}elseif($hora<=18){
				return("Buena Tarde ");
		}else{
			return("Buena Noche ");
		}
	}
	//*Saludar
	function generarRandomString($length = 10){
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}
	function concatena_texto_numero($cadena, $ceros, $no_registro, $extencion){
	$concatena=$cadena.$ceros.$no_registro;
	$resultado = substr ( $ceros ,0,strlen($ceros)-strlen($no_registro));
	$concatena = $resultado.$no_registro;
	return ($cadena.$concatena.$extencion);
	}
	//Calculos String

	//Funciones para la facturacion electronica


	function modulo11($_rol,$ulala) {
	 $cadenaOriginalRecibida=$_rol;
	    // Removemos los 0
	    $total=0;
	   // while($_rol[0] == "0") {        $_rol = substr($_rol, 1); }
	    $factor = 2;
	    $suma = 0;
	    for($i = strlen($_rol) - 1; $i >= 0; $i--) {
	    $factores=$factor * $_rol[$i];
	        $suma += $factor * $_rol[$i];
	  $htmlFactor.=$factor."*".$_rol[$i]."=".$factores."<br/>";
	        $factor = $factor % 7 == 0 ? 2 : $factor + 1;
	        $total=$_rol[$i]+$total;
	    }
	    $moduloBruto=$suma % 11;
	    $codigoBruto=11 - $moduloBruto;
	    $dv = 11 - $moduloBruto;
	    // Por alguna razon me daba que 11 % 11 = 11. Esto lo resuelve.
	    //$dv = $dv == 11 ? 0 : ($dv == 10 ? "K" : $dv);
	        if($dv=="K"){ $dv=1; }
	       if($dv==10){ $dv=1; }
	        if($dv==11){ $dv=0; }
	     $modulo['total']=$total;
	     $htmlFactor.="<hr/>Total: ".$suma."<br/>";
	       $htmlFactor.=$suma." % 11 = ".$moduloBruto."<br/>";
	              $htmlFactor.="11 - ".$moduloBruto."  = ".$codigoBruto."<br/>";
	    $modulo['htmlFactor']=$htmlFactor;
	     $modulo['bruto']=$suma;
	        $modulo['codigoverificador']=$dv;
	    $modulo['cadenacompleta']=$cadenaOriginalRecibida.$dv;
	    $modulo['cantidadDigitos']=strlen($cadenaOriginalRecibida);
	    return  $modulo;
	}

	//*Funciones para la facturacion electronica

}//Class
$class_Users = new Users;
$class_Users->session_php();
$usuario_session_id = @@$_SESSION['usuario_id'];
$usuario_session_rol_id = @@$_SESSION['rol'];
$usuario_session = @@$_SESSION['username'];

if($usuario_session_id == ""){
	// header("location: https://medcalendar.apptics.com.ec");
	header("location: ../../");
}


//$usuario_nombre =
//$usuario_register_id = $class_Users->getRows("SELECT usuario_id from usuarios WHERE usuario_nombre = $lst_ciudad_id");
