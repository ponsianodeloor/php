<?php
	header("Access-Control-Allow-Origin:*");
	header("Access-Control-Allow-Methods:GET, POST");
	header("Content-Type: application/json");
?>

<?php include("../core/Base.php"); ?>

<?php
$Base  = new Base();
$sentencia = $Base->query("select id, codigo_catastral, cedula_ruc, propietario_razon_social, lat_y, lng_x FROM geo_agua_potable_medidores");
$agua_potable_medidores = $sentencia->fetchAll(PDO::FETCH_OBJ);

foreach($agua_potable_medidores as $row_agua_potable_medidores){
	$json["data"][] = array(
			'codigo_catastral'=>$row_agua_potable_medidores->codigo_catastral,
			'propietario_razon_social'=>$row_agua_potable_medidores->propietario_razon_social,
			'cedula_ruc'=>$row_agua_potable_medidores->cedula_ruc
	);

}
echo json_encode($json);
?>
