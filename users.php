<?php
session_start();

include './Model/User/User.php';
include './Model/User/UserDAO.php';

$userDAO = new UserDAO();

if ($_SERVER['REQUEST_METHOD'] == "GET") {
	if (isset($_GET['sort'])) {
		$orderBy = $_GET["sort"];
	} else {
		$orderBy = "id";
	}

	$users = $userDAO->getUsers($orderBy);
}

if ($_SESSION['user']['rol'] != true && isset($_SESSION['user'])) {
	echo 'No tienes permiso de estar en esta página';
	header('Location: panel.php');
} else if (!isset($_SESSION['user'])) {
	header('Location: login.php');
}

?>

<!DOCTYPE html>
<html lang="es" data-bs-theme="dark" id="html">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Lista de usuarios</title>
	<link rel="shortcut icon" href="./images/albums/recordcr.png" type="image/x-icon">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="css/main.css" />
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
</head>

<body>

	<?php include 'header.php' ?>

	<main>
		<div class="container rounded p-4 col-xl-8 col-lg-8 mt-2">
			<div class="row">
				<div class="col-7">
					<h2 class="w-100 mb-4">Lista de usuarios registrados</h2>
				</div>
				<a href="register.php" class="col-5">
					<button data-mdb-ripple-init type="button" class="btn boton-verde btn-rounded">
						AÑADIR UNA NUEVA CUENTA
          			</button>
				</a>
			</div>
			<form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="GET" class="d-flex flex-row mt-3 h-100">
				<div class="col-3">
					<div class="input-group mb-3">
						<label class="input-group-text" for="inputGroupSelect01">Ordernar por:</label>
						<select class="form-select" id="inputGroupSelect01" name="sort">
							<option <?= $orderBy == 'id' ? 'selected' : '' ?> value="id">ID</option>
							<option <?= $orderBy == 'name' ? 'selected' : '' ?> value="name">Nombre</option>
							<option <?= $orderBy == 'surname' ? 'selected' : '' ?> value="surname">Apellidos</option>
							<option <?= $orderBy == 'email' ? 'selected' : '' ?> value="email">Email</option>
							<option <?= $orderBy == 'username' ? 'selected' : '' ?> value="username">Username</option>
						</select>
					</div>
				</div>
				<button class="btn text-white boton-verde ms-3 h-75" type="submit">
					Ordenar
				</button>
			</form>
			<table class="table table-hover table-striped">
				<thead>
					<tr>
						<th scope="col">ID</th>
						<th scope="col">NOMBRE</th>
						<th scope="col">APELLIDO/S</th>
						<th scope="col">EMAIL</th>
						<th scope="col">USERNAME</th>
						<th scope="col">ACCIONES</th>
					</tr>
				</thead>
				<tbody id="table_data" class="table-group-divider">
					<?php foreach ($users as $user) : ?>
						<tr>
							<th sscope="row"><?= $user->id ?></th>
							<td><?= $user->name ?></td>
							<td><?= $user->surname ?></td>
							<td><?= $user->email ?></td>
							<td><?= $user->username ?></td>
							<td class="d-flex justify-content-evenly">
								<a class="btn btn-primary btn-azul" href="modifiyUser.php?id=<?= $user->id ?>">
									<i class="bi bi-pencil-square"></i>
								</a>
								<a class="btn btn-danger btn-rojo" href="deleteUser.php?id=<?= $user->id ?>">
									<i class="bi bi-x-square"></i>
								</a>
							</td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</main>

	<?php include 'footer.php' ?>

</body>

</html>