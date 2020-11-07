<?php
include_once "../core/MainAjaxModel.php";
$mainAjaxModel = new MainAjaxModel;


$RsGeoAguaPotableMedidores = $mainAjaxModel->getRows("SELECT * FROM geo_agua_potable_medidores");
foreach($RsGeoAguaPotableMedidores as $row_RsGeoAguaPotableMedidores){
 echo $id = $row_RsGeoAguaPotableMedidores['id'];
 echo $codigo_catastral = $row_RsGeoAguaPotableMedidores['codigo_catastral'];
 echo "<br>";
}




?>
