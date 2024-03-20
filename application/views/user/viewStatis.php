<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
		  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/gh/mobius1/vanilla-Datatables@latest/vanilla-dataTables.min.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css" />
	<link rel="stylesheet" href="<?= base_url('./assets/css/navbar.css') ?>">
	<link rel="stylesheet" href="<?= base_url('./assets/css/footer.css') ?>">
	<link rel="stylesheet" href="<?= base_url('./assets/css/user.css') ?>">
	<link rel="stylesheet" href="<?= base_url('./assets/css/graphs.css') ?>">
	<link rel="shortcut icon" href="<?= base_url('./assets/img/sitio-web.png') ?>" type="image/x-icon">
	<script type="text/javascript" src="https://cdn.jsdelivr.net/gh/mobius1/vanilla-Datatables@latest/vanilla-dataTables.min.js"></script>
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	<script src="<?= base_url('./assets/js/graphs.php') ?>"></script>
	<title>Estadísticas</title>
</head>
<body>
	<?= $navbar ?>
	<?php include('./assets/js/graphs.php'); ?>

	<div class="containerG">

		<div class="space-buttonEs">
			<a href="<?= base_url('user/dashboardAdmin') ?>"><button>Atrás</button></a>
		</div>

		<div class="cardG cardE">
			<div class="div1">
				<div class="circle">
					<span><?= $emp?></span>
				</div>
				<img src="<?= base_url('./assets/img/user.svg') ?>">
			</div>
			<div class="div2">
				<span>Employeed</span>
			</div>
		</div>
		<div class="cardG cardV">
			<div class="div1 ">
				<div class="circle v">
					<span><?= $vis ?></span>
				</div>
				<img src="<?= base_url('./assets/img/visitor.svg') ?>">
			</div>
			<div class="div2 v">
				<span>Visitors</span>
			</div>
		</div>
		<div class="cardG cardT">
			<div class="div1">
				<div class="circle t">
					<span><?= $total?></span>
				</div>
				<img src="<?= base_url('./assets/img/total.svg') ?>">
			</div>
			<div class="div2 t">
				<span>Total</span>
			</div>
		</div>
		<div class="grap">
			<div id="chart_div"></div>
			<div id="fech_div"></div>
		</div>
	</div>
	
	<?= $footer ?>
</body>
</html>
