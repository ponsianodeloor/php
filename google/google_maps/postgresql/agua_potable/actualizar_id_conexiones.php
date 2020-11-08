<?php
include_once "../core/MainAjaxModel.php";
$mainAjaxModel = new MainAjaxModel;


$RsGeoAguaPotableMedidores = $mainAjaxModel->getRows("SELECT * FROM geo_agua_potable_medidores ORDER BY id");
foreach($RsGeoAguaPotableMedidores as $row_RsGeoAguaPotableMedidores){
 //echo $id = $row_RsGeoAguaPotableMedidores['id'];
 $id = $row_RsGeoAguaPotableMedidores['id'];
 $codigo_catastral = $row_RsGeoAguaPotableMedidores['codigo_catastral'];
 $gapm_propietario_razon_social = $row_RsGeoAguaPotableMedidores['propietario_razon_social'];
 $geo_predio_urbano_id = $row_RsGeoAguaPotableMedidores['geo_predio_urbano_id'];


 $RsGeoPrediosUrbanos = $mainAjaxModel->getRows("SELECT * FROM geo_predios_urbanos WHERE codigo_catastral = '$codigo_catastral'");
 foreach ($RsGeoPrediosUrbanos as $row_RsGeoPrediosUrbanos) {
  $gpu_id = $row_RsGeoPrediosUrbanos['id'];
  $gpu_propietario_razon_social = $row_RsGeoPrediosUrbanos['propietario_razon_social'];
  $gpu_codigo_catastral = $row_RsGeoPrediosUrbanos['codigo_catastral'];
 }
 echo $id.' '.$gpu_id.' '.$geo_predio_urbano_id.'<br>'.$codigo_catastral.'<br>'.$gpu_codigo_catastral;
 echo '<br>';
 echo $gapm_propietario_razon_social.'<br>'.$gpu_propietario_razon_social;
 echo '<br>';

 // $tabla = "geo_agua_potable_medidores";
 // $campos = array('geo_predio_urbano_id');
 // $valores = array($gpu_id);
 // $condicion = "WHERE id = $id";
 //$mainAjaxModel->actualizarRegistroUnCampo($tabla, $campos, $valores, $condicion);



}




?>
