<?php include '../../model/ManageData.php'; ?>
<?php
if ($_REQUEST['id']){
 //Obtener datos del Usuario por usuario_id
 $request_id = $_REQUEST['id'];
 $RsUsuario_id = $class_ManageData->getRows("SELECT * FROM users WHERE id = $request_id");
 foreach($RsUsuario_id as $row_RsUsuario_id){
  $id = $row_RsUsuario_id['id'];
  $user = $row_RsUsuario_id['user'];
  $user_email = $row_RsUsuario_id['user_email'];
 }
}
?>

<form enctype="multipart/form-data" name="form_actualizar_user" id="form_actualizar_user" method="post">
 <div class="row">
  <div class="col">
   <label for="txt_user">User</label>
   <input name="txt_user" type="text" class="form-control" id="txt_user" value="<?php echo $row_RsUsuario_id['user']; ?>">
  </div>
  <div class="col">
   <label for="txt_user">Email</label>
   <input name="txt_user_email" type="text" class="form-control" id="txt_user" value="<?php echo $row_RsUsuario_id['user_email']; ?>">
  </div>
  <div class="w-100"></div>
  <hr>
  <div class="col">
   <input name="hdd_id" type="hidden" id="hdd_id" value="<?php echo $row_RsUsuario_id['id']; ?>">
   <button type="button" class="btn btn-primary" onclick="procs_save_form_confirm_swal('form_actualizar_user', 'incl/controller/users/userController.php', 'form_actualizar_user' , 'Actualizar Usuario', 'Desea Actualizar el usuario', 'warning');">Guardar</button>
   <input name="hdd_data" type="hidden" id="hdd_data" value="user_edit">
  </div>
 </div>

</form>
