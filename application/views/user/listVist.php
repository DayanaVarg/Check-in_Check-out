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
	<title>Visitantes</title>
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
		<div class="btnElec">
			<button class="btnDesc"><a href="<?= base_url('user/listVistT') ?>"><img src="<?= base_url('./assets/img/tableIcon.svg') ?>"></a></button>
			<button class="btnAct"><img src="<?= base_url('./assets/img/cardIcon.svg') ?>"></button>
		</div>
		<div class="btnInac">
			<a href="<?= base_url('user/visInac') ?>"><button class="btnI">Visitantes Inactivos</button></a>
		</div>
		<div class="space-search">
			<form class="formS" action="<?= base_url('user/searchVistId') ?>" method="post"><input type="text" name="iden" placeholder="Buscar por identificación"><button><i class="bx bx-search nav__icon"></i></button></form>
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
							<p class="p1">Estado: 
								<?php if ( $item->state == "1"){?>
								<span>Activo</span>
								<?php } ?>
							</p>
						</div>
					</div>


					<div class="columns">
					<div class="fec">
							<p>Acciones<img src="<?= base_url('./assets/img/setting-2.svg') ?>"></p>
							<div class="fec-line"></div>
						</div>
						<div class="column1a">
							<form action="<?= base_url('user/actvisV')?>" method="post">
								<input type="hidden" name="iden" value="<?= $item->identification?>">
									<button class="btns btnact " type="submit">Actualizar</button>
							</form>
						</div>
						<div class="column2a">
						<form action="<?= base_url('user/inacVis')?>" method="post">
							<input type="hidden" name="iden" value="<?= $item->identification?>">
							<input  type="hidden" name="state" value="0">
							<button class=" btns btnel"type="submit">Inactivar</button>
						</form>
						</div>
					</div>
					<div class="columns">
				
						
					</div>
				</div>
				<div class="space2">
					<p class="iden"><?= $item->identification?></p>
					<?php if ( $item->photo == null){?>
						<?php if ( $item->gender == "F"){?>
							<img src="<?= base_url('./assets/img/mujer.png') ?>">
						<?php }else if ($item->gender == "M"){ ?>
							<img src="<?= base_url('./assets/img/avatar.png') ?>">
						<?php } ?>
					<?php }else{?>
						<img src="<?= base_url('./assets/upload/'.$item->photo) ?>">
					<?php } ?>
					<p class="rol"><?= $item->nameR?></p>
					
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
