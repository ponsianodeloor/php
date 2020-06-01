<!DOCTYPE html>
<html lang="es">
<head>
	<title><?php echo COMPANY ?></title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="<?php echo RUTA_URL ?>views/css/main.css">



</head>
<body>
	<?php
	$peticion_ajax = false; //se ejecuta true cuando en al carpeta ajax ejecutamos una peticion
	include_once "controller/ViewsController.php";
	$viewsController = new ViewsController();
	$views = $viewsController->obtenerVistasController();
	?>

	<?php if ($views == "login" || $views == "404"): ?>
		<?php
		if ($views == "login") {
			//<!--====== Scripts --> // se incluye los script en la parte de arriba
			include_once "modulos/003_script.php";
			include_once "views/contenidos/login_view.php";
		}else {
			include_once "views/contenidos/404_view.php";
		}
		?>
	<?php else: ?>
		<?php
			session_start(['name'=>"SistemaBibliotecaPublica"]);
		 include_once "controller/LoginController.php";
			$loginController = new LoginController;
			if (!isset($_SESSION['usuario_token_sbp']) || !isset($_SESSION['usuario_sbp'])) {
				$loginController->forzarCerrarSesion();
			}
		?>

		<!-- SideBar -->
		<?php include_once "modulos/001_menu_izquierdo.php"; ?>
		<!-- SideBar -->

		<!-- Content page-->
		<section class="full-box dashboard-contentPage">
			<?php include_once "modulos/002_navbar_txt_busqueda.php"; ?>

		<!-- Content page -->
		<?php include_once $views; ?>

		</section>
		<!--====== Scripts -->
		<?php include_once "modulos/003_script.php"; ?>

		<!-- ===== Script para cerrar sesion -->
		<!--====== Scripts -->
		<?php include_once "modulos/logout_script.php"; ?>
	<?php endif; ?>

	<script>
	 $.material.init();
	</script>

</body>
</html>
