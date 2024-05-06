<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es" data-bs-theme="dark" id="html">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Index</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="css/main.css" />
</head>

<body>

	<?php include 'header.php' ?>

	<main>
		<div class="container mt-5">
			<div class="row">
				<div class="container col-md-8">
					<h1>Chiclana records</h1>
					<p>Bienvendios a la página principal de Chiclana records donde podrás subir tu colección de discos! Registrate para poder ver las colecciones de otros usuarios, además de crear tu propia colección.</p>
					<h2>Colecciones de otros usuarios:</h2>
					<p>A continuación podras encontrar las colecciones de otros usuarios:</p>
				</div>
				<div class="container col-md-4">
					<div class="row">
						<h2>Nuestros discos favoritos!</h2>
						<div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
							<div class="carousel-inner">
								<div class="carousel-item active" data-bs-interval="5000">
									<img src="images/albums/duncandhuelgritodeltiempo.jfif" class="d-block w-100" alt="..." />
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
									<img src="images/albums/mecanoentreelcieloyelsuelo.jpg" class="d-block w-100" alt="..." />
									<div class="mt-2">
										<h5>Mecano - Entre el cielo y el suelo</h5>
										<p>16 de junio de 1986</p>
									</div>
								</div>
								<div class="carousel-item" data-bs-interval="5000">
									<img src="images/albums/mecanodescansodominical.jpg" class="d-block w-100" alt="..." />
									<div class="mt-2">
										<h5>Mecano - Descanso dominical</h5>
										<p>24 de mayo de 1988</p>
									</div>
								</div>
								<div class="carousel-item" data-bs-interval="5000">
									<img src="images/albums/heroesdelsilenciosenderosdetraicion.jfif" class="d-block w-100" alt="..." />
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
		</div>
	</main>

	<?php include 'footer.php' ?>

</body>

</html>