<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title>Dashboard CRUD PHP Jquery</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/fontello.css">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700|Roboto:300,400,500" rel="stylesheet">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="msg/dist/sweetalert.css">
</head>
<body>
	<div class="container-fluid">
		<div class="row">
			<div class="barra-lateral col-12 col-sm-auto position-fixed">
				<div class="logo">
					<h2>Dashboard</h2>
				</div>
				<nav class="menu d-flex d-sm-block justify-content-center flex-wrap">
					<a> <i class="icon-home"></i><span>Inicio</span></a>
					<a onclick="page_div('incl/views/users/users.php','#div_main');"><i class="icon-doc-text"></i><span>Users</span></a>
					<a href="#"><i class="icon-users"></i><span>Rols</span></a>
					<a href="#"><i class="icon-cog-alt"></i><span>Configuracion</span></a>
					<a href="#"><i class="icon-logout"></i><span>Salir</span></a>
				</nav>
			</div>
			<main class="main col">

			 <div class="row" id="busqueda">
			  <div class="col-6">
			   <input type="text" class="form-control" name="txt_busqueda" value="">
			  </div>
			  <div class="col-2">
			   <button type="button" name="button" class="btn btn-primary">Busqueda</button>
			  </div>
			 </div>

			 <div class="row mt-3" id="div_main">
