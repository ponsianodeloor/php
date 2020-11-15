<?php
	header("Access-Control-Allow-Origin:*");
	header("Access-Control-Allow-Methods:GET, POST");
	header("Content-Type: application/json");
?>

<?php include("../core/Base.php"); ?>

<?php
$Base  = new Base();
$sentencia = $Base->query("select nombre, precio, stock, img FROM postres");
$agua_potable_medidores = $sentencia->fetchAll(PDO::FETCH_OBJ);

foreach($agua_potable_medidores as $row_agua_potable_medidores){
	$json["postres"][] = array(
			'nombre'=>$row_agua_potable_medidores->nombre,
			'precio'=>$row_agua_potable_medidores->precio,
			'stock'=>$row_agua_potable_medidores->stock,
			'img'=>$row_agua_potable_medidores->img
	);

}
echo json_encode($json);
?>
