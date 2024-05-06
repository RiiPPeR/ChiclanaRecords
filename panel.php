<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
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
</head>

<body>

    <?php include 'header.php' ?>

    <main>
        <div class="container mt-5">
            <div class="row">

                <?php 

                    echo'<pre>';
                        var_dump($_SESSION['user']);
                    echo'</pre>';

                ?>

                <h1>Bienvenido <?= $_SESSION['user']['username'] ?></h1>

                <a href="addRecord.php?userId=<?= $_SESSION['user']['id'] ?>" class="col-5">
					<button data-mdb-ripple-init type="button" class="btn btn-outline-light btn-rounded">
						AÑADIR UN DISCO NUEVO
          			</button>
				</a>

            </div>
        </div>
    </main>

    <?php include 'footer.php' ?>

</body>

</html>