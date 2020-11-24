<?php
	header("Access-Control-Allow-Origin:*");
	header("Access-Control-Allow-Methods:GET, POST");
	header("Content-Type: application/json");
?>

<?php include("../core/Base.php"); ?>

<?php
$Base  = new Base();
$sentencia = $Base->query("select username, email FROM users");
$agua_potable_medidores = $sentencia->fetchAll(PDO::FETCH_OBJ);

foreach($agua_potable_medidores as $row_agua_potable_medidores){
	$json = array(
			'username'=>$row_agua_potable_medidores->username,
			'email'=>$row_agua_potable_medidores->email,
			// 'cedula_ruc'=>$row_agua_potable_medidores->cedula_ruc
	);

}
echo json_encode($json);
?>
