<?php
	header("Access-Control-Allow-Origin:*");
	header("Access-Control-Allow-Methods:GET, POST");
	header("Content-Type: application/json");
?>

<?php include("../postgres/base_de_datos.php"); ?>

<?php
$sentencia = $base_de_datos->query("select id, codacumu as name, propietari, lat_y, lng_x FROM geo_agua_potable_medidores");
$agua_potable_medidores = $sentencia->fetchAll(PDO::FETCH_OBJ);

foreach($agua_potable_medidores as $row_agua_potable_medidores){
	$json[] = array(
			'name'=>$row_agua_potable_medidores->name,
			'location'=>array($row_agua_potable_medidores->lat_y, $row_agua_potable_medidores->lng_x)
	);

}
echo json_encode($json);
?>
