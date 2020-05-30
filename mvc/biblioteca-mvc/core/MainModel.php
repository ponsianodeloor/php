<?php
 if ($peticion_ajax) {
  include_once "../core/Base.php";
 }else{
  include_once "core/Base.php";
 }

 /**
  *
  */
 class MainModel{

  function __construct(){}

   protected function conectar(){
    $link_database = new PDO(SGBD, USER, PASS);
    return $link_database;
   }

   protected function simpleQuery($sql){
    $query = MainModel::conectar()->prepare($sql);
    //$query = self::conectar()->prepare($sql); //las dos opciones son validas
    $query->execute();
    return $query;
   }

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
   $query = MainModel::conectar()->prepare("DELETE FROM cuenta WHERE CuentaCodigo == :CuentaCodigo");
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
  protected function actualizarBitacora($codigo, $hora){
   $query = MainModel::conectar()->prepare("UPDATE bitacora
                                            SET BitacoraHoraFinal = :BitacoraHoraFinal
                                            WHERE BitacoraCodigo = :BitacoraCodigo
                                           ");
   $query->bindParam(":BitacoraHoraFinal", $datos['BitacoraHoraFinal']);
   $query->bindParam(":BitacoraCodigo", $datos['BitacoraCodigo']);
  }

  protected function eliminarBitacora($CuentaCodigo){
   $query = MainModel::conectar()->prepare("DELETE FROM bitacora WHERE CuentaCodigo = :CuentaCodigo");
   $query->bindParam(":CuentaCodigo", $CuentaCodigo);
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

   protected function generarCodigoAleatorio($letra, $longitud, $numero){
    for ($i=1; $i <$longitud ; $i++) {
     $numero = rand(0,9);
     $letra .= $numero;
    }
    return $letra.$numero;
   }

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

 }

?>
