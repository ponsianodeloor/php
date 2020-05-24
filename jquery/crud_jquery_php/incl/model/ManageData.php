<?php
require_once("class.database.php");
date_default_timezone_set("America/Guayaquil");
$fecha_system = date('Y-m-d');
$hora_system  = date('H:i:s');
$fecha_hora_system = date("Y-m-d H:i:s");

class ManageData extends Database
{
	function __construct(){
                parent::__construct();
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
		echo "<table class ='table'>";
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
					if($extension =='jpg' || $extension =='png'){
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

	function get_sum($campo_id, $tabla_condicion){
		$sql = "SELECT SUM(".$campo_id.") AS suma FROM ".$tabla_condicion."";
		$RsGet_id = $this->getRows($sql);
		foreach($RsGet_id as $row_RsGet){}
		return ($row_RsGet['suma']);
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
	//Calculos String
}//Class

$class_ManageData = new ManageData;
