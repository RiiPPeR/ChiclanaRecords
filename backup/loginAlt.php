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

$username = $_POST['username'];
$password = $_POST['password'];

// buscamos el usuario en nuestra base de datos

$sql = "SELECT * FROM usuarios WHERE username = '$username'";

// metodo de la burbuja

$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // usuario encontrado
  $row = $result->fetch_assoc();
  // comprobamos si la password coincide con la que tenemos almacenada en nuestra base de datos
  if (password_verify($password, $row['password'])) {
    header("Location: index.php");
  } else {
    echo "Contraseña incrorecta";
  }
} else {
  // el usuario no se encuentra
  echo "Usuario no encontrado";
}

// cerramos conexion

$conn->close();

?>