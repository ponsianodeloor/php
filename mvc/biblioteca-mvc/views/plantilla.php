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
	include_once "controller/ViewsController.php";
	$viewsController = new ViewsController();
	$views = $viewsController->obtenerVistasController();
	?>

	<?php if ($views == "login"): ?>
		<?php include_once "views/contenidos/login_view.php"; ?>
	<?php else: ?>
		<!-- SideBar -->
		<?php include_once "modulos/001_menu_izquierdo.php"; ?>
		<!-- SideBar -->

		<!-- Content page-->
		<section class="full-box dashboard-contentPage">
			<?php include_once "modulos/002_navbar_txt_busqueda.php"; ?>

		<!-- Content page -->
		<?php include_once $views; ?>

		</section>
	<?php endif; ?>

	<!--====== Scripts -->
	<?php include_once "modulos/003_script.php"; ?>
</body>
</html>
