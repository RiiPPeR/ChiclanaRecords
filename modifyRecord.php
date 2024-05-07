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

if ($_SERVER['REQUEST_METHOD'] == "POST" && array_key_exists('btnSend', $_POST)) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $author = $_POST['author'];
    $releaseDate = $_POST['releaseDate'];
    $label = $_POST['label'];
    $description = $_POST['description'];
    $targetFilePath = $_POST['imageOld'];
    $tags = $_POST['tags'];
    $rating = null;

    if (isset($_POST['rating'])) {
        $serializedRating = serialize($_POST['rating']);
        $unserializeRating = unserialize($serializedRating);
        $rating = $unserializeRating[0];
    }

    if (!empty($_FILES["image"]["name"])) {
        if (!unlink($targetFilePath)) { 
            echo ("$targetFilePath no se ha podido borrar");
            exit(); 
        }  
        $filename = basename($_FILES['image']['name']);
        $targetFilePath = $targetDir . $filename;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

        // solo jpeg png y jpg
        $allowTypes = array("jpg", "png", "jpeg", "webp");
        if (in_array($fileType, $allowTypes)) {
            // subida de la foto al servido
            move_uploaded_file($_FILES['image']['tmp_name'], $targetFilePath);
        } else {
            echo "El archivo es de una extensión no permitida.";
            exit();
        }
    } 

    $recordDAO->updateRecord(new Record($id, $name, $author, $releaseDate, $label, $description, $targetFilePath, $tags, $rating, $_SESSION['user']['id']));

    header('Location: panel.php');
}

?>

<!DOCTYPE html>
<html lang="es" id="html">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Añadir disco</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/main.css" />
</head>

<body>

    <?php include 'header.php' ?>

    <main>
        <div class="container mt-3">
            <h1>Modificar disco</h1>
            <div class="card mt-3 col-12">
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post" id="loginForm"
                    enctype="multipart/form-data">
                    <div class="card-header">
                        <div class="row">
                            <h2>Modifica los datos de un disco existente</h2>
                        </div>
                    </div>
                    <div class="card-body pt-0 pb-0">
                        <div class="row mt-3">
                            <div class="col-12 col-md-6 pe-md-0">
                                <div class="input-group">
                                    <span class="input-group-text"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                                            height="16" fill="currentColor" class="bi bi-1-square" viewBox="0 0 16 16">
                                            <path
                                                d="M9.283 4.002V12H7.971V5.338h-.065L6.072 6.656V5.385l1.899-1.383z" />
                                            <path
                                                d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm15 0a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1z" />
                                        </svg></span>
                                    <input type="text" id="name" name="name" class="form-control"
                                        placeholder="Nombre del disco" value="<?= $record->name ?>" required />
                                    <input hidden readonly type="text" id="id" name="id" value="<?= $record->id ?>"/>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 ps-md-0 mt-3 mt-md-0">
                                <div class="input-group">
                                    <span class="input-group-text"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                                            height="16" fill="currentColor" class="bi bi-2-square" viewBox="0 0 16 16">
                                            <path
                                                d="M6.646 6.24v.07H5.375v-.064c0-1.213.879-2.402 2.637-2.402 1.582 0 2.613.949 2.613 2.215 0 1.002-.6 1.667-1.287 2.43l-.096.107-1.974 2.22v.077h3.498V12H5.422v-.832l2.97-3.293c.434-.475.903-1.008.903-1.705 0-.744-.557-1.236-1.313-1.236-.843 0-1.336.615-1.336 1.306" />
                                            <path
                                                d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm15 0a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1z" />
                                        </svg></span>
                                    <input type="text" id="author" name="author" class="form-control"
                                        placeholder="Autor del disco" value="<?= $record->author ?>" required />
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12 col-md-6 pe-md-0">
                                <div class="input-group">
                                    <span class="input-group-text"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                                            height="16" fill="currentColor" class="bi bi-calendar-date me-3"
                                            viewBox="0 0 16 16">
                                            <path
                                                d="M6.445 11.688V6.354h-.633A13 13 0 0 0 4.5 7.16v.695c.375-.257.969-.62 1.258-.777h.012v4.61zm1.188-1.305c.    047.    64.594 1.406 1.703 1.406 1.258 0 2-1.066 2-2.871 0-1.934-.781-2.668-1.953-2.668-.926 0-1.797.672-1. 797 1.809 0 1.   16.824 1.77 1.676 1.77.746 0 1.23-.376 1.383-.79h.027c-.004 1.316-.461 2.164-1.305 2.164-.  664 0-1.008-.45-1.05-.   82zm2.953-2.317c0 .696-.559 1.18-1.184 1.18-.601 0-1.144-.383-1.144-1.2 0-.823.582-1.    21 1.168-1.21.633 0 1.16.398  1.16 1.23" />
                                            <path
                                                d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0    1  2-2h1V.5a.5.5 0 0 1 .5-.5M1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4z" />
                                        </svg> Fecha de salida</span>
                                    <input type="date" id="releaseDate" name="releaseDate" class="form-control"
                                        placeholder="Fecha de salida" value="<?= $record->releaseDate ?>" required />
                                </div>
                            </div>
                            <div class="col-12 col-md-6 ps-md-0 mt-3 mt-md-0">
                                <div class="input-group">
                                    <span class="input-group-text"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                                            height="16" fill="currentColor" class="bi bi-vinyl" viewBox="0 0 16 16">
                                            <path
                                                d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                                            <path
                                                d="M8 6a2 2 0 1 0 0 4 2 2 0 0 0 0-4M4 8a4 4 0 1 1 8 0 4 4 0 0 1-8 0" />
                                            <path d="M9 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0" />
                                        </svg></span>
                                    <input type="text" id="label" name="label" class="form-control" placeholder="Label"
                                        value="<?= $record->label ?>" required />
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3" style="width: 100%;">
                            <textarea class="form-control ms-2" placeholder="Descripción del disco" id="description"
                                name="description" style="box-sizing: border-box; resize:none;"
                                rows="2"><?= $record->description ?></textarea>
                        </div>
                        <div class="row">
                            <div class="input-group mt-3">
                                <span class="input-group-text"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                                        height="16" fill="currentColor" class="bi bi-file-earmark-image"
                                        viewBox="0 0 16 16">
                                        <path d="M6.502 7a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3" />
                                        <path
                                            d="M14 14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h5.5L14 4.5zM4 1a1 1 0 0 0-1 1v10l2.224-2.224a.5.5 0 0 1 .61-.075L8 11l2.157-3.02a.5.5 0 0 1 .76-.063L13 10V4.5h-2A1.5 1.5 0 0 1 9.5 3V1z" />
                                    </svg></span>
                                <input type="file" id="image" name="image" class="form-control" placeholder="Nombre del disco" />
                                <input hidden readonly type="text" id="imageOld" name="imageOld" value="<?= $record->image ?>"/>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12 col-md-6 pe-md-0">
                                <div class="input-group">
                                    <span class="input-group-text"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                                            height="16" fill="currentColor" class="bi bi-tags" viewBox="0 0 16 16">
                                            <path
                                                d="M3 2v4.586l7 7L14.586 9l-7-7zM2 2a1 1 0 0 1 1-1h4.586a1 1 0 0 1 .707.293l7 7a1 1 0 0 1 0 1.414l-4.586 4.586a1 1 0 0 1-1.414 0l-7-7A1 1 0 0 1 2 6.586z" />
                                            <path
                                                d="M5.5 5a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1m0 1a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3M1 7.086a1 1 0 0 0 .293.707L8.75 15.25l-.043.043a1 1 0 0 1-1.414 0l-7-7A1 1 0 0 1 0 7.586V3a1 1 0 0 1 1-1z" />
                                        </svg></span>
                                    <input type="text" id="tags" name="tags" class="form-control" placeholder="Tags"
                                        value="<?= $record->tags ?>" required />
                                </div>
                            </div>
                            <div class="col-12 col-md-6 mt-3 mt-md-0 mb-3">
                                <div class="input-group mt-2">
                                    <p class="me-3 mb-0">Rating</p>
                                    <div class="form-check me-3">
                                        <input class="form-check-input" type="radio" name="rating"
                                            id="flexRadioDefault1" value="1" <?= $record->rating === '1' ? 'checked' : '' ?>>
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            1
                                        </label>
                                    </div>
                                    <div class="form-check me-3">
                                        <input class="form-check-input" type="radio" name="rating"
                                            id="flexRadioDefault2" value="2" <?= $record->rating === '2' ? 'checked' : '' ?>>
                                        <label class="form-check-label" for="flexRadioDefault2">
                                            2
                                        </label>
                                    </div>
                                    <div class="form-check me-3">
                                        <input class="form-check-input" type="radio" name="rating"
                                            id="flexRadioDefault3" value="3" <?= $record->rating === '3' ? 'checked' : '' ?>>
                                        <label class="form-check-label" for="flexRadioDefault3">
                                            3
                                        </label>
                                    </div>
                                    <div class="form-check me-3">
                                        <input class="form-check-input" type="radio" name="rating"
                                            id="flexRadioDefault4" value="4" <?= $record->rating === '4' ? 'checked' : '' ?>>
                                        <label class="form-check-label" for="flexRadioDefault4">
                                            4
                                        </label>
                                    </div>
                                    <div class="form-check me-3">
                                        <input class="form-check-input" type="radio" name="rating"
                                            id="flexRadioDefault5" value="5" <?= $record->rating === '5' ? 'checked' : '' ?>>
                                        <label class="form-check-label" for="flexRadioDefault5">
                                            5
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button class="btn text-white" type="submit" name="btnSend">Modificar disco</button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <?php include 'footer.php' ?>

</body>

</html>