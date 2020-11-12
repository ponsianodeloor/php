<?php
if ($peticion_ajax) {
    include_once "../core/MainModel.php";
} else {
    include_once "core/MainModel.php";
}

class Medidor extends MainModel
{
    public function __construct()
    {
    }

    protected function createProductoModel($datos){
        $query = MainModel::conectar()->prepare("INSERT INTO productos(
                                            nombre,
                                            descripcion,
                                            precio_compra,
                                            precio_venta,
                                            precio_al_por_mayor,
                                            categoria_id,
                                            producto_id_sha1_md5,
                                            producto_user_id_register,
                                            producto_fecha_hora_register
                                           )
                                           VALUES(
                                            :ProductoNombre,
                                            :ProductoDescripcion,
                                            :ProductoPrecioCompra,
                                            :ProductoPrecioVenta,
                                            :ProductoPrecioAlPorMayor,
                                            :ProductoCategoriaId,
                                            :ProductoIdSha1Md5,
                                            :ProductoUserIdRegister,
                                            :ProductoFechaHoraRegister
                                           )
                                          ");
        $query->bindParam(":ProductoNombre", $datos['ProductoNombre']);
        $query->bindParam(":ProductoDescripcion", $datos['ProductoDescripcion']);
        $query->bindParam(":ProductoPrecioCompra", $datos['ProductoPrecioCompra']);
        $query->bindParam(":ProductoPrecioVenta", $datos['ProductoPrecioVenta']);
        $query->bindParam(":ProductoPrecioAlPorMayor", $datos['ProductoPrecioAlPorMayor']);
        $query->bindParam(":ProductoCategoriaId", $datos['ProductoCategoriaId']);
        $query->bindParam(":ProductoIdSha1Md5", $datos['ProductoIdSha1Md5']);
        $query->bindParam(":ProductoUserIdRegister", $datos['ProductoUserIdRegister']);
        $query->bindParam(":ProductoFechaHoraRegister", $datos['ProductoFechaHoraRegister']);
        $query->execute();
        return $query;
    }

    protected function readProductoModel($id){
        $query = MainModel::simpleQuery("SELECT * FROM productos WHERE id = :producto_id");
        $query->bindParam(":producto_id", $id);
        $query->execute();
        return $query;
    }

    protected function readProductoAllModel(){
        $query = MainModel::simpleQuery("SELECT * FROM productos ORDER BY nombre");
        $query->execute();
        return $query;
    }

    protected function updateMedidorModel($datos){
        $query = MainModel::conectar()->prepare("UPDATE geo_agua_potable_medidores SET
                                            cap_categoria_id = :cap_categoria_id,
                                            cap_categoria_tipo_id = :cap_categoria_tipo_id,
                                            cap_bloque_de_consumo_id = :cap_bloque_de_consumo_id,
                                            revisada_en_campo = :revisada_en_campo,
                                            es_medidor = :es_medidor,
                                            estado_medidor_id = :estado_medidor_id
                                            WHERE id = :medidor_id
                                          ");

        $query->bindParam(":cap_categoria_id", $datos['cap_categoria_id']);
        $query->bindParam(":cap_categoria_tipo_id", $datos['cap_categoria_tipo_id']);
        $query->bindParam(":cap_bloque_de_consumo_id", $datos['cap_bloque_de_consumo_id']);
        $query->bindParam(":revisada_en_campo", $datos['revisada_en_campo']);
        $query->bindParam(":es_medidor", $datos['es_medidor']);
        $query->bindParam(":estado_medidor_id", $datos['estado_medidor_id']);
        $query->bindParam(":medidor_id", $datos['medidor_id']);
        $query->execute();
        return $query;
    }

    protected function nuevaLecturaMedidorModel($datos){

     $query = MainModel::conectar()->prepare("UPDATE geo_agua_potable_medidores SET
                                         icon = :icon,
                                         consumo_mes_anterior = :consumo_mes_anterior,
                                         consumo_mes_actual = :consumo_mes_actual,
                                         consumo = :consumo,
                                         fecha_ultima_medicion = :fecha_ultima_medicion
                                         WHERE id = :medidor_id
                                       ");

     $query->bindParam(":icon", $datos['icon']);
     $query->bindParam(":consumo_mes_anterior", $datos['consumo_mes_anterior']);
     $query->bindParam(":consumo_mes_actual", $datos['consumo_mes_actual']);
     $query->bindParam(":consumo", $datos['consumo']);
     $query->bindParam(":fecha_ultima_medicion", $datos['fecha_ultima_medicion']);
     $query->bindParam(":medidor_id", $datos['medidor_id']);
     $query->execute();

     $query = MainModel::conectar()->prepare("INSERT INTO geo_agua_potable_medidores_lectura(
                                         consumo_mes_anterior,
                                         consumo_mes_actual,
                                         consumo,
                                         fecha_ultima_medicion,
                                         user_id_register,
                                         medidor_id
                                         )
                                         VALUES(
                                          :consumo_mes_anterior,
                                          :consumo_mes_actual,
                                          :consumo,
                                          :fecha_ultima_medicion,
                                          :user_id_register,
                                          :medidor_id
                                         )
                                       ");

     $query->bindParam(":consumo_mes_anterior", $datos['consumo_mes_anterior']);
     $query->bindParam(":consumo_mes_actual", $datos['consumo_mes_actual']);
     $query->bindParam(":consumo", $datos['consumo']);
     $query->bindParam(":fecha_ultima_medicion", $datos['fecha_ultima_medicion']);
     $query->bindParam(":user_id_register", $datos['user_id_register']);
     $query->bindParam(":medidor_id", $datos['medidor_id']);
     $query->execute();
     return $query;
    }

    protected function deleteProductoModel($data){
        $query = MainModel::conectar()->prepare("DELETE FROM productos WHERE id = :producto_id");
        $query->bindParam(":producto_id", $data['producto_id']);
        $query->execute();
        return $query;
    }
}
