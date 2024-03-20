<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="<?= base_url('./assets/css/user.css') ?>">
	<link rel="shortcut icon" href="<?= base_url('./assets/img/sitio-web.png') ?>" type="image/x-icon">
	<title>Registrarse</title>
</head>
<body>
<div class="container">
	<form class="cont-form" action="<?= base_url('register/create') ?>" method="post" onsubmit="return comprobarCodigo()">
		<div class="cont-cab"><h2>Registrarse</h2></div>
		<div class="form-info">
			<div class="group-input">
				<div class="inputG">
					<label for="iden">Identificación</label>
					<input type="text" name="iden" id="iden" placeholder="Ingrese identificación" required>
				</div>
				<div class="inputG">
					<label for="name">Nombre</label>
					<input type="text" name="name" id="name" placeholder="Ingrese su nombre" required>
				</div>
			</div>

			<div class="group-input">
				<div class="inputG">
					<label for="lastname">Apellido</label>
					<input type="text" name="lastname" id="lastname" placeholder="Ingrese su apellido" required>
				</div>
				<div class="inputG">
					<label for="gender">Género</label>
					<select name="gender" id="gender" required>
						<option >Selecione uno</option>
						<option value="F">F</option>
						<option value="M">M</option>
					</select>
				</div>
			</div>

			<div class="group-input">
				<div class="inputG">
					<label for="phone">Celular</label>
					<input type="text" name="phone" id="phone" placeholder="Ingrese su celular" required>
				</div>
				<div class="inputG">
					<label for="RH">RH</label>
					<input type="text" name="RH" id="RH" placeholder="Ingrese su RH" required>
				</div>
			</div>

			<div class="group-input">
				<div class="inputG">
					<label for="password">Clave</label>
					<input type="password" name="password" id="password" placeholder="Ingrese una contraseña" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Debe contener al menos, una mayúscula, minúscula y números. Mínino 8 caracteres" required>
				</div>
				<div class="inputG">
					<label for="cod">Código Acceso</label>
					<input type="text" id="cod" placeholder="Ingrese el código de acceso" required>
				</div>
			</div>

			<input type="hidden" name="id_role" value="1">


			<div class="space-button">
				<a href="<?= base_url('login')?>"><p>Ya tengo un cuenta</p></a>
				<button type="submit">Registrar</button>
			</div>
			<div class="msg">
				<span><?= isset($msg) ? $msg : '' ?></span>
				<span id="mensajeError"></span>
			</div>
		</div>
	</form>
</div>
<script src="<?= base_url('./assets/js/validaciones.js') ?>"></script>
</body>
</html>
