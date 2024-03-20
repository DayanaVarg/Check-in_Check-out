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
	<script type="text/javascript" src="https://cdn.jsdelivr.net/gh/mobius1/vanilla-Datatables@latest/vanilla-dataTables.min.js"></script>
	<link rel="stylesheet" href="<?= base_url('./assets/css/navbar.css') ?>">
	<link rel="stylesheet" href="<?= base_url('./assets/css/footer.css') ?>">
	<link rel="stylesheet" href="<?= base_url('./assets/css/user.css') ?>">
	<link rel="stylesheet" href="<?= base_url('./assets/css/visitor.css') ?>">
	<link rel="shortcut icon" href="<?= base_url('./assets/img/sitio-web.png') ?>" type="image/x-icon">
	<title>Actualizar Visitante</title>
</head>
<body class="body">
	<?= $navbar ?>
	<div class="containerA">
		<?php if ($error = $this->session->flashdata('error')): ?>
			<div class="alert alert-danger al">
				<span><?= $error ?></span>
			</div>
		<?php endif; ?>

		<?php if ($msg = $this->session->flashdata('msg')): ?>
			<div class="alert alert-success al">
				<span><?= $msg ?></span>
			</div>
		<?php endif; ?>
		<div class="btnAt">
			<a href="<?= base_url('user/listVist') ?>"><button>Atrás</button></a>
		</div>
		<div class="formSpace">
			<form action="<?= base_url('user/updateUsV') ?>" method="POST" enctype="multipart/form-data">
				<?php if ($data){ ?>
					<?php foreach ($data as $item): ?>
					
					<div class="cont">
						<div class="form-info part1">
							<h1>Actualizar visitante</h1>
							<label>Identificiación
								<input type="text" name="iden" placeholder="Ingresar número de identificación"  value="<?=$item->identification ?>" readonly>
							</label>
							<div class="group-input">
								<div class="inputG">
									<label>Nombre/s
										<input type="text" name="name" placeholder="Ingresar nombre/s"  value="<?=$item->name ?>" required>
									</label>
								</div>
								<div class="inputG">
									<label>Apellido/s
										<input type="text" name="lastname" placeholder="Ingresar apellido/s"  value="<?=$item->lastname ?>" required>
									</label>
								</div>
							</div>
							
							<div class="group-input">
								<div class="inputG">
									<label>RH
										<select name="rh" required>
											<option vale="<?=$item->rh ?>"><?=$item->rh ?></option>
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
								<div class="inputG">
									<label>Género
										<select name="gender" required>
											<option value="<?= $item->gender ?>"><?= $item->gender ?></option>
											<option value="F">F</option>
											<option value="M">M</option>
										</select>
									</label>
								</div>
							</div>
								<label>Celular
									<input type="text" name="phone" placeholder="Ingresar número de celular" value="<?= $item->phone?>" required>
								</label>
						</div>

						<div class="part2">
							<div>
								<h4>Foto</h4>
								<?php if($item->photo == null){ ?>
									<?php if ( $item->gender == "F"){?>
										<img id="pho" class="photo" src="<?= base_url('./assets/img/woman.png') ?>">
									<?php }else if ($item->gender == "M"){ ?>
										<img id="pho" class="photo" src="<?= base_url('./assets/img/male.png') ?>">
									<?php } ?>
								<?php }else{ ?>
									<img id="pho" class="photo" src="<?= base_url('./assets/upload/'.$item->photo) ?>"> 
								<?php } ?>
							</div>
							<div class="act">
								<input id="btnl" type="button" value="Cargar" class="btnload" onclick="loadinput()"></input>
								<input id="btnC" type="button" value="Cancelar" class=" btnload btnCan" onclick="closeinput()"></input>
							</div>
							<div id="load" >
								<div class="btns">
									<div class="file-select" id="src-file1">
										<input type="file" name="loadP" id="imagenInput" accept="image/*">
									</div>
									<div>
										<input class="btnL" type="reset" value="Limpiar" onclick="limpiarImagen()">
									</div>
								</div>
								<div>
									<img id="imagenPrevia" src="#" alt="Vista previa de la imagen" >
								</div>
							</div>
						</div>
					</div>

					<div class="spaceBtna">
						<button class="btnA">Actualizar</button>
					</div>
					<input type="hidden" name="photo" value="<?=$item->photo ?>">
					<?php endforeach; ?>
				<?php } ?>
			</form>
		</div>
		
	</div>
	<?= $footer ?>
	<script src="<?= base_url('assets/js/cardUpdate.js') ?>"></script>
</body>
</html>
