<?php

try {

  $conn = new PDO("mysql:host=localhost;port=3306;dbname=prueba", "root", "");
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

  $res = $conn->query('SELECT id, nombre, apellido, email, username FROM usuarios') or die(print($conn->errorInfo()));

  $data = [];

  while ($item = $res->fetch(PDO::FETCH_OBJ)) {
    $data[] = [
      'id'=> $item->id,
      'nombre'=> $item->nombre,
      'apellido'=> $item->apellido,
      'email'=> $item->email,
      'username'=> $item->username,
    ];
  }

  echo json_encode($data);

} catch (PDOException $error) { 
  echo $error->getMessage();
  die();  
}