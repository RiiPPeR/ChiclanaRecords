<header class="sticky-top">
	<nav class="navbar navbar-expand-lg">
		<div class="container-fluid">
			<a class="navbar-brand" href="index.php">
				<h2 class="m-0">Chiclana Records</h2>
			</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarScroll">
				<ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px">
					<li class="nav-item">
						<a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : '' ?>" href="index.php">
							Página principal
						</a>
					</li>
					<?php if (!isset($_SESSION['user'])) : ?>
						<li class="nav-item">
							<a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'login.php' ? 'active' : '' ?>" href="login.php">
								Iniciar sesión
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'register.php' ? 'active' : '' ?>" href="register.php">
								Registrarse
							</a>
						</li>
					<?php endif; ?>
					<?php if (isset($_SESSION['user'])) : ?>
						<li class="nav-item">
							<a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'panel.php' ? 'active' : '' ?>" href="panel.php">
								Panel de usuario
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'usersList.php' ? 'active' : '' ?>" href="usersList.php">
								Lista de colecciones
							</a>
						</li>
					<?php endif; ?>
					<?php if (isset($_SESSION['user']) && $_SESSION['user']['rol'] == true) : ?>
						<li>
							<div class="dropdown">
								<button class="btn boton-rojo dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
									Opciones de administrador
								</button>
								<ul class="dropdown-menu boton-rojo">
									<li class="dropdown-item">
										<a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'users.php' ? 'active' : '' ?>" href="users.php">
											Administración de usuarios
										</a>
									</li>
									<li class="dropdown-item">
										<a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'records.php' ? 'active' : '' ?>" href="records.php">
											Administración de discos
										</a>
									</li>
								</ul>
							</div>
						</li>
					<?php endif; ?>
				</ul>
			</div>
			<div class="d-flex flex-row">
				<?php
				if (array_key_exists('buttonClose', $_POST)) {
					session_destroy();
					header('Location: login.php');
					exit();
				}
				?>
				<?php if (isset($_SESSION['user'])) : ?>
					<p class="m-0 mt-2 me-3">
						<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="green" class="bi bi-circle-fill me-2" viewBox="0 0 	16 16">
							<circle cx="8" cy="8" r="8" />
						</svg>
						<?= $_SESSION['user']['username'] ?>
					</p>
					<a href="modifiyUser.php?id=<?= $_SESSION['user']['id'] ?>">
						<button type="submit" class="btn btn-rounded boton-azul me-3" name="buttonClose">
							Modificar datos
						</button>
					</a>
					<form method="post">
						<button type="submit" class="btn btn-rounded boton-rojo" name="buttonClose">
							Cerrar sesión
						</button>
					</form>
					<!-- TODO: modificar perfil -->
				<?php else : ?>
					<p class="m-0  me-3">
						<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="red" class="bi bi-circle-fill me-2" viewBox="0 0 	16 16">
							<circle cx="8" cy="8" r="8" />
						</svg>
						Inicia sesión para estar conectado
					</p>
				<?php endif; ?>
			</div>
		</div>
	</nav>
</header>