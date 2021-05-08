<?php

echo chr(65);
echo chr(90);
echo "<br>";

$cadena = "THE LEYEND OF ZELDA"; //colocar la frase en MAYUSCULA
$letra_encriptacion = "D"; //YAKU VERSU SLASSO V 21; PARAMETRIZAR PALABRAS W 22
$tamanio = strlen($cadena);

$encriptacion = new Encriptacion;

$letra_enriptada = $encriptacion->encriptacion_26_codificar_letra($letra_encriptacion);
$cadena_encriptada = "";

echo "$cadena tamano: ".$tamanio." letra encriptada $letra_encriptacion $letra_enriptada";
echo "<br>Desplazamiento 26<br><br>";

for($i=0; $i < strlen($cadena); $i++){
 $numero_codificado =  substr($cadena, $i, 1);

 if ($numero_codificado == " "){
   $numero_codificado = "";
   $cadena_encriptada.=" ";
   goto noPrint;
 }


 echo $numero_codificado." ";
 $obtener_digito =  $encriptacion->encriptacion_26_codificar_letra($numero_codificado);

 echo $obtener_digito;
 $residuo = ($obtener_digito + $letra_enriptada) % 26;
 echo " Residuo $residuo ";
 $letra_codificada = $encriptacion->encriptacion_26_codificar_numero($residuo);
 echo $letra_codificada;
 $cadena_encriptada.= $letra_codificada;

 noPrint:
 echo "<br>";
}

echo "<br>";

$letra_desencriptacion = "D";
echo "<br>";
echo $letra_desencriptacion;
echo "<br>";
echo $cadena_encriptada;
echo "<br>";
$cadena_decriptada = $encriptacion->decriptacion_desplazamiento($cadena_encriptada, $letra_desencriptacion);
echo $cadena_decriptada;
echo "<br>";

$cadena_encriptada = "WKH OHBHQG RI CHOGD";

echo $encriptacion->decriptacion_desplazamiento($cadena_encriptada, "A");
echo $encriptacion->decriptacion_desplazamiento($cadena_encriptada, "B");
echo $encriptacion->decriptacion_desplazamiento($cadena_encriptada, "C");
echo $encriptacion->decriptacion_desplazamiento($cadena_encriptada, "D");
echo $encriptacion->decriptacion_desplazamiento($cadena_encriptada, "E");
echo $encriptacion->decriptacion_desplazamiento($cadena_encriptada, "F");
echo $encriptacion->decriptacion_desplazamiento($cadena_encriptada, "G");
echo $encriptacion->decriptacion_desplazamiento($cadena_encriptada, "H");
echo $encriptacion->decriptacion_desplazamiento($cadena_encriptada, "I");
echo $encriptacion->decriptacion_desplazamiento($cadena_encriptada, "J");
echo $encriptacion->decriptacion_desplazamiento($cadena_encriptada, "K");
echo $encriptacion->decriptacion_desplazamiento($cadena_encriptada, "L");
echo $encriptacion->decriptacion_desplazamiento($cadena_encriptada, "M");
echo $encriptacion->decriptacion_desplazamiento($cadena_encriptada, "N");
echo $encriptacion->decriptacion_desplazamiento($cadena_encriptada, "O");
echo $encriptacion->decriptacion_desplazamiento($cadena_encriptada, "P");
echo $encriptacion->decriptacion_desplazamiento($cadena_encriptada, "Q");
echo $encriptacion->decriptacion_desplazamiento($cadena_encriptada, "R");
echo $encriptacion->decriptacion_desplazamiento($cadena_encriptada, "S");
echo $encriptacion->decriptacion_desplazamiento($cadena_encriptada, "T");
echo $encriptacion->decriptacion_desplazamiento($cadena_encriptada, "U");
echo $encriptacion->decriptacion_desplazamiento($cadena_encriptada, "V");
echo $encriptacion->decriptacion_desplazamiento($cadena_encriptada, "W");
echo $encriptacion->decriptacion_desplazamiento($cadena_encriptada, "X");
echo $encriptacion->decriptacion_desplazamiento($cadena_encriptada, "Y");
echo $encriptacion->decriptacion_desplazamiento($cadena_encriptada, "Z");



class Encriptacion{

 public function encriptacion_26_codificar_letra($letra_a_codificar){
  switch ($letra_a_codificar) {
   case 'A': return "0"; break;
   case 'B': return "1"; break;
   case 'C': return "2"; break;
   case 'D': return "3"; break;
   case 'E': return "4"; break;
   case 'F': return "5"; break;
   case 'G': return "6"; break;
   case 'H': return "7"; break;
   case 'I': return "8"; break;
   case 'J': return "9"; break;
   case 'K': return "10"; break;
   case 'L': return "11"; break;
   case 'M': return "12"; break;
   case 'N': return "13"; break;
   case 'O': return "14"; break;
   case 'P': return "15"; break;
   case 'Q': return "16"; break;
   case 'R': return "17"; break;
   case 'S': return "18"; break;
   case 'T': return "19"; break;
   case 'U': return "20"; break;
   case 'V': return "21"; break;
   case 'W': return "22"; break;
   case 'X': return "23"; break;
   case 'Y': return "24"; break;
   case 'Z': return "25"; break;

   default:
    // code...
    break;
  }
 } //public function encriptacion_26_codificar_letra

 public function encriptacion_26_codificar_numero($letra_a_codificar){

  switch ($letra_a_codificar) {
   case '0':  return "A"; break;
   case '1':  return "B"; break;
   case '2':  return "C"; break;
   case '3':  return "D"; break;
   case '4':  return "E"; break;
   case '5':  return "F"; break;
   case '6':  return "G"; break;
   case '7':  return "H"; break;
   case '8':  return "I"; break;
   case '9':  return "J"; break;
   case '10': return "K"; break;
   case '11': return "L"; break;
   case '12': return "M"; break;
   case '13': return "N"; break;
   case '14': return "O"; break;
   case '15': return "P"; break;
   case '16': return "Q"; break;
   case '17': return "R"; break;
   case '18': return "S"; break;
   case '19': return "T"; break;
   case '20': return "U"; break;
   case '21': return "V"; break;
   case '22': return "W"; break;
   case '23': return "X"; break;
   case '24': return "Y"; break;
   case '25': return "Z"; break;

   default:
    // code...
    break;
  }
 }// public function encriptacion_26_codificar_numero

 public function decriptacion_desplazamiento($cadena_encriptada, $letra){
  echo "<br>";
  echo "LETRA ENCRIPTACION ".$letra."-> ";
  $strlen_cadena_encriptada = strlen($cadena_encriptada);

  $numero = $this->encriptacion_26_codificar_letra($letra);

  //se resta el numero de la letra menos 26 si el resultado es negativo se resta 26 y se obtiene la letra
  //caso contrario se cambia la letra por el numero

  for($i=0; $i < $strlen_cadena_encriptada; $i++){
   $letra_codificada =  substr($cadena_encriptada, $i, 1);
   if ($letra_codificada == " "){
     echo " ";
     goto noPrint2;
   }
   $letra_a_numero = $this->encriptacion_26_codificar_letra($letra_codificada);
   $letra_a_numero;
   $letra_codificada;

   $restar_numero = $letra_a_numero - $numero;
   if ($restar_numero < 0) {
    $numero_decodificado = 26 + ($restar_numero);
    $letra_decodificada = $this->encriptacion_26_codificar_numero($numero_decodificado);
    echo $letra_decodificada;
   }else{
    $numero_decodificado = $restar_numero;
    $letra_decodificada = $this->encriptacion_26_codificar_numero($numero_decodificado);
    echo $letra_decodificada;
   }

   noPrint2:
  } //for $i < $strlen_cadena_encriptada


 }
}
?>
