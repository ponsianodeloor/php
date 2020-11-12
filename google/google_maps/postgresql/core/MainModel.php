<?php
 include_once "Base.php";

class MainModel extends Base{

 function __construct(){
  parent::__construct();
 }
	function session_php(){
		if (!isset($_SESSION)){
			 session_start();
		}
	}

 protected function conectar(){
  $link_database = new PDO(SGBD, USER, PASS);
  return $link_database;
 }

 function execSQL($sql){
		//$this->dbh->exec($sql);
  MainModel::conectar()->exec($sql);
	}

 function get_id($campo_id, $tabla){
		$sql = "SELECT MAX(".$campo_id.") AS get_id FROM ".$tabla."";
		isset($RsGet_id);
		$RsGet_id = $this->getRows($sql);
		foreach($RsGet_id as $row_RsGet_id){}
		return ($row_RsGet_id['get_id']);
	}

	function getRows($sql){ //MainModel::conectar()->exec($sql);
  //$st = $this->dbh->prepare($sql);
  $st = MainModel::conectar()->prepare($sql);
  $st->execute();
  return $st->fetchAll();
 }

 protected function simpleQuery($sql){
  $query = MainModel::conectar()->prepare($sql);
  //$query = self::conectar()->prepare($sql); //las dos opciones son validas
  $query->execute();
  return $query;
 }

 //metodos que sirven para desencriptar
 //procesa el valor y lo encripta
 public static function encryption($string){
		$output=FALSE;
		$key=hash('sha256', SECRET_KEY);
		$iv=substr(hash('sha256', SECRET_IV), 0, 16);
		$output=openssl_encrypt($string, METHOD, $key, 0, $iv);
		$output=base64_encode($output);
		return $output;
	}

 //procesa el valor y lo desencripta
	public static function decryption($string){
		$key=hash('sha256', SECRET_KEY);
		$iv=substr(hash('sha256', SECRET_IV), 0, 16);
		$output=openssl_decrypt(base64_decode($string), METHOD, $key, 0, $iv);
		return $output;
	}
 ///metodos que sirven para desencriptar

 protected function swetAlert($datosArray){
  if ($datosArray['Alerta'] == "simple") {
   $alerta = "
   <script>
     swal(
      '".$datosArray['Titulo']."',
      '".$datosArray['Texto']."',
      '".$datosArray['Tipo']."',
     );
   </script>
   ";
  }elseif ($datosArray['Alerta'] == "recarga") {
   $alerta = "
   <script>
   swal({
    title: '".$datosArray['Titulo']."',
    text: '".$datosArray['Texto']."',
    icon: '".$datosArray['Tipo']."',
    confirmButtonText: 'Aceptar'
   }).then(function (){
    location.reload();
   });
   </script>
   ";
  }elseif ($datosArray['Alerta'] == "limpiar") {
   $alerta = "
   <script>
   swal({
    title: '".$datosArray['Titulo']."',
    text: '".$datosArray['Texto']."',
    type: '".$datosArray['Tipo']."',
    confirmButtonText: 'Aceptar'
   }).then(function (){
     $('.FormularioAjax')[0].reset();
    });
   </script>
   ";
  }
  return $alerta;
 } //sweetAlert

 protected function agregarCuenta($datos){
  $query = MainModel::conectar()->prepare("INSERT INTO cuenta(
                                            CuentaCodigo,
                                            CuentaPrivilegio,
                                            CuentaUsuario,
                                            CuentaClave,
                                            CuentaEmail,
                                            CuentaEstado,
                                            CuentaTipo,
                                            CuentaGenero,
                                            CuentaFoto
                                           )
                                           VALUES(
                                            :CuentaCodigo,
                                            :CuentaPrivilegio,
                                            :CuentaUsuario,
                                            :CuentaClave,
                                            :CuentaEmail,
                                            :CuentaEstado,
                                            :CuentaTipo,
                                            :CuentaGenero,
                                            :CuentaFoto
                                           )
                                          ");
  $query->bindParam(":CuentaCodigo", $datos['CuentaCodigo']);
  $query->bindParam(":CuentaPrivilegio", $datos['CuentaPrivilegio']);
  $query->bindParam(":CuentaUsuario", $datos['CuentaUsuario']);
  $query->bindParam(":CuentaClave", $datos['CuentaClave']);
  $query->bindParam(":CuentaEmail", $datos['CuentaEmail']);
  $query->bindParam(":CuentaEstado", $datos['CuentaEstado']);
  $query->bindParam(":CuentaTipo", $datos['CuentaTipo']);
  $query->bindParam(":CuentaGenero", $datos['CuentaGenero']);
  $query->bindParam(":CuentaFoto", $datos['CuentaFoto']);
  $query->execute();
  return $query;
 }

 protected function eliminarCuenta($CuentaCodigo){
  $query = MainModel::conectar()->prepare("DELETE FROM cuenta WHERE CuentaCodigo = :CuentaCodigo");
  $query->bindParam(":CuentaCodigo", $CuentaCodigo);
  $query->execute();
  return $query;
 }

 protected function guardarBitacora($datos){
  $query = MainModel::conectar()->prepare("INSERT INTO bitacora(
                                                        BitacoraCodigo,
                                                        BitacoraFecha,
                                                        BitacoraHoraInicio,
                                                        BitacoraHoraFinal,
                                                        BitacoraTipo,
                                                        BitacoraYear,
                                                        CuentaCodigo
                                                       )
                                                       VALUES(
                                                        :BitacoraCodigo,
                                                        :BitacoraFecha,
                                                        :BitacoraHoraInicio,
                                                        :BitacoraHoraFinal,
                                                        :BitacoraTipo,
                                                        :BitacoraYear,
                                                        :CuentaCodigo
                                                       )");
  $query->bindParam(":BitacoraCodigo", $datos['BitacoraCodigo']);
  $query->bindParam(":BitacoraFecha", $datos['BitacoraFecha']);
  $query->bindParam(":BitacoraHoraInicio", $datos['BitacoraHoraInicio']);
  $query->bindParam(":BitacoraHoraFinal", $datos['BitacoraHoraFinal']);
  $query->bindParam(":BitacoraTipo", $datos['BitacoraTipo']);
  $query->bindParam(":BitacoraYear", $datos['BitacoraYear']);
  $query->bindParam(":CuentaCodigo", $datos['CuentaCodigo']);
  $query->execute();
  return $query;
 }
 protected function actualizarBitacora($datos){
  $query = MainModel::conectar()->prepare("UPDATE bitacora
                                           SET BitacoraHoraFinal = :BitacoraHoraFinal
                                           WHERE BitacoraCodigo = :BitacoraCodigo
                                          ");
  $query->bindParam(":BitacoraHoraFinal", $datos['hora']);
  $query->bindParam(":BitacoraCodigo", $datos['usuario_codigo_bitacora_sbp']);
  $query->execute();
  return $query;
 }

 protected function eliminarBitacora($CuentaCodigo){
  $query = MainModel::conectar()->prepare("DELETE FROM bitacora WHERE CuentaCodigo = :CuentaCodigo");
  $query->bindParam(":CuentaCodigo", $CuentaCodigo);
  $query->execute();
  return $query;
 }

 /* las funciones estan ordenadas alfabeticamente */
 //a
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
 //b
 //c
 public function contarSQL($campo, $tablaWhere){
		$sql = "SELECT count($campo) as contar_sql FROM $tablaWhere";
		$RsContarRegistro = $this->getRows($sql);
		@@$cant_registros_encontrados = is_null();
		foreach($RsContarRegistro as $row_RsContarRegistro){
		$cant_registros_encontrados = $row_RsContarRegistro['contar_sql'];
		}
		return ($cant_registros_encontrados);
	}

 //d
 //e
 //f
  //fechas
  protected function comparar_fechas($fecha_1, $fecha_2){
 		$datetime1 = date_create("$fecha_1 00:00:01");
 		$datetime2 = date_create("$fecha_2 00:00:01");
 		$interval = date_diff($datetime1, $datetime2);
 		//$interval->format('%R%a días %H horas %I minutos %S segundos');
 		return $interval->format('%R%a');
 	}

  protected function diferencias_fechas($fecha_1, $fecha_2){
 		//Formato de la fecha "2015-02-14" "2015-02-16"
 		$date1 = new DateTime($fecha_1);
 		$date2 = new DateTime($fecha_2);
 		$diff = $date1->diff($date2);
 		// will output 2 days
 		return $diff->days;
 	}

  public function fechaHoraSystem(){
   return date('Y-m-d H:i:s');
  }

  public function fechaHoraSystemEncryption(){
   return date('YmdHis');
  }

  public function fechaSystem(){
   return date('Y-m-d');
  }

  public function horaSystem(){
   return date('H:i:s');
  }

  public function sumar_restar_dias_fecha($fecha, $dias){
 		$dias.=' days';
 		$fecha = date_create($fecha);
 		date_add($fecha, date_interval_create_from_date_string($dias));
 		return (date_format($fecha, 'Y-m-d'));
 	}

  ///fechas
 //g
 protected function generarCodigoAleatorio($letra, $longitud, $numero){
  for ($i=1; $i <$longitud ; $i++) {
   $numero = rand(0,9);
   $letra .= $numero;
  }
  return $letra.$numero;
 }

 //h
 //i
 protected function insertarRegistro($tabla, $campos, $valores){
		$sql = "INSERT INTO ".$tabla."(";
		foreach($campos as $row){ 	$sql .=$row.", "; }
		$sql = substr($sql, 0, -2).") VALUES (";
		foreach($valores as $row){ 	$sql .="'".$row."', "; }
		$sql = substr($sql, 0, -2).");";
		$this->execSQL($sql);
	}

 protected function insertarRegistroUnCampo($tabla, $campos, $valores){
		$sql = "INSERT INTO ".$tabla."(";
		foreach($campos as $row){ $sql .=$row; }
		$sql.=") VALUES (";
		foreach($valores as $row){ $sql .="'".$row."'"; }
		echo $sql.= ");";
		$this->execSQL($sql);
	}

 //j
 //k
 //l
 protected function limpiarCadena($campoFormulario){
  $campoFormulario = trim($campoFormulario);
  $campoFormulario = stripslashes($campoFormulario);
  $cadena = str_ireplace('<script>', '', $campoFormulario); //str_ireplace($search, $replace, $subject);
  $cadena = str_ireplace('</script>', '', $campoFormulario);
  $cadena = str_ireplace('<script src>', '', $campoFormulario);
  $cadena = str_ireplace('<script type=>', '', $campoFormulario);
  $cadena = str_ireplace('SELECT * FROM', '', $campoFormulario);
  $cadena = str_ireplace('DELETE FROM', '', $campoFormulario);
  $cadena = str_ireplace('INSERT INTO', '', $campoFormulario);
  $cadena = str_ireplace('--', '', $campoFormulario);
  $cadena = str_ireplace('^', '', $campoFormulario);
  $cadena = str_ireplace('[', '', $campoFormulario);
  $cadena = str_ireplace(']', '', $campoFormulario);
  $cadena = str_ireplace('==', '', $campoFormulario);
  return $cadena;
}

 public function lstSql($sql){
  foreach($this->getRows($sql) as $row){
   echo '<option value = '.$row[0].'>'.$row[1].'</option>';
  }
 }
 //m
 //n
 //o
 //p
 //q
 //r
 //s
 //t
 public function tablaSql($cabecera, array $campos,$tabla_vista_condicion,$botones){
 	$campos_count = count($cabecera);
  echo "<div class=\"table-responsive\">";
 	echo "<table class ='table table-hover text-center'>";
 		if ($botones == "") { $acciones = ""; }else{ $acciones = "Acciones"; }
 		echo "<thead>";echo "<th class=\"text-center\">$acciones</th>";
 			foreach($cabecera as $fila){
 				if($fila == 'id'){
 					goto anclaje;
 				}
 				echo "<th class=\"text-center\">".$fila."</th>";
 				anclaje:
 			}
 		echo "</thead>";
   echo "<tbody>";
 	$campos = str_replace(']',"",
 						  str_replace('[',"",
 									  str_replace('"',"",json_encode($campos))
 									 )
 						 );
 	$sql = 'SELECT '.$campos.' FROM '.$tabla_vista_condicion;
 	foreach($this->getRows($sql) as $row){
 		echo '<tr>';
   //echo "<td>".str_replace("row",$row[0],$botones)."</td>";
 		echo "<td>".str_replace("row",MainModel::encryption($row[0]),$botones)."</td>";
 		for($i = 1;$i<$campos_count;$i++){
 			echo '<td>'.$row[$i].'</td>';
 		}
 		echo '</tr>';
 	}
  echo "</tbody>";
 	echo "</table>";
 }
 //u
 //v
 //w
 //x
 //y
 //z
}//MainModel

?>
