<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="AsthmaControl">
	<meta name="author" content="Ibnu Raffi - ellastistunasmandiri@gmail.com">
	<title>Dashboard | AsthmaControl</title>
	<link rel="shortcut icon" href="https://blobcdn.com/blob.svg" type="image/x-icon">
	<link rel="icon" href="https://blobcdn.com/blob.svg" type="image/x-icon">
	<meta property="og:title" content="AsthmaControl">
	<meta property="og:site_name" content="AsthmaControl">
	<meta property="og:url" content="<?=$admin_base_url?>">
	<meta property="og:description" content="AsthmaControl">
	<meta property="og:type" content="website">
	<meta property="og:image" content="https://cdn.statically.io/og/AsthmaControl.png">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/icheck-bootstrap/3.0.1/icheck-bootstrap.min.css" integrity="sha512-8vq2g5nHE062j3xor4XxPeZiPjmRDh6wlufQlfC6pdQ/9urJkU07NM0tEREeymP++NczacJ/Q59ul+/K2eYvcg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
	<link href="<?=$admin_base_url?>assets/vendors/select2-bootstrap4-theme/select2-bootstrap4.min.css" rel="stylesheet" />
	<script src="https://kit.fontawesome.com/ed0a33dc86.js" crossorigin="anonymous"></script>
	<style type="text/css">
		.card-title { margin-bottom: 0!important;}
	</style>
</head>
<body class="sidebar-mini layout-navbar-fixed layout-fixed layout-footer-fixed">
	<div class="wrapper">

		<!-- Navbar -->
		<nav class="main-header navbar navbar-expand navbar-primary navbar-light text-sm">
			<!-- Left navbar links -->
			<ul class="navbar-nav">
				<li class="nav-item">
					<a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
				</li>
			</ul>
			<!-- Right navbar links -->
			<ul class="navbar-nav ml-auto">
				<li class="nav-item">
					<a class="nav-link" data-widget="fullscreen" href="#" role="button">
						<i class="fas fa-expand-arrows-alt"></i>
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?=$admin_base_url?>index.php?pages=logout" role="button">
						<i class="fas fa-sign-out-alt"></i> Keluar
					</a>
				</li>
			</ul>
		</nav>
		<!-- /.navbar -->

		<?php include("sidebar.php"); ?>