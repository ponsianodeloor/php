<?php
	header("Access-Control-Allow-Origin:*");
	header("Access-Control-Allow-Methods:GET, POST");
	header("Content-Type: application/json");
?>

<?php include("../core/Base.php"); ?>

<?php
$Base  = new Base();
$sentencia = $Base->query("select id, codigo_catastral as name, propietario_razon_social, lat_y, lng_x FROM geo_agua_potable_medidores");
$agua_potable_medidores = $sentencia->fetchAll(PDO::FETCH_OBJ);

foreach($agua_potable_medidores as $row_agua_potable_medidores){
	$json[] = array(
			'name'=>$row_agua_potable_medidores->name,
			'location'=>array($row_agua_potable_medidores->lat_y, $row_agua_potable_medidores->lng_x)
	);

}
echo json_encode($json);
?>
