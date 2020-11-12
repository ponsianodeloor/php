<?php
 if ($peticion_ajax) {
     include_once "../model/Producto.php";
 } else {
     include_once "model/Producto.php";
 }

 class ProductosController extends Producto
 {
     public function __construct()
     {
         // code...
     }
     //agrega al administrador
     public function createProductoController(){
         $lst_producto_categoria_id = MainModel::limpiarCadena($_POST['lst_producto_categoria_id']);
         $txt_nombre_producto = MainModel::limpiarCadena($_POST['txt_nombre_producto']);
         $txt_producto_descripcion = MainModel::limpiarCadena($_POST['txt_producto_descripcion']);
         $txt_producto_precio_compra = MainModel::limpiarCadena($_POST['txt_producto_precio_compra']);
         $txt_producto_precio_venta = MainModel::limpiarCadena($_POST['txt_producto_precio_venta']);
         $txt_producto_precio_al_por_mayor = MainModel::limpiarCadena($_POST['txt_producto_precio_al_por_mayor']);


         $hdd_cuenta_id = MainModel::decryption($_POST['hdd_cuenta_id']);

         if ($lst_producto_categoria_id != '-1') {
             $data = [
              'ProductoCategoriaId'=>$lst_producto_categoria_id,
              'ProductoNombre'=> $txt_nombre_producto,
              'ProductoDescripcion'=> $txt_producto_descripcion,
              'ProductoPrecioCompra'=> $txt_producto_precio_compra,
              'ProductoPrecioVenta'=>$txt_producto_precio_venta,
              'ProductoPrecioAlPorMayor' => $txt_producto_precio_al_por_mayor,
              'ProductoIdSha1Md5'=> sha1(md5(date('Y-m-d H:i:s'))),
              'ProductoUserIdRegister'=> $hdd_cuenta_id,
              'ProductoFechaHoraRegister'=>date('Y-m-d H:i:s')
             ];
             //echo var_dump($data);

             $guardarData = Producto::createProductoModel($data);

             if ($guardarData->rowCount()>=1) {
                 $alerta = [
                  "Alerta"=>"limpiar",
                  "Titulo"=>"Producto Registrado",
                  "Texto"=>"El Producto se ha registrado correctamente",
                  "Tipo"=>"success"
                 ];
             } else {
                 $alerta = [
                  "Alerta"=>"simple",
                  "Titulo"=>"Ocurrió un error " ,
                  "Texto"=>"El Producto no ha sido registrado",
                  "Tipo"=>"error"
                 ];
             }
             return MainModel::swetAlert($alerta);
         } else { //if ($lstValorProducto != '-1') {
             $alerta = [
              "Alerta"=>"simple",
              "Titulo"=>"Valor del Producto" ,
              "Texto"=>"Debe selecionar la categoria del Producto",
              "Tipo"=>"warning"
             ];
             return MainModel::swetAlert($alerta);
         }
     }

     /**
      * [obtenerProducto description devuelve un producto]
      * @param  [type int] $id [description id de la consulta]
      * @return [type consulta]     [description retorna la consulta]
      * uso en vistas
      * $datos = explode("/", $_GET['views']);
      * $ClienteSha1Md5Id = $datos[1];
      * $ClienteSha1Md5Id;
      * include_once "controller/ClientesController.php";
      * $clientesController = new ClientesController;
      * $datosCliente = $clientesController->obtenerCliente($ClienteSha1Md5Id);
      * foreach ($datosCliente as $row_datosCliente) {
      *  $ClienteNombre = $row_datosCliente['ClienteNombre'];
      *  $ClienteApellido = $row_datosCliente['ClienteApellido'];
      * }
      */
     public function obtenerProducto($id){
         $sql = "SELECT * FROM productos WHERE id = '$id'";
         $datos = MainModel::simpleQuery($sql);
         $datos = $datos->fetchAll();

         return $datos;
     }

     public function obtenerProductosController(){
         $sql = "SELECT * FROM productos ORDER BY id ASC";
         $datos = MainModel::simpleQuery($sql);
         $datos = $datos->fetchAll();

         $tabla = "";
         $tabla.='<div class="table-responsive">
             <table class="table table-hover text-center">
              <thead>
               <tr>
                <th class="text-center">Productos</th>
                <th class="text-center">NOMBRE</th>
                <th class="text-center">DESCRIPCION</th>
                <th class="text-center">PRECIO COMPRA</th>';

         $tabla.='   </tr>
              </thead>
              <tbody>';

         foreach ($datos as $row_datos) {
             //MainModel::encryption($row_datos['id'])
             $tabla .= '
            <tr>
             <td>
              <a href="'.RUTA_URL.'producto-edit/'.MainModel::encryption(MainModel::fechaHoraSystemEncryption().$row_datos['id']).'" class="btn btn-success btn-raised btn-xs">
               <i class="zmdi zmdi-refresh"></i>
              </a>
              <form action="'.RUTA_URL.'ajax/productoAjax.php" method="POST" class="FormularioAjax" data-form="delete" entype="multipart/form-data" autocomplete="off">
               <input type="hidden" name="hdd_producto_id" value="'.MainModel::encryption($row_datos['id']).'">
               <input type="hidden" name="hdd_form_type" value="'.MainModel::encryption(date('Y-m-d H:i:s').MainModel::encryption('delete')).'">
               <input type="hidden" name="hdd_form_date" value="'.date("Y-m-d H:i:s").'">
               <button type="submit" class="btn btn-danger btn-raised btn-xs">
                <i class="zmdi zmdi-delete"></i>
               </button>
               <div class="RespuestaAjax"></div>
              </form>
             </td>
             <td>'.$row_datos['nombre'].'</td>
             <td>'.$row_datos['descripcion'].'</td>
             <td>'.$row_datos['precio_compra'].'</td>';
         }

         $tabla.='  </tbody>
             </table>
             </div>';

         return $tabla;
     }

     public function updateProductoController(){
         $lst_producto_categoria_id = MainModel::limpiarCadena($_POST['lst_producto_categoria_id']);
         $txt_nombre_producto = MainModel::limpiarCadena($_POST['txt_nombre_producto']);
         $txt_producto_descripcion = MainModel::limpiarCadena($_POST['txt_producto_descripcion']);
         $txt_producto_precio_compra = MainModel::limpiarCadena($_POST['txt_producto_precio_compra']);
         $txt_producto_precio_venta = MainModel::limpiarCadena($_POST['txt_producto_precio_venta']);
         $txt_producto_precio_al_por_mayor = MainModel::limpiarCadena($_POST['txt_producto_precio_al_por_mayor']);

         $hdd_id = MainModel::decryption($_POST['hdd_id']);
         $hdd_cuenta_id = MainModel::decryption($_POST['hdd_cuenta_id']);

         if ($lst_producto_categoria_id != '-1') {
             $data = [
              'ProductoNombre'=> $txt_nombre_producto,
              'ProductoDescripcion'=> $txt_producto_descripcion,
              'ProductoPrecioCompra'=> $txt_producto_precio_compra,
              'ProductoPrecioVenta'=>$txt_producto_precio_venta,
              'ProductoPrecioAlPorMayor' => $txt_producto_precio_al_por_mayor,
              'ProductoCategoriaId'=>$lst_producto_categoria_id,
              'producto_id'=> $hdd_id
             ];

             $guardarData = Producto::updateProductoModel($data);

             if ($guardarData->rowCount()>=1) {
                 $alerta = [
                  "Alerta"=>"limpiar",
                  "Titulo"=>"Editar Producto",
                  "Texto"=>"El Producto se ha editado correctamente",
                  "Tipo"=>"success"
                 ];
             } else {
                 $alerta = [
                  "Alerta"=>"simple",
                  "Titulo"=>"Ocurrió un error " ,
                  "Texto"=>"El Producto no ha sido editado",
                  "Tipo"=>"error"
                 ];
             }
             return MainModel::swetAlert($alerta);
         } else { //if ($lstValorProducto != '-1') {
             $alerta = [
              "Alerta"=>"simple",
              "Titulo"=>"Valor del Producto" ,
              "Texto"=>"Debe selecionar la categoria del Producto",
              "Tipo"=>"warning"
             ];
             return MainModel::swetAlert($alerta);
         }
     }

     public function deleteProductoController(){
         $hdd_producto_id = MainModel::decryption($_POST['hdd_producto_id']);
         $data = [
          'producto_id'=> $hdd_producto_id
         ];

         $eliminarData = Producto::deleteProductoModel($data);
         if ($eliminarData->rowCount()>=1) {
             $alerta = [
              "Alerta"=>"limpiar",
              "Titulo"=>"Editar Producto",
              "Texto"=>"El Producto se ha editado correctamente",
              "Tipo"=>"success"
             ];
         } else {
             $alerta = [
              "Alerta"=>"simple",
              "Titulo"=>"Ocurrió un error " ,
              "Texto"=>"El Producto no ha sido editado",
              "Tipo"=>"error"
             ];
         }
         return MainModel::swetAlert($alerta);
     }
 } //class ProductosController
