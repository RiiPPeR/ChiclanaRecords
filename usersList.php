<?php

session_start();

if (!isset($_SESSION['user'])) {
	header('Location: login.php');
}

include './Model/User/User.php';
include './Model/User/UserDAO.php';
include './Model/Record/Record.php';
include './Model/Record/RecordDAO.php';


$userDAO = new UserDAO();
$recordsDAO = new RecordDAO();

if ($_SERVER['REQUEST_METHOD'] == "GET") {
	if (isset($_GET['sort'])) {
		$orderBy = $_GET["sort"];
	} else {
		$orderBy = "id";
	}

	$users = $userDAO->getUsers($orderBy);
}

//$users = $userDAO->getUsers();



?>

<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Lista de usuarios</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="css/main.css" />
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
</head>

<body>

	<?php include 'header.php' ?>

	<main class="container mt-3">

		<h1>Lista de usuarios registrados</h1>
		<p>En esta página podrás ver una lista de los usuarios registrados de manera mas detallada además de visitar las
			colecciones de otros usuarios registrados simplemente pulsando en su perfil</p>

		<form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="GET" class="d-flex flex-row mt-3 h-100">
			<div class="col-3">
				<div class="input-group mb-3">
					<label class="input-group-text" for="inputGroupSelect01">Ordernar por:</label>
					<select class="form-select" id="inputGroupSelect01" name="sort">
						<option <?= $orderBy == 'id' ? 'selected' : '' ?> value="id">ID</option>
						<option <?= $orderBy == 'name' ? 'selected' : '' ?> value="name">Nombre</option>
						<option <?= $orderBy == 'surname' ? 'selected' : '' ?> value="surname">Apellidos</option>
						<option <?= $orderBy == 'email' ? 'selected' : '' ?> value="email">Email</option>
						<option <?= $orderBy == 'username' ? 'selected' : '' ?> value="username">Usuario</option>
					</select>
				</div>
			</div>
			<button class="btn text-white boton-verde ms-3 h-75" type="submit">
				Ordenar
			</button>
		</form>

		<?php for ($i = 0, $j = 0; $i < count($users) / 2; $i++) : ?>

			<div class="row">

				<div class="d-flex flex-row justify-content-between flex-wrap">


					<?php for ($k = 1; $k <= 2; $j++, $k++) : ?>

						<?php if (isset($users[$j])) : ?>

							<?php $records = $recordsDAO->getRecordsById($users[$j]->id, "id"); ?>

							<div class="div col-md-6 col-12 mt-5">
								<article class="card transicion" style="width: 90%;">
									<a href="collection.php?userId=<?= $users[$j]->id ?>">
										<div class="card-header d-flex justify-content-center">@<?= $users[$j]->username ?></div>
										<div class="card-body d-flex justify-content-around">
											<?php for ($x = 0; $x < 3; $x++) : ?>
												<?php if (isset($records[$x])) : ?>
													<div class="col-4 d-flex flex-column align-items-center">
														<img src="<?= $records[$x]->image ?>" height="75" width="75">
														<p><?= $records[$x]->name ?></p>
													</div>
												<?php else : ?>
													<div class="col-4 d-flex flex-column align-items-center">
														<img src="./images/albums/recordcr.png" alt="no-album" height="75" width="75">
														<p>Chiclana Records</p>
													</div>
												<?php endif; ?>
											<?php endfor; ?>
										</div>
									</a>
								</article>
							</div>

						<?php endif; ?>

					<?php endfor; ?>

				</div>

			</div>

		<?php endfor; ?>


	</main>

	<?php include 'footer.php' ?>


</body>

</html>