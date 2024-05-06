<?php
session_start();

include './Model/Record/Record.php';
include './Model/Record/RecordDAO.php';


$recordDAO = new RecordDAO();
$records = $recordDAO->getRecords();

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
					<h2 class="w-100 mb-4">Lista de discos añadidos por los usuarios</h2>
				</div>
				<a href="addRecord.php" class="col-5">
					<button data-mdb-ripple-init type="button" class="btn btn-outline-light btn-rounded">
						AÑADIR UN DISCO NUEVO
          			</button>
				</a>
			</div>
			<table class="table table-hover table-borderless align-middle">
				<thead>
					<tr>
						<th>ID</th>
						<th>NOMBRE</th>
						<th>AUTOR/S</th>
						<th>FECHA DE SALIDA</th>
						<th>DESCRIPCION</th>
                        <th>IMAGEN</th>
						<th>TAGS</th>
                        <th>RATING</th>
                        <th>USER ID</th>
                        <th>ACCIONES</th>
					</tr>
				</thead>
				<tbody id="table_data" class="table-group-divider">
					<?php foreach ($records as $record) : ?>
						<tr>
							<td><?= $record->id ?></td>
                            <td><?= $record->name ?></td>
                            <td><?= $record->author ?></td>
                            <td><?= $record->releaseDate ?></td>
                            <td><?= $record->description ?></td>
                            <td><img src="<?= $record->image ?>" height="100" width="100"></td>
                            <td><?= $record->tags ?></td>
                            <td><?= $record->rating ?></td>
                            <td><?= $record->userId ?></td>
							<td class="d-flex justify-content-evenly">
								<a class="btn btn-primary btn-azul" href="modifiyUser.php?id=<?= $record->id ?>">
									<i class="bi bi-pencil-square"></i>
								</a>
								<a class="btn btn-danger btn-rojo" href="deleteUser.php?id=<?= $record->id ?>">
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