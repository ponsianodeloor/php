<form method="POST" action="UsersController@store" v-on:submit.prevent = "createUser">
 <div class="modal fade" id="create">
  <div class="modal-dialog">
   <div class="modal-content">

    <div class="modal-header">
     <h4>Nuevo Usuario</h4>
     <button type="button" class="close" data-dismiss="modal" name="button">
      <span>&times;</span>
     </button>

    </div>
    <div class="modal-body">
     <label for="status">Status</label>
     <select class="form-control" name="status" v-model="newStatus">
      <option value="inactivo">inactivo</option>
      <option value="activo">Activo</option>
     </select>
     <label for="name">Nombre</label>
     <input type="text" name="name" class="form-control" v-model="newName">
     <label for="email">Email</label>
     <input type="text" name="email" class="form-control" v-model="newEmail">
     <span v-for="error in errors" class="text-danger">@{{ error }}</span>
    </div>
    <div class="modal-footer">
     <input type="submit" class="btn btn-primary" name="" value="Guardar">
    </div>

   </div>
  </div>
 </div>
 <input type="hidden" name="_method" value="PUT">
 <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
</form>
