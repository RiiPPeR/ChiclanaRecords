<?php
session_start();

include './Model/User/User.php';
include './Model/User/UserDAO.php';

if (!(isset($_SESSION['user']) && $_SESSION['user']['rol'] == true)) {
	header('Location: panel.php');
}

if ($_SERVER['REQUEST_METHOD'] == "GET" && isset($_GET['id'])) {
	$id = $_GET['id'];
	$userDAO = new UserDAO();
	$user = $userDAO->getUserById($id);

	if (!$user) {
		header('Location: users.php');
		exit();
	}
}

if ($_SERVER['REQUEST_METHOD'] == "POST" && array_key_exists('btnSend', $_POST)) {
	$id = $_POST['id'];
	$name = $_POST['nombre'];
	$surname = $_POST['apellido'];
	$email = $_POST['email'];
	$password = "";
	$username = $_POST['validationDefaultUsername'];
	$rol = $_POST['rol'];

	$hashed_password = password_hash($password, PASSWORD_DEFAULT);

	$userDAO = new UserDAO();

	$user = new User($id, $name, $surname, $email, $hashed_password, $username, $rol);
	$userDAO->updateUser($user);

	header('Location: users.php');
	exit();
}

?>

<!DOCTYPE html>
<html lang="es" id="html">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Login</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
		crossorigin="anonymous"></script>
	<script type="text/javascript" src="javascript/script.js"></script>
	<link rel="stylesheet" href="css/main.css" />
</head>

<body>

	<?php include 'header.php' ?>

	<main>
		<div class="container">
			<h1 class="mt-3">Modificar datos</h1>
			<div class="card mt-3 col-12">
				<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post" id="loginForm">
					<div class="card-header">
						<div class="row">
							<h2 class="mb-0 col-auto">Modifique los datos de <?php echo $user->username ?>, id = </h2>
							<div class="col-md-1 mt-2 mt-md-0">
								<input readonly type="text" id="id" name="id" class="form-control" placeholder="id"
									value="<?php echo $user->id ?>" />
							</div>
							<div class="form-check form-switch col-auto mt-2 ms-3 ms-md-0">
								<input class="form-check-input" type="checkbox" role="switch"
									id="flexSwitchCheckDefault" <?php echo $user->rol ? 'checked' : '' ?> name="rol"
									value="1">
								<label class="form-check-label" for="flexSwitchCheckDefault">Administrador</label>
							</div>
						</div>
					</div>
					<div class="card-body pt-0 pb-0">
						<div class="row">
							<div class="input-group mt-3">
								<span class="input-group-text"><svg xmlns="http://www.w3.org/2000/svg" width="16"
										height="16" fill="currentColor" class="bi bi-1-square" viewBox="0 0 16 16">
										<path d="M9.283 4.002V12H7.971V5.338h-.065L6.072 6.656V5.385l1.899-1.383z" />
										<path
											d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm15 0a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1z" />
									</svg></span>
								<input type="text" id="nombre" name="nombre" aria-label="First name"
									class="form-control" placeholder="Nombre" value="<?php echo $user->name ?>" />
								<span class="input-group-text"><svg xmlns="http://www.w3.org/2000/svg" width="16"
										height="16" fill="currentColor" class="bi bi-2-square" viewBox="0 0 16 16">
										<path
											d="M6.646 6.24v.07H5.375v-.064c0-1.213.879-2.402 2.637-2.402 1.582 0 2.613.949 2.613 2.215 0 1.002-.6 1.667-1.287 2.43l-.096.107-1.974 2.22v.077h3.498V12H5.422v-.832l2.97-3.293c.434-.475.903-1.008.903-1.705 0-.744-.557-1.236-1.313-1.236-.843 0-1.336.615-1.336 1.306" />
										<path
											d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm15 0a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1z" />
									</svg></span>
								<input type="text" id="apellido" name="apellido" aria-label="Last name"
									class="form-control" placeholder="Apellido/s"
									value="<?php echo $user->surname ?>" />
							</div>
						</div>
						<div class="row">
							<div class="input-group mt-3">
								<span class="input-group-text" id="basic-addon1"><svg xmlns="http://www.w3.org/2000/svg"
										width="16" height="16" fill="currentColor" class="bi bi-envelope-at"
										viewBox="0 0 16 16">
										<path
											d="M2 2a2 2 0 0 0-2 2v8.01A2 2 0 0 0 2 14h5.5a.5.5 0 0 0 0-1H2a1 1 0 0 1-.966-.741l5.64-3.471L8 9.583l7-4.2V8.5a.5.5 0 0 0 1 0V4a2 2 0 0 0-2-2zm3.708 6.208L1 11.105V5.383zM1 4.217V4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v.217l-7 4.2z" />
										<path
											d="M14.247 14.269c1.01 0 1.587-.857 1.587-2.025v-.21C15.834 10.43 14.64 9 12.52 9h-.035C10.42 9 9 10.36 9 12.432v.214C9 14.82 10.438 16 12.358 16h.044c.594 0 1.018-.074 1.237-.175v-.73c-.245.11-.673.18-1.18.18h-.044c-1.334 0-2.571-.788-2.571-2.655v-.157c0-1.657 1.058-2.724 2.64-2.724h.04c1.535 0 2.484 1.05 2.484 2.326v.118c0 .975-.324 1.39-.639 1.39-.232 0-.41-.148-.41-.42v-2.19h-.906v.569h-.03c-.084-.298-.368-.63-.954-.63-.778 0-1.259.555-1.259 1.4v.528c0 .892.49 1.434 1.26 1.434.471 0 .896-.227 1.014-.643h.043c.118.42.617.648 1.12.648m-2.453-1.588v-.227c0-.546.227-.791.573-.791.297 0 .572.192.572.708v.367c0 .573-.253.744-.564.744-.354 0-.581-.215-.581-.8Z" />
									</svg></span>
								<input type="email" class="form-control" placeholder="Correo electrónico"
									aria-label="Email" aria-describedby="basic-addon1" id="email" name="email"
									value="<?php echo $user->email ?>" />
							</div>
						</div>
						<div class="row">
							<div class="col-12 mt-3">
								<div class="alert alert-danger d-none" role="alert" id="emailErrorMessage">
									El correo electrónico ha de ser válido.
								</div>
							</div>
						</div>
						<div class="row">
							<div class="input-group mb-3">
								<span class="input-group-text" id="basic-addon1"><svg xmlns="http://www.w3.org/2000/svg"
										width="16" height="16" fill="currentColor" class="bi bi-at" viewBox="0 0 16 16">
										<path
											d="M13.106 7.222c0-2.967-2.249-5.032-5.482-5.032-3.35 0-5.646 2.318-5.646 5.702 0 3.493 2.235 5.708 5.762 5.708.862 0 1.689-.123 2.304-.335v-.862c-.43.199-1.354.328-2.29.328-2.926 0-4.813-1.88-4.813-4.798 0-2.844 1.921-4.881 4.594-4.881 2.735 0 4.608 1.688 4.608 4.156 0 1.682-.554 2.769-1.416 2.769-.492 0-.772-.28-.772-.76V5.206H8.923v.834h-.11c-.266-.595-.881-.964-1.6-.964-1.4 0-2.378 1.162-2.378 2.823 0 1.737.957 2.906 2.379 2.906.8 0 1.415-.39 1.709-1.087h.11c.081.67.703 1.148 1.503 1.148 1.572 0 2.57-1.415 2.57-3.643zm-7.177.704c0-1.197.54-1.907 1.456-1.907.93 0 1.524.738 1.524 1.907S8.308 9.84 7.371 9.84c-.895 0-1.442-.725-1.442-1.914" />
									</svg></span>
								<input type="text" class="form-control" placeholder="Usuario" aria-label="Username"
									aria-describedby="basic-addon1" id="validationDefaultUsername"
									name="validationDefaultUsername" value="<?php echo $user->username ?>" />
							</div>
						</div>
						<div class="row">
							<div class="col-12">
								<div class="alert alert-danger d-none" role="alert" id="userErrorMessage">
									El usuario ha de ser válido.
								</div>
							</div>
						</div>
					</div>
					<div class="card-footer">
						<button class="btn text-white" type="submit" name="btnSend">Cambiar datos</button>
					</div>
				</form>
			</div>
		</div>
	</main>

	<?php include 'footer.php' ?>

</body>

</html>