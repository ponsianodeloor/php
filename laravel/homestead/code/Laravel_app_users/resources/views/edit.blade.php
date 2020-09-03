<form method="PATCH" action="UsersController@update'" v-on:submit.prevent = "updateUser(fillUser.id)">
 <div class="modal fade" id="edit">
  <div class="modal-dialog">
   <div class="modal-content">

    <div class="modal-header">
     <h4>Editar Usuario</h4>
     <button type="button" class="close" data-dismiss="modal" name="button">
      <span>&times;</span>
     </button>

    </div>
    <div class="modal-body">
     <label for="status">Status</label>
@{{fillUser.id}}
     <select class="form-control" name="status" v-model="fillUser.status">
      <option value="inactivo">inactivo</option>
      <option value="activo">Activo</option>

     </select>


     <label for="name">Nombre</label>
     <input type="text" name="name" class="form-control" v-model="fillUser.name">
     <label for="email">Email</label>
     <input type="text" name="email" class="form-control" v-model="fillUser.email">
     <span v-for="error in errors" class="text-danger">@{{ error }}</span>
    </div>
    <div class="modal-footer">
     <input type="submit" class="btn btn-primary" name="" value="Actualizar">
    </div>

   </div>
  </div>
 </div>
 <input type="hidden" name="_method" value="PATCH">
 <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
</form>
