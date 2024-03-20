<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
		  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css" />
	<link rel="stylesheet" href="<?= base_url('./assets/css/navbar.css') ?>">
	<link rel="stylesheet" href="<?= base_url('./assets/css/footer.css') ?>">
	<link rel="stylesheet" href="<?= base_url('./assets/css/user.css') ?>">
	<link rel="shortcut icon" href="<?= base_url('./assets/img/sitio-web.png') ?>" type="image/x-icon">
	<script src="<?= base_url('./assets/js/validaciones.js') ?>"></script>
	<title>Registro Entrada</title>
</head>
<body>
<?= $navbar ?>

<div class="containerG contU">
	<?php if ($msg = $this->session->flashdata('msg')): ?>
		<div class="alert alert-danger al">
			<span><?= $msg ?></span>
		</div>
	<?php endif; ?>
	<div class="btnA">
		<a href="<?= base_url('user/dashboardAdmin') ?>"><button>Atrás</button></a>
	</div>
	<div class="formU">
		<form class="cont-form " action="<?=base_url('user/create')?>" method="post">
			<div class="cont-cab"><h2>Entrada</h2></div>
			<div class="form-info">
				<div class="group-input">
					<div class="inputG">
						<label>Identificación
							<input type="text" name="iden"  placeholder="Ingrese identificación" required>
						</label>
					</div>
					<div class="inputG">
						<label>Nombre
							<input type="text" name="name" placeholder="Ingrese su nombre" required>
						</label>
					</div>
				</div>

				<div class="group-input">
					<div class="inputG">
						<label>Apellido
							<input type="text" name="lastname" placeholder="Ingrese su apellido" required>
						</label>
					</div>
					<div class="inputG">
						<label>Género
							<select name="gender">
								<option value="F">F</option>
								<option value="M">M</option>
							</select>
						</label>
					</div>
				</div>

				<div class="group-input">
					<div class="inputG">
						<label>Celular
							<input type="number" name="phone" placeholder="Ingrese su celular" required>
						</label>
					</div>
					<div class="inputG">
						<label for="RH">RH
							<select  name="rh">
								<option value="O+">O+</option>
								<option value="O-">O-</option>
								<option value="A+">A+</option>
								<option value="A-">A-</option>
								<option value="B+">B+</option>
								<option value="B-">B-</option>
								<option value="AB+">AB+</option>
								<option value="AB-">AB-</option>
							</select>
						</label>
					</div>
				</div>

				<div class="group-input">
					<div class="inputG">
						<label>Rol
							<select name="id_Role"  id="rol" onchange="mostrarMotivo()">
								<option>Seleccione uno</option>
								<option value="2">Visitante</option>
								<option value="3">Empleado</option>
							</select>
						</label>
					</div>
					<div class="inputG" id="reason" style="display: none;">
						<label>Motivo
							<input type="text" name="reason"  placeholder="Motivo de visita">
						</label>
					</div>
				</div>
				<input type="hidden" name="date_E" value="<?= $fecha_actual?>">

				<input type="hidden"  name="time_E" value="<?= $hora_actual?>">



				<div class="space-button">
					<button type="submit">Registrar</button>
				</div>
				<div class="msg">
					<span><?= isset($msg) ? $msg : '' ?></span>
					<span id="mensajeError"></span>
				</div>
			</div>
		</form>
	</div>
	<div>
		<form class="cont-form formUs" action="<?=base_url('user/searchU')?>" method="post">
			<div class="cont-cab cont2"><h2>Consultar <p>persona</p></h2></div>
			<div class="form-info">
					<div class="inputG inputU">
						<label>Identificación
							<input type="text" name="iden"  placeholder="Ingrese identificación" required>
						</label>
					</div>
				<div class="space-button">
					<button type="submit">Buscar</button>
				</div>
			</div>
		</form>
	</div>
</div>
<?= $footer ?>
</body>
</html>
