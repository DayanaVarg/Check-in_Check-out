<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" href="<?= base_url('./assets/css/login.css') ?>">
	<link rel="shortcut icon" href="<?= base_url('./assets/img/sitio-web.png') ?>" type="image/x-icon">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<title>Iniciar Sesión</title>
</head>
<body class="body">

	<?php if ($mnsg = $this->session->flashdata('mnsg')): ?>
		<div class="alert alert-success">
			<span><?= $mnsg ?></span>
		</div>
	<?php endif; ?>
	<div class="container">
			<form class="cont-form" action="<?= base_url('login/validation') ?>" method="post">
				<div class="cont-cab"><h2>Iniciar Sesión</h2></div>
				<div class="form-info">
					<label for="iden">Identificación</label>
					<input type="text" name="iden" id="iden" placeholder="Ingrese su identificación" required>
					<label for="pass">Clave</label>
					<input type="password" name="pass" id="pass" placeholder="Ingrese su clave" required>

					<div class="space-button">
						<a href="<?= base_url('register')?>"><p>Registrarse</p></a>
						<button type="submit">Entrar</button>
					</div>
					<div class="msg">
						<span><?= isset($msg) ? $msg : '' ?></span>
					</div>
				</div>
			</form>
	</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
