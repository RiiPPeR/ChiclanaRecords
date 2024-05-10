<?php
session_start();

include './Model/Record/Record.php';
include './Model/Record/RecordDAO.php';

$targetDir = './uploads/';

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
}

$recordDAO = new RecordDAO();
$record = null;
$id = null;

if ($_SERVER['REQUEST_METHOD'] == "GET" && isset($_GET['id'])) {
    $id = $_GET['id'];
    $record = $recordDAO->getRecordById($id);
    if (!$record || ($_SESSION['user']['id'] != $record->userId) && !($_SESSION['user']['rol'] == true)) {
        header('Location: panel.php');
    }
}

if (isset($_POST['btn-delete'])) {
    if (isset($_POST['id-input']) && is_numeric($_POST['id-input'])) {
        $id = $_POST['id-input'];
        $recordDAO->deleteRecord($id);
        if ($_SESSION['user']['rol'] == true) {
            header('Location: records.php');
        } else {
            header('Location: panel.php');
        }
        
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
                    <h2>Eliminar disco: <?= $record->name ?>, por <?= $record->author ?></h2>
                </div>
                <div class="card-body">
                    <h2>¿Estás seguro que quieres borrar el disco?</h2>
                    <p><?= $record->name ?></p>
                    <p><?= $record->author ?></p>
                    <p><?= $record->label ?></p>
                </div>
                <div class="card-footer">
                    <form method="post">
                        <input type="hidden" name="id-input" value="<?php echo $record->id ?>">
                        <button class="btn boton-rojo" type="submit" name="btn-delete">
                            Borrar disco
                        </button>
                    </form>
                </div>
            </div>
        </div>

	</main>


</body>

</html>