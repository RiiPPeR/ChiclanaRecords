<?php
session_start();

include './Model/Record/Record.php';
include './Model/Record/RecordDAO.php';

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $recordDAO = new RecordDAO();

    $records = $recordDAO->getRecordsById($_GET['userId']);
}

?>
<!DOCTYPE html>
<html lang="es" data-bs-theme="dark" id="html">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script type="text/javascript" src="javascript/script.js"></script>
    <link rel="stylesheet" href="css/main.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
</head>

<body>

    <?php include 'header.php' ?>

    <main>
        <div class="container mt-3">
            <div class="row">

                <?php if(count($records) === 0): ?>
                    <h1>Este usuario aún no ha subido nada a su colección.</h1>
                <?php else: ?>
                    <h1>Colección:</h1>
                <?php endif; ?>

                <?php foreach ($records as $record) : ?>

                    <article class="card d-flex flex-md-row flex-column flex-nowrap mt-4 p-3">
                        <span class="col-md-2">
                            <img src="<?= $record->image ?>" height="150" width="150" class="ms-5">
                        </span>
                        <span class="col-md-4 ms-3 d-flex flex-column justify-content-between">
                            <h2><?= $record->name ?></h2>
                            <h3><?= $record->author ?></h3>
                            <h4><?= $record->releaseDate ?></h4>
                        </span>
                        <span class="col-md-2 d-flex flex-column justify-content-between">
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
                        </span>
                        <span class="col-md-3">
                            <p><?= $record->description ?></p>
                        </span>

                    </article>

                <?php endforeach; ?>

            </div>
        </div>
    </main>

    <?php include 'footer.php' ?>

</body>

</html>