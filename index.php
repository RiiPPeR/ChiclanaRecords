<?php
session_start();

include './Model/User/User.php';
include './Model/User/UserDAO.php';

$userDAO = new UserDAO();
$users = $userDAO->getUsers("id");

?>
<!DOCTYPE html>
<html lang="es" data-bs-theme="dark" id="html">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Index</title>
	<link rel="shortcut icon" href="./images/albums/recordcr.png" type="image/x-icon">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
		crossorigin="anonymous"></script>
	<link rel="stylesheet" href="css/main.css" />
</head>

<body>

	<?php include 'header.php' ?>

	<main>
		<div class="container mt-5">
			<div class="row">
				<div class="container col-md-8">
					<h1>Chiclana records</h1>
					<p>Bienvendios a la página principal de Chiclana records donde podrás subir tu colección de discos!
						Registrate para poder ver las colecciones de otros usuarios, además de crear tu propia
						colección.</p>
					<h2>¿Cómo subir tu colección?</h2>
					<p>Para subir tu colección simplemente tienes que <a href="register.php">crearte una cuenta</a>, así
						podrás crear tu colección de discos además de ver las colecciones de otros usuarios.</p>
					<h2>¿Qué es el label?</h2>
					<p>Para guardar tus discos, necesitarás saber cual es su «label», este es simplemente un código de
						indentificación que traen todos los dicos, normalmente lo podrás encontrar en el dorsal de la
						portada, también en una de las esquinas de la parte de atras de esta, o en el la pegatina del
						propio disco.</p>
					<div class="d-md-flex flex-row">
						<img src="https://i.discogs.com/8ey6XVpCdAVhf_4m2Oiy-Hmo-WmIP6GuOt34mGYrCZQ/rs:fit/g:sm/q:90/h:594/w:600/czM6Ly9kaXNjb2dz/LWRhdGFiYXNlLWlt/YWdlcy9SLTQ4NDk5/MDQtMTQ3Nzg0NzY4/MC03MDIzLmpwZWc.jpeg"
							alt="parte trasera portada de héroe de leyenda" height="350">
						<img src="https://i.discogs.com/9v2gKr5LxSUwu1U8cKVElSI_PRuwBDeqUaTmffMxYgA/rs:fit/g:sm/q:90/h:450/w:600/czM6Ly9kaXNjb2dz/LWRhdGFiYXNlLWlt/YWdlcy9SLTQ4NDk5/MDQtMTQ3Nzg0NzY4/MC0xOTI4LmpwZWc.jpeg"
							alt="label de héroe de leyenda" height="350" width="350">
					</div>
					<p>(Ejemplos donde se puede ver el label en la parte superior derecha de la portada trasera, o en la
						pegatina del disco justo encima de la denotacón de la cara A)</p>
					<p>A dicho identificador, habría que añadirle la empresa discográfica que ha prensado el disco, en
						este caso sería EMI, por lo que el label del disco sería EMI - 056-7482901.</p>
					<h2>Colecciones de otros usuarios</h2>
					<p>A continuación podras encontrar las colecciones de otros usuarios:</p>

				</div>
				<div class="container col-md-4">
					<div class="row">
						<h2>Nuestros discos favoritos!</h2>
						<div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
							<div class="carousel-inner">
								<div class="carousel-item active" data-bs-interval="5000">
									<img src="images/albums/duncandhuelgritodeltiempo.jfif" class="d-block w-100"
										alt="..." />
									<div class="mt-2">
										<h5>Duncan Dhu - El grito del tiempo</h5>
										<p>17 de enero de 1987</p>
									</div>
								</div>
								<div class="carousel-item" data-bs-interval="5000">
									<img src="images/albums/mecanobarcoavenus.jpg" class="d-block w-100" alt="..." />
									<div class="mt-2">
										<h5>Mecano - Barco a venus (single)</h5>
										<p>16 de mayo de 1983</p>
									</div>
								</div>
								<div class="carousel-item" data-bs-interval="5000">
									<img src="images/albums/mecanoentreelcieloyelsuelo.jpg" class="d-block w-100"
										alt="..." />
									<div class="mt-2">
										<h5>Mecano - Entre el cielo y el suelo</h5>
										<p>16 de junio de 1986</p>
									</div>
								</div>
								<div class="carousel-item" data-bs-interval="5000">
									<img src="images/albums/mecanodescansodominical.jpg" class="d-block w-100"
										alt="..." />
									<div class="mt-2">
										<h5>Mecano - Descanso dominical</h5>
										<p>24 de mayo de 1988</p>
									</div>
								</div>
								<div class="carousel-item" data-bs-interval="5000">
									<img src="images/albums/heroesdelsilenciosenderosdetraicion.jfif"
										class="d-block w-100" alt="..." />
									<div class="mt-2">
										<h5>Heroes del silencio - Senderos de traición</h5>
										<p>4 de diciembre de 1990</p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="container d-flex flex-column">

					<?php for ($i = 0, $j = 0; $i < count($users) / 3; $i++): ?>

						<div class="row">

							<div class="d-flex flex-row flex-wrap">

							<?php for ($k = 1; $k <= 3; $j++, $k++): ?>

								<?php if(isset($users[$j])): ?>

									<article class="col-md-3 col-9 me-5 ms-5 transicion" style="height: fit-content;">
										<a href="collection.php?userId=<?= $users[$j]->id ?>">
											<div class="mt-3 card d-flex flex-row justify-content-center">
												<p style="width: fit-content;" class="mt-2 mb-2">@<?= $users[$j]->username ?></p>
											</div>
										</a>
									</article>
									
								<?php endif; ?>

							<?php endfor; ?>

							</div>

						</div>

					<?php endfor; ?>

				</div>
			</div>
		</div>
	</main>

	<?php include 'footer.php' ?>

</body>

</html>