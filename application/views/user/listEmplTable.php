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
	<link rel="stylesheet" href="<?= base_url('./assets/css/employee.css') ?>">
	<link rel="stylesheet" href="<?= base_url('./assets/css/modal.css') ?>">
	<link rel="shortcut icon" href="<?= base_url('./assets/img/sitio-web.png') ?>" type="image/x-icon">
	<title>Empleados</title>
</head>
<body>
	<?= $navbar ?>
	<div class="botonespace">
        <button id="buttonR" class="buttonR">Importar</button>
    </div>
	<div class="Container-modal">
        <form class="formModal" action="<?= base_url('user/import') ?>" method="POST" enctype="multipart/form-data">
            <div class="closeB">+</div>
            <p class="title">Seleccionar archivo</p>

            <div class="flex">
				<label>
					<input class="input" type="file" name="file" required>
					<span>Archivo CSV/XLSX</span>                
				</label>
			</div>
            <button class="submit">Importar</button>
        </form>
        <div class="colorlibcopy-agile"></div>
    </div>
	<div class="containerT">
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
		<div class="btnD">
			<button id="exportButton">Exportar</button>
		</div>
		<div class="btnD btnIn">
				<a href="<?= base_url('user/listEmplIT')?>"><button>Empleados Inactivos</button></a>
		</div>
		<div class="btnElec">
			<button  class="btnAct"><img src="<?= base_url('./assets/img/tableIconAc.svg') ?>"></button>
			<button class="btnDesc"><a href="<?= base_url('user/listEmp') ?>"><img src="<?= base_url('./assets/img/cardIconAc.svg') ?>"></a></button>
		</div>
		
			<table class="miyazaki" id="datat">
				<h1 class="titulo">Empleados</h1>
				<thead >
					<tr>
						<th>Identificacion</th>
						<th>Nombre</th>
						<th>RH</th>
						<th>Celular</th>
						<th>Genero</th>
						<th>Rol</th>
						<th>Estado</th>
						<th id="act1" colspan="2">Acciones</th>
					</tr>
				</thead>	
				<tbody>
				<?php if ($data){ ?>
					<?php foreach ($data as $item): ?>
						<tr>
							<td><?= $item->identification?></td>
							<td><?= $item->name ?> <?= $item->lastname ?></td>
							<td><?= $item->rh?></td>
							<td><?= $item->phone?></td>
							<td><?= $item->gender?></td>
							<td><?= $item->nameR?></td>
							<td><?php if ( $item->state == "1"){?>Activo<?php } ?></td>
							<td id="act">
								<form action="<?= base_url('user/actEmpV')?>" method="post">
								<input type="hidden" name="iden" value="<?= $item->identification?>">
									<button class="button1 btnact " type="submit">Actualizar</button>
								</form>
							</td>
							<td id="act">
								<form action="<?= base_url('user/inacEm')?>" method="post">
									<input type="hidden" name="iden" value="<?= $item->identification?>">
									<input  type="hidden" name="state" value="0">
								<button class="button1 btnelm" type="submit">Inactivar</button>
								</form>
							</td>
							
						</tr>
					<?php endforeach; ?>
				<?php }else{?>
					<tr>
						<td colspan="8">Aún no hay empleados registrados en el sistema</td>
					</tr>
				<?php }?>
				</tbody>
			</table>
			
	
			
			
	</div>
	<?= $footer ?>
	<script src="<?= $script_url ?>"></script>
	<script src="<?= base_url('assets/js/cardUpdate.js') ?>"></script>
	<script src="<?= base_url('assets/js/modal.js') ?>"></script>
	<script>
		var datat=document.querySelector("#datat");
		var dataTable=new DataTable("#datat",{
			labels: {
				placeholder: "Busca por un campo...",
				noRows: "No se encontraron registros",
				perPage: "Motrar {select} registros por página",
				info: "Mostrando {start} a {end} de {rows} registros",
			}

		} ) ;
	</script>
</body>
</html>
