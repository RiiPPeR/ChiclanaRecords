<?php
session_start();

include './Model/User/User.php';
include './Model/User/UserDAO.php';

if (!(isset($_SESSION['user']) && $_SESSION['user']['rol'] == true)) {
    header('Location: panel.php');
}

$userDAO = new UserDAO();

// COMPROBAMS QUE EL ID ES NUMERICO TMBN
if($_SERVER['REQUEST_METHOD'] == "GET" && isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];
    $user = $userDAO->getUserById($id);

    if(!$user) {
        header('Location: users.php');
        exit();
    }  
}

// ACCION DEL BOTON
if (isset($_POST['btn-delete'])) {
    // si el id no es numerico va a dar error la consulta
    if (isset($_POST['id-input']) && is_numeric($_POST['id-input'])) {
        $id = $_POST['id-input'];
        $userDAO->deleteUser($id);
        header('Location: users.php');
        exit();
    } else {
        echo "ID inválida";
        exit();
    }
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
		
        <div class="container mt-5 d-md-flex justify-content-center">
            <div class="card col-md-6">
                <div class="card-header">
                    <h2>Eliminar usuario: <?= $user->username ?></h2>
                </div>
                <div class="card-body">
                    <h4>¿Estás seguro de que quieres eliminar el siguiente usuario?</h4>
                    <p>ID: <?= $user->id ?></p>
                    <p>Usuario: <?= $user->username ?></p>
                    <p>Nombre: <?= $user->name ?></p>
                    <p>Apellido: <?= $user->surname ?></p>
                </div>
                <div class="card-footer">
                    <form method="post">
                        <input readonly type="hidden" name="id-input" value="<?php echo $user->id ?>">
                        <button class="btn boton-rojo" type="submit" name="btn-delete">
                            Borrar usuario
                        </button>
                    </form>
                </div>
            </div>
        </div>

	</main>


</body>

</html>