<?php
session_start();

include './Model/Record/Record.php';
include './Model/Record/RecordDAO.php';

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
}

$recordDAO = new RecordDAO();

//$records = $recordDAO->getRecordsById($_SESSION['user']['id'], "id");

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    if (isset($_GET['sort'])) {
        $orderBy = $_GET["sort"];
    } else {
        $orderBy = "id";
    }

    $records = $recordDAO->getRecordsById($_SESSION['user']['id'],  $orderBy);
}

?>
<!DOCTYPE html>
<html lang="es" data-bs-theme="dark" id="html">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Panel</title>
    <link rel="shortcut icon" href="./images/albums/recordcr.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/main.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
</head>

<body>

    <?php include 'header.php' ?>

    <main>
        <div class="container mt-3">
            <div class="row">

                <h1>Bienvenido, @<?= $_SESSION['user']['username'] ?></h1>
                <p>Aquí podrás añadir nuevos discos a tu coleccion para que otros usuarios los puedan ver.</p>

                <a href="addRecord.php?userId=<?= $_SESSION['user']['id'] ?>" class="col-lg-5 col-auto">
                    <button data-mdb-ripple-init type="button" class="btn btn-rounded boton-verde">
                        AÑADIR UN DISCO NUEVO
                    </button>
                </a>


                <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="GET" class="d-flex flex-row mt-3 h-100">
                    <div class="col-3">
                        <div class="input-group mb-3">
                            <label class="input-group-text" for="inputGroupSelect01">Ordernar por:</label>
                            <select class="form-select" id="inputGroupSelect01" name="sort">
                                <option <?= $orderBy == 'id' ? 'selected' : '' ?> value="id">ID</option>
                                <option <?= $orderBy == 'name' ? 'selected' : '' ?> value="name">Nombre</option>
                                <option <?= $orderBy == 'author' ? 'selected' : '' ?> value="author">Autor</option>
                                <option <?= $orderBy == 'rating' ? 'selected' : '' ?> value="rating">Rating</option>
                            </select>
                        </div>
                    </div>
                    <button class="btn text-white boton-verde ms-3 h-75" type="submit">
                        Ordenar
                    </button>
                </form>

                <?php if (count($records) === 0) :  ?>

                    <h2>Uuuuuups! Parece que no has añadido ningún disco aún.</h2>

                    <article class="card d-flex flex-lg-row flex-column flex-nowrap mt-4 p-4 ps-5 transicion align-items-center align-items-lg-center container">
                        <div class="col-lg-2 d-flex justify-content-end">
                            <img src="./images/albums/recordcr.png" height="150" width="150" class="">
                        </div>
                        <div class="row col-lg-6">
                            <div class="col-6 col-lg-7 d-flex flex-column justify-content-between ">
                                <h2 class="ms-3">Placeholder</h2>
                                <h3 class="ms-3">Chiclana Records</h3>
                                <h4 class="ms-3">2024</h4>
                            </div>
                            <div class="col-6 col-lg-5 d-flex flex-column justify-content-evenly">
                                <h5>---</h5>
                                <span class="d-flex">
                                    <?php for ($i = 1; $i <= 5; $i++) : ?>
                                        <span class="me-3">
                                            <i class="bi bi-star-fill"></i>
                                        </span>
                                    <?php endfor; ?>
                                </span>
                                <p>---</p>
                            </div>
                        </div>
                        <div class="row col-lg-4">
                            <span class="col-lg-10">
                                <p>Chiclana Records</p>
                            </span>
                        </div>

                    </article>

                <?php endif; ?>


                <?php foreach ($records as $record) : ?>

                    <article class="card d-flex flex-lg-row flex-column flex-nowrap mt-4 p-4 ps-5 transicion align-items-center align-items-lg-center container">
                        <div class="col-lg-2 d-flex justify-content-end">
                            <img src="<?= $record->image ?>" height="150" width="150" class="">
                        </div>
                        <div class="row col-lg-6">
                            <div class="col-6 col-lg-7 d-flex flex-column justify-content-between ">
                                <h2 class="ms-3"><?= $record->name ?></h2>
                                <h3 class="ms-3"><?= $record->author ?></h3>
                                <h4 class="ms-3"><?= $record->releaseDate ?></h4>
                            </div>
                            <div class="col-6 col-lg-5 d-flex flex-column justify-content-evenly">
                                <h5><?= $record->label ?></h5>
                                <span class="d-flex">
                                    <?php for ($i = 1; $i <= $record->rating; $i++) : ?>
                                        <span class="me-3">
                                            <i class="bi bi-star-fill"></i>
                                        </span>
                                    <?php endfor; ?>
                                    <?php for ($i = 5; $i > $record->rating; $i--) : ?>
                                        <span class="me-3">
                                            <i class="bi bi-star"></i>
                                        </span>
                                    <?php endfor; ?>
                                </span>
                                <p><?= $record->tags ?></p>
                            </div>
                        </div>
                        <div class="row col-lg-4 h-75">
                            <span class="col-lg-10">
                                <p><?= $record->description ?></p>
                            </span>
                            <span class="col-lg-2 d-flex flex-lg-column flex-row justify-content-lg-around justify-content-center align-items-lg-left">
                                <a class="btn boton-azul" href="modifyRecord.php?id=<?= $record->id ?>">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <a class="btn boton-rojo" href="deleteRecord.php?id=<?= $record->id ?>">
                                    <i class="bi bi-x-square"></i>
                                </a>
                            </span>
                        </div>

                    </article>

                <?php endforeach; ?>

            </div>
        </div>
    </main>

    <?php include 'footer.php' ?>

</body>

</html>