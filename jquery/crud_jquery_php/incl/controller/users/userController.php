<?php include '../../model/ManageData.php'; ?>
<?php
 $hdd_data = $_REQUEST['hdd_data'];

 switch ($hdd_data) {

  case 'user_edit': //editar usuario
   $hdd_id = $_REQUEST['hdd_id'];
   $txt_user = $_POST['txt_user'];
   $txt_user_email = $_POST['txt_user_email'];

   $tabla 	 = "users";
   $campos  = array(
    "user",
    "user_email"
   );
   $valores = array(
    $txt_user,
    $txt_user_email
   );

   $condicion = 'WHERE id = '.$hdd_id;
   $class_ManageData->actualizarRegistro($tabla, $campos, $valores, $condicion);
  break;

  default:
   // code...
   break;
 }
?>
