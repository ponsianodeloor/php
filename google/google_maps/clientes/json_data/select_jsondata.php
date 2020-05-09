<?php
	header("Access-Control-Allow-Origin:*");
	header("Access-Control-Allow-Methods:GET, POST");
	header("Content-Type: application/json");
?>

<?php include("../incl/class.users.php"); ?>

<?php

//@@$_GET['baa014621ab5e4d4ce566e55c834e6a45d3947db'];

//if($_GET['ca3edf0e38127d65b8e2bc130f5c54818a879e40']){
$class_Users = new Users();
	$RsMedicamentosXRecetaId = $class_Users->getRows("SELECT name, lat, lng FROM locations");
	$json = array();
	foreach($RsMedicamentosXRecetaId as $row_RsMedicamentosXRecetaId){
		//$json []= $row_RsMedicamentosXRecetaId;
		$json[] = array(
				'name'=>$row_RsMedicamentosXRecetaId['name'],
				'location'=>array($row_RsMedicamentosXRecetaId['lat'], $row_RsMedicamentosXRecetaId['lng'])
		);

	}
	echo json_encode($json);
//}


?>
