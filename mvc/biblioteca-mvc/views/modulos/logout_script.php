<script type="text/javascript">
$(document).ready(function(){
 $('.btn-exit-system').on('click', function(e){
  e.preventDefault(); //previene el redireccionamiento
  var Token = $(this).attr('href');
  swal({
     title: 'Estas seguro de cerrar sesion?',
     text: "Saldras del sistema",
     type: 'warning',
     showCancelButton: true,
     confirmButtonColor: '#03A9F4',
     cancelButtonColor: '#F44336',
     confirmButtonText: '<i class="zmdi zmdi-run"></i> Si, Cerrar!',
     cancelButtonText: '<i class="zmdi zmdi-close-circle"></i> No, Cancelar!'
  }).then(function () {
     $.ajax({
      url:'<?php echo RUTA_URL ?>ajax/loginAjax.php?Token=' + Token,
      success:function(data){
       if (data == "true") {
        window.location.href = "<?php echo RUTA_URL ?>login/";
       }else{
        swal(
         "Ocurrio un error",
         "No se pudo cerrar la sesion",
         "error"
        );
       }
      }
     });
  });
 });
});
</script>
