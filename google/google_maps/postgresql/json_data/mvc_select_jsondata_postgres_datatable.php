<?php
	header("Access-Control-Allow-Origin:*");
	header("Access-Control-Allow-Methods:GET, POST");
	header("Content-Type: application/json");
?>

<?php include("../core/Base.php"); ?>

<?php
$Base  = new Base();
$sentencia = $Base->query("select id, codacumu, numero_ide, propietari, lat_y, lng_x FROM geo_agua_potable_medidores");
$agua_potable_medidores = $sentencia->fetchAll(PDO::FETCH_OBJ);

foreach($agua_potable_medidores as $row_agua_potable_medidores){
	$json["data"][] = array(
			'codacumu'=>$row_agua_potable_medidores->codacumu,
			'propietari'=>$row_agua_potable_medidores->propietari,
			'numero_ide'=>$row_agua_potable_medidores->numero_ide
	);

}
echo json_encode($json);
?>
