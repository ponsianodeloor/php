<?php
/*
CRUD con PostgreSQL y PHP
@author parzibyte [parzibyte.me/blog]
@date 2019-06-17

================================
Este archivo lista todos los
datos de la tabla, obteniendo a
los mismos como un arreglo
================================
*/
?>
<?php
include_once "base_de_datos.php";
$sentencia = $base_de_datos->query("select id, codacumu, propietari, lat_y, lng_x FROM geo_agua_potable_medidores");
$agua_potable_medidores = $sentencia->fetchAll(PDO::FETCH_OBJ);
?>
<!--Recordemos que podemos intercambiar HTML y PHP como queramos-->
<?php include_once "encabezado.php" ?>
<div class="row">
<!-- Aquí pon las col-x necesarias, comienza tu contenido, etcétera -->
	<div class="col-12">
		<h1>Listar con arreglo</h1>
		<a href="//parzibyte.me/blog" target="_blank">By Parzibyte</a>
		<br>
		<div class="table-responsive">
			<table class="table table-bordered">
				<thead class="thead-dark">
					<tr>
						<th>ID</th>
						<th>Nombre</th>
						<th>Edad</th>
						<th>Editar</th>
						<th>Eliminar</th>
					</tr>
				</thead>
				<tbody>
					<!--
					Atención aquí, sólo esto cambiará
					Pd: no ignores las llaves de inicio y cierre {}
					-->
					<?php foreach($agua_potable_medidores as $row_agua_potable_medidores){ ?>
						<tr>
							<td><?php echo $row_agua_potable_medidores->id ?></td>
							<td><?php echo $row_agua_potable_medidores->codacumu ?></td>
							<td><?php echo $row_agua_potable_medidores->propietari ?></td>
							<td><a class="btn btn-warning" href="<?php echo "editar.php?id=" . $row_agua_potable_medidores->id?>">Editar 📝</a></td>
							<td><a class="btn btn-danger" href="<?php echo "eliminar.php?id=" . $row_agua_potable_medidores->id?>">Eliminar 🗑️</a></td>
						</tr>
					<?php } ?>
				</tbody>
			</table>

			<?php
			foreach($agua_potable_medidores as $row_agua_potable_medidores){
				echo $row_agua_potable_medidores->id;
				echo $row_agua_potable_medidores->codacumu;
				echo $row_agua_potable_medidores->propietari;
			}
			?>
		</div>
	</div>
</div>
<?php include_once "pie.php" ?>
