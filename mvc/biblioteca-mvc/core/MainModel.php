<?php
 if ($peticion_ajax) {
  include_once "core/Base.php";
 }else{
  include_once "core/Base.php";
 }

 /**
  *
  */
 class MainModel extends AnotherClass{

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

   protected function generarCodigoAleatorio($letra, $longitud){
    for ($i=1; $i <$longitud ; $i++) {
     $numero = rand(0,9);
     $letra .= $numero;
    }
    return $letra.$num;
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
 }

?>
