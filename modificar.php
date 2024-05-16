<?php
include './Model/User/UserDAO.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
	$email = $_POST['email'];
	$password = $_POST['password'];

	$userDAO = new UserDAO();

	$userDAO->updateUserPassword($email, $password);

    header('Location: login.php');
}

?>
<!DOCTYPE html>
<html lang="es" id="html">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <link rel="shortcut icon" href="./images/albums/recordcr.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script type="text/javascript" src="javascript/scriptModify.js"></script>
    <link rel="stylesheet" href="css/main.css" />
</head>

<body>

    <?php include 'header.php' ?>

    <main>
        <div class="container d-flex flex-md-row flex-column">
            <div class="container col-md-7">
                <h1 class="mt-3">Modificar contraseña</h1>
                <div class="row">
                    <div class="card mt-3 p-0">
                        <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post" id="loginForm">
                            <div class="card-header">
                                <div class="row">
                                    <h2 class="mb-0">Introduce tus datos para modificarlos</h2>
                                </div>
                            </div>
                            <div class="card-body pt-0 pb-0">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="input-group mb-3 mt-3">
                                            <span class="input-group-text" id="basic-addon1"><svg
                                                    xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-envelope-at" viewBox="0 0 16 16">
                                                    <path
                                                        d="M2 2a2 2 0 0 0-2 2v8.01A2 2 0 0 0 2 14h5.5a.5.5 0 0 0 0-1H2a1 1 0 0 1-.966-.741l5.64-3.471L8 9.583l7-4.2V8.5a.5.5 0 0 0 1 0V4a2 2 0 0 0-2-2zm3.708 6.208L1 11.105V5.383zM1 4.217V4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v.217l-7 4.2z" />
                                                    <path
                                                        d="M14.247 14.269c1.01 0 1.587-.857 1.587-2.025v-.21C15.834 10.43 14.64 9 12.52 9h-.035C10.42 9 9 10.36 9 12.432v.214C9 14.82 10.438 16 12.358 16h.044c.594 0 1.018-.074 1.237-.175v-.73c-.245.11-.673.18-1.18.18h-.044c-1.334 0-2.571-.788-2.571-2.655v-.157c0-1.657 1.058-2.724 2.64-2.724h.04c1.535 0 2.484 1.05 2.484 2.326v.118c0 .975-.324 1.39-.639 1.39-.232 0-.41-.148-.41-.42v-2.19h-.906v.569h-.03c-.084-.298-.368-.63-.954-.63-.778 0-1.259.555-1.259 1.4v.528c0 .892.49 1.434 1.26 1.434.471 0 .896-.227 1.014-.643h.043c.118.42.617.648 1.12.648m-2.453-1.588v-.227c0-.546.227-.791.573-.791.297 0 .572.192.572.708v.367c0 .573-.253.744-.564.744-.354 0-.581-.215-.581-.8Z" />
                                                </svg></span>
                                            <input type="email" class="form-control" placeholder="Introduzca su email"
                                                aria-label="Username" aria-describedby="basic-addon1" id="email"
                                                name="email" maxlength="40"  />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1"><svg
                                                    xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-key" viewBox="0 0 16 16">
                                                    <path
                                                        d="M0 8a4 4 0 0 1 7.465-2H14a.5.5 0 0 1 .354.146l1.5 1.5a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0L13 9.207l-.646.647a.5.5 0 0 1-.708 0L11 9.207l-.646.647a.5.5 0 0 1-.708 0L9 9.207l-.646.647A.5.5 0 0 1 8 10h-.535A4 4 0 0 1 0 8m4-3a3 3 0 1 0 2.712 4.285A.5.5 0 0 1 7.163 9h.63l.853-.854a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.793-.793-1-1h-6.63a.5.5 0 0 1-.451-.285A3 3 0 0 0 4 5" />
                                                    <path d="M4 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0" />
                                                </svg></span>
                                            <input type="password" class="form-control"
                                                placeholder="Introduzca su nueva contraseña" aria-label="Username"
                                                aria-describedby="basic-addon1" id="password" name="password"
                                                maxlength="20" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="alert alert-danger d-none" role="alert" id="passwordErrorMessage">
                                            La contraseña ha de ser válida. Debe de tener al menos mayúsculas, minúsculas, números y 8 carácteres.
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1"><svg
                                                    xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-key" viewBox="0 0 16 16">
                                                    <path
                                                        d="M0 8a4 4 0 0 1 7.465-2H14a.5.5 0 0 1 .354.146l1.5 1.5a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0L13 9.207l-.646.647a.5.5 0 0 1-.708 0L11 9.207l-.646.647a.5.5 0 0 1-.708 0L9 9.207l-.646.647A.5.5 0 0 1 8 10h-.535A4 4 0 0 1 0 8m4-3a3 3 0 1 0 2.712 4.285A.5.5 0 0 1 7.163 9h.63l.853-.854a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.793-.793-1-1h-6.63a.5.5 0 0 1-.451-.285A3 3 0 0 0 4 5" />
                                                    <path d="M4 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0" />
                                                </svg></span>
                                            <input type="password" class="form-control"
                                                placeholder="Confirme su nueva contraseña" aria-label="Username"
                                                aria-describedby="basic-addon1" id="inputPasswordRepeat" name="inputPasswordRepeat"
                                                maxlength="20" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button class="btn boton-amarillo" type="submit" name="bntSend">
                                    Cambiar datos
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
                        <img class="img-fluid" src="images/albums/heroesdelsilenciosenderosdetraicion.jfif"
                            alt="Album del dia" />
                    </div>
                    <div class="card-footer">
                        <div class="container">
                            <div class="row">
                                <h3 class="col-4">Título:</h3>
                                <p class="col-8 pt-2">Senderos de traición</p>
                            </div>
                            <div class="row">
                                <h3 class="col-4">Autor:</h3>
                                <p class="col-8 pt-2">Héroes del Silencio</p>
                            </div>
                            <div class="row">
                                <h3 class="col-4">Año:</h3>
                                <p class="col-8 pt-2">1990</p>
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