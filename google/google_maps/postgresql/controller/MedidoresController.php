<?php
 if ($peticion_ajax) {
     include_once "../model/Medidor.php";
 } else {
     include_once "model/Medidor.php";
 }

 class MedidoresController extends Medidor
 {
     public function __construct()
     {
         // code...
     }
     //agrega al administrador
     public function createProductoController()
     {
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
     public function obtenerProducto($id)
     {
         $sql = "SELECT * FROM productos WHERE id = '$id'";
         $datos = MainModel::simpleQuery($sql);
         $datos = $datos->fetchAll();

         return $datos;
     }

     public function obtenerProductosController()
     {
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

     public function updateMedidorController()
     {
         $lst_categoria_id = MainModel::limpiarCadena($_POST['lst_categoria_id']);
         $lst_categoria_tipo_id = MainModel::limpiarCadena($_POST['lst_categoria_tipo_id']);
         $lst_bloques_de_consumo_id = MainModel::limpiarCadena($_POST['lst_bloques_de_consumo_id']);
         $lst_revisada_en_campo = MainModel::limpiarCadena($_POST['lst_revisada_en_campo']);
         $lst_es_medidor = MainModel::limpiarCadena($_POST['lst_es_medidor']);
         $lst_estado_medidor_id = MainModel::limpiarCadena($_POST['lst_estado_medidor_id']);

         $hdd_id = MainModel::decryption($_POST['hdd_id']);
         $hdd_cuenta_id = MainModel::decryption($_POST['hdd_cuenta_id']);

         if ($lst_categoria_id == "-1" || $lst_categoria_tipo_id == "-1" || $lst_bloques_de_consumo_id == "-1") {
             $alerta = [
           "Alerta"=>"simple",
           "Titulo"=>"Editar Medidor",
           "Texto"=>"Debe seleccionar el bloque de consumo",
           "Tipo"=>"warning"
          ];
             return MainModel::swetAlert($alerta);
         }

         if ($lst_bloques_de_consumo_id != '-1') {
             $data = [
              'cap_categoria_id'=> $lst_categoria_tipo_id,
              'cap_categoria_tipo_id'=> $lst_categoria_tipo_id,
              'cap_bloque_de_consumo_id'=> $lst_bloques_de_consumo_id,
              'revisada_en_campo'=> $lst_revisada_en_campo,
              'es_medidor'=> $lst_es_medidor,
              'estado_medidor_id'=>$lst_estado_medidor_id,
              'medidor_id'=> $hdd_id
             ];

             $guardarData = Medidor::updateMedidorModel($data);

             if ($guardarData->rowCount() >= 1) {
                 $alerta = [
               "Alerta"=>"limpiar",
               "Titulo"=>"Editar Medidor",
               "Texto"=>"El Medidor se ha editado correctamente",
               "Tipo"=>"success"
              ];
             } else {
                 $alerta = [
               "Alerta"=>"simple",
               "Titulo"=>"Ocurrió un error " ,
               "Texto"=>"El Medidor no ha sido editado",
               "Tipo"=>"error"
              ];
             }
             //

             echo  MainModel::swetAlert($alerta);
         } else { //if ($lst_bloques_de_consumo_id != '-1') {
             $alerta = [
               "Alerta"=>"limpiar",
               "Titulo"=>"Editar Medidor",
               "Texto"=>"El Medidor se ha editado correctamente",
               "Tipo"=>"success"
              ];
             return MainModel::swetAlert($alerta);
         }
     }

     public function deleteProductoController()
     {
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

     public function nuevaLecturaMedidorController()
     {
         $lst_medidor_id = MainModel::limpiarCadena($_POST['lst_medidor_id']);
         $txt_nuevo_consumo = MainModel::limpiarCadena($_POST['txt_nuevo_consumo']);
         //$hdd_cuenta_id = MainModel::decryption($_POST['hdd_cuenta_id']);

         if ($lst_medidor_id == "-1") {
             $alerta = [
           "Alerta"=>"simple",
           "Titulo"=>"Editar Medidor",
           "Texto"=>"Debe seleccionar la conexion del medidor",
           "Tipo"=>"warning"
          ];
             return MainModel::swetAlert($alerta);
         }
         if ($txt_nuevo_consumo == "" || $txt_nuevo_consumo == 0) {
             $alerta = [
           "Alerta"=>"simple",
           "Titulo"=>"Editar Medidor",
           "Texto"=>"Debe indicar el valor en el consumo",
           "Tipo"=>"warning"
          ];
             return MainModel::swetAlert($alerta);
         }


         if ($lst_medidor_id != '-1') {
             //obtener los datos de la ultima lectura, si esta vacio colocar 0
             $RsConsumo_x_medidor_id = MainModel::getRows("SELECT * FROM geo_agua_potable_medidores WHERE id = $lst_medidor_id");
             foreach ($RsConsumo_x_medidor_id as $row_RsConsumo_x_medidor_id) {
                 $consumo_mes_actual = $row_RsConsumo_x_medidor_id['consumo_mes_actual'];
             }

             if ($consumo_mes_actual =='') {
                 $consumo_mes_actual = 0;
             }

             if ($txt_nuevo_consumo < $consumo_mes_actual) {
              $alerta = [
               "Alerta"=>"simple",
               "Titulo"=>"Editar Medidor",
               "Texto"=>"El nuevo consumo $txt_nuevo_consumo es menor que el actual $consumo_mes_actual",
               "Tipo"=>"warning"
              ];
              return  MainModel::swetAlert($alerta);
             }else{
              $consumo = $txt_nuevo_consumo - $consumo_mes_actual;
             }

             $data = [
              'icon'=> 'punto_medido.png',
              'consumo_mes_anterior'=> $consumo_mes_actual,
              'consumo_mes_actual'=> $txt_nuevo_consumo,
              'consumo'=>$consumo,
              'fecha_ultima_medicion'=> MainModel::fechaSystem(),
              'user_id_register'=> 1,
              'medidor_id'=> $lst_medidor_id
             ];

             $guardarData = Medidor::nuevaLecturaMedidorModel($data);

             if ($guardarData->rowCount() >= 1) {
                 $alerta = [
                  "Alerta"=>"simple",
                  "Titulo"=>"Editar Medidor",
                  "Texto"=>"La lectura se ha guardado correctamente",
                  "Tipo"=>"success"
                 ];
             } else {
                 $alerta = [
               "Alerta"=>"simple",
               "Titulo"=>"Ocurrió un error " ,
               "Texto"=>"El Medidor no ha sido editado",
               "Tipo"=>"error"
              ];
             }

             return  MainModel::swetAlert($alerta);
         } else { //if ($lst_bloques_de_consumo_id != '-1') {
             $alerta = [
               "Alerta"=>"limpiar",
               "Titulo"=>"Editar Medidor",
               "Texto"=>"El Medidor se ha editado correctamente",
               "Tipo"=>"success"
              ];
             return MainModel::swetAlert($alerta);
         }
     }
 } //class ProductosController
