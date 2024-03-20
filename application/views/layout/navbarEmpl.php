
<header class="header">
	<div class="header__container">
		<div class="space-img">
			<img class="img" src="<?= base_url('./assets/img/sitio-web.png') ?>" alt=""/>
		</div>
	</div>
</header>


<div class="nav" id="navbar">

	<nav class="nav__container">
		<div>
			<div class="nav__list">
				<div class="nav__items">

					<a href="<?= base_url('user/dashboardAdmin') ?>"  class="nav__link">
						<i class="bx bx-home nav__icon"></i>
						<span class="nav__name">Inicio</span>
					</a>

				</div>
				<div class="nav__items">
					<div class="nav__dropdown">
						<a href="<?= base_url('login/logout')?>" class="nav__link ">
							<i class="bx bx-log-out nav__icon"></i>
							<span class="nav__name">Cerrar sesión</span>
						</a>
					</div>

				</div>
			</div>

		</div>
	</nav>
</div>
