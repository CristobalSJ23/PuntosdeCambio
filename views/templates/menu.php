<nav id="sidebar" class="sidebar js-sidebar">
	<div class="sidebar-content js-simplebar">
		<a class="sidebar-brand" href="../home/dashboard">
			<span class="align-middle">Remediaciones</span>
		</a>

		<ul class="sidebar-nav">
			<?php
			foreach ($this->menu['nombre_menu'] as $i => $dato) {
			?>
				<li class="sidebar-header">
					<?= $dato ?>
				</li>
				<?php
				foreach ($this->menu['submenu'][$i]['nombre'] as $j => $submenu) {
				?>
					<li class="sidebar-item">
						<a class="sidebar-link" href="<?= $this->menu['submenu'][$i]['url'][$j] ?>">
							<i class="align-middle" data-feather="sliders"></i> <span class="align-middle"><?= $submenu ?></span>
						</a>
					</li>
				<?php
				}
				?>
			<?php
			}
			?>
		</ul>
	</div>
</nav>

<div class="main">
	<nav class="navbar navbar-expand navbar-light navbar-bg">
		<a class="sidebar-toggle js-sidebar-toggle">
			<i class="hamburger align-self-center"></i>
		</a>

		<div class="navbar-collapse collapse">
			<ul class="navbar-nav navbar-align">
				<li class="nav-item dropdown">
					<a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
						<i class="align-middle" data-feather="settings"></i>
					</a>
					<a class="nav-link d-sm-inline-block" href="../logout/logout" >
						<span class="text-dark">Cerrar sesion</span>
					</a>
				</li>
			</ul>
		</div>
	</nav>