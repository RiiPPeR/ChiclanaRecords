<?php
// configuracion de la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "prueba";

// conexion a la base de datos

$conn = new mysqli($servername, $username, $password, $dbname);

// verificar la conexion

if ($conn->connect_error) {
  die("Error en la conexion de la base de datos " . $conn->connect_error);
}

// recibimos los datos de los formularios

$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$email = $_POST['email'];
$password = $_POST['inputPassword6'];
$username = $_POST['validationDefaultUsername'];

// encriptamos la contraseña usamos la funcion password_hash() de PHP

$hashed_password = password_hash($password, PASSWORD_DEFAULT);

$sql = "INSERT INTO usuarios (name, surname, email, password, username) VALUES ('$nombre', '$apellido', '$email', '$hashed_password', '$username')";

// hacermos la query

if ($conn->query($sql) === TRUE) {
  echo "Registro con exitoso.";
  header ("Location: login.php");
} else {
  echo "Error al registrar el usuario: " . $conn->error;
}

$conn->close();

?>