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
	<link rel="shortcut icon" href="<?= base_url('./assets/img/sitio-web.png') ?>" type="image/x-icon">
	<title>Inicio</title>
</head>
<body>
	<?= $navbar ?>

	<div class="containerG">
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

		<div class="space-button2">
			<a href="<?= base_url('user/registerUser') ?>"><button>Registrar Entrada</button></a>
		</div>
		<div class="space-buttonEs">
			<a href="<?= base_url('graphs/') ?>"><button>Estadísticas</button></a>
		</div>

		<?php if ($data){ ?>
			<?php foreach ($data as $item): ?>
			<div class="card">
				<div class="space1">
					<div class="title">
						<p><?= $item->name ?> <?= $item->lastname ?></p>
					</div>

					<div class="columns" >
						<div class="column1">
							<p>RH: <span><?= $item->rh ?></span></p>
							<p class="p1">Género: <span><?= $item->gender ?></span></p>
						</div>
						<div class="column2">
							<p>Celular: <span><?= $item->phone ?></span></p>
							<?php if(!$item->reason == null): ?><p class="p1">Motivo: <span>Entrevista</span></p><?php endif;?>
						</div>
					</div>


					<div class="columns">
						<div class="fec">
							<p>Entrada<img src="<?= base_url('./assets/img/login.svg') ?>"></p>
							<div class="fec-line"></div>
						</div>
						<div class="column1a">
							<span ><?= $item->date_checkin ?></span>
						</div>
						<div class="column2a">
							<span ><?= $item->time_checkin ?></span>
						</div>
					</div>
					<div class="columns">
						<div class="fec">
							<p>Salida<img src="<?= base_url('./assets/img/logout.svg') ?>"></p>
							<div class="fec-line"></div>
						</div>
						<?php if(!$item->date_checkout == null){?>
						<div class="column1a">
							<span ><?= $item->date_checkout?></span>
						</div>
						<div  class="column2a">
							<span><?= $item->time_checkout?></span>
						</div>
						<?php }else{ ?>
						<div class="column1a">
							<span>No registra salida</span>
						</div>
						<?php } ?>
					</div>
				</div>
				<div class="space2">
					<p><?= $item->nameR?></p>
					<p><?= $item->identification?></p>
					<?php if ( $item->photo == null){?>
						<?php if ( $item->gender == "F"){?>
							<img src="<?= base_url('./assets/img/mujer.png') ?>">
						<?php }else if ($item->gender == "M"){ ?>
							<img src="<?= base_url('./assets/img/avatar.png') ?>">
						<?php } ?>
					<?php }else{?>
						<img src="<?= base_url('./assets/upload/'.$item->photo) ?>">
					<?php } ?>
					<form action="<?= base_url('user/registerExit')?>" method="post">
						<input type="hidden" name="id_his" value="<?= $item->id_his?>">
						<input type="hidden" name="date_Ex" value="<?= $fecha_actual?>">
						<input type="hidden"  name="time_Ex" value="<?= $hora_actual?>">
						<button type="submit">Registrar Salida</button>
					</form>
				</div>
			</div>
			<?php endforeach; ?>
		<?php }else{?>
			<div class="card">
				<div class="title">
					<p class="column1a">No hay personas por mostrar</p>
				</div>
			</div>
		<?php }?>
	</div>
	<?= $footer ?>
</body>
</html>
