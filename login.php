<?php
session_start();

include './Model/User/User.php';
include './Model/User/UserDAO.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$username = $_POST['username'];
	$password = $_POST['password'];

	$userDAO = new UserDAO();

	/*$conn = $userDAO->getConexion();

	$sql = "SELECT * FROM " . Database::$table_prefix . "usuarios WHERE username = '$username'";
	$result = $conn->query($sql);

	// comprobamos si hay usuario
	if ($result->num_rows > 0) {
		// guardamos el user en una fila
		$row = $result->fetch_assoc();
		// comprobamos la contraseña con el hash
		if (password_verify($password, $row["password"])) {
			$_SESSION['user'] = $row;
			header("Location: panel.php");
		} else {
			header("Location: login.php?login=password");
		}
	} else {
		header("Location: login.php?login=error");
	}*/

	$user = $userDAO->getUserByUsername($username);

	if ($user) {
		// comprobamos la contraseña con el hash
		if (password_verify($password, $user->password)) {
			$_SESSION['user'] = (array) $user;
			header("Location: panel.php");
		} else {
			header("Location: login.php?login=password");
		}
	} else {
		header("Location: login.php?login=error");
	}
}
?>


<!DOCTYPE html>
<html lang="es" id="html">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Login</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
	<script type="text/javascript" src="javascript/script.js"></script>
	<link rel="stylesheet" href="css/main.css" />
</head>

<body>

	<?php include 'header.php' ?>

	<main>
		<div class="container d-flex flex-md-row flex-column">
			<div class="container col-md-7">
				<h1 class="mt-3">Iniciar sesión</h1>
				<div class="row">
					<div class="card mt-3 p-0">
						<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
							<div class="card-header">
								<div class="row">
									<h2 class="mb-0">
										Introduce tus datos para iniciar sesión
									</h2>
								</div>
							</div>
							<div class="card-body pt-0 pb-0">
								<div class="row">
									<div class="input-group mb-3 mt-3">
										<span class="input-group-text" id="basic-addon1"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-at" viewBox="0 0 16 16">
												<path d="M13.106 7.222c0-2.967-2.249-5.032-5.482-5.032-3.35 0-5.646 2.318-5.646 5.702 0 3.493 2.235 5.708 5.762 5.708.862 0 1.689-.123 2.304-.335v-.862c-.43.199-1.354.328-2.29.328-2.926 0-4.813-1.88-4.813-4.798 0-2.844 1.921-4.881 4.594-4.881 2.735 0 4.608 1.688 4.608 4.156 0 1.682-.554 2.769-1.416 2.769-.492 0-.772-.28-.772-.76V5.206H8.923v.834h-.11c-.266-.595-.881-.964-1.6-.964-1.4 0-2.378 1.162-2.378 2.823 0 1.737.957 2.906 2.379 2.906.8 0 1.415-.39 1.709-1.087h.11c.081.67.703 1.148 1.503 1.148 1.572 0 2.57-1.415 2.57-3.643zm-7.177.704c0-1.197.54-1.907 1.456-1.907.93 0 1.524.738 1.524 1.907S8.308 9.84 7.371 9.84c-.895 0-1.442-.725-1.442-1.914" />
											</svg></span>
										<input type="text" class="form-control" placeholder="Usuario" aria-label="Username" aria-describedby="basic-addon1" id="username" name="username" required />
									</div>
								</div>
								<div class="row">
									<div class="col-12">
										<div class="alert alert-danger d-none" role="alert" id="userErrorMessage">
											El usuario ha de ser válido.
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="input-group mb-3">
											<span class="input-group-text" id="basic-addon1"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-key" viewBox="0 0 16 16">
													<path d="M0 8a4 4 0 0 1 7.465-2H14a.5.5 0 0 1 .354.146l1.5 1.5a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0L13 9.207l-.646.647a.5.5 0 0 1-.708 0L11 9.207l-.646.647a.5.5 0 0 1-.708 0L9 9.207l-.646.647A.5.5 0 0 1 8 10h-.535A4 4 0 0 1 0 8m4-3a3 3 0 1 0 2.712 4.285A.5.5 0 0 1 7.163 9h.63l.853-.854a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.793-.793-1-1h-6.63a.5.5 0 0 1-.451-.285A3 3 0 0 0 4 5" />
													<path d="M4 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0" />
												</svg></span>
											<input type="password" class="form-control" placeholder="Introduzca su contraseña" aria-label="Username" aria-describedby="basic-addon1" id="password" name="password" maxlength="20" required />
										</div>
									</div>
								</div>
								<?php if(isset($_GET['login']) && $_GET['login'] == "error"): ?>
									<div class="row">
										<div class="col-12">
											<div class="alert alert-danger" role="alert" id="userErrorMessage">
												El usuario introducido no existe.
											</div>
										</div>
									</div>
								<?php endif; ?>
								<?php if(isset($_GET['login']) && $_GET['login'] == "password"): ?>
									<div class="row">
										<div class="col-12">
											<div class="alert alert-danger" role="alert" id="userErrorMessage">
												La contraseña no es correcta.
											</div>
										</div>
									</div>
								<?php endif; ?>
							</div>
							<div class="card-footer">
								<button class="btn text-white" type="submit">
									Iniciar sesión
								</button>
								<button class="btn text-white boton-amarillo mt-2 mt-md-0" type="button">
									<a href="modificar.php">¿Has olvidado tu contraseña?</a>
								</button>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="container col-md-5 justify-content-end d-flex">
				<div class="card col-md-10 mt-5 p-0">
					<div class="card-header">
						<h2 class="mb-0">Álbum del día</h2>
					</div>
					<div class="card-body">
						<img class="img-fluid" src="images/albums/mecanodescansodominical.jpg" alt="Album del dia" />
					</div>
					<div class="card-footer">
						<div class="container">
							<div class="row">
								<h3 class="col-4">Título:</h3>
								<p class="col-8 pt-2">Descanso dominical</p>
							</div>
							<div class="row">
								<h3 class="col-4">Autor:</h3>
								<p class="col-8 pt-2">Mecano</p>
							</div>
							<div class="row">
								<h3 class="col-4">Año:</h3>
								<p class="col-8 pt-2">1988</p>
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