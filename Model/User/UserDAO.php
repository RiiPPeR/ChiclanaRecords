<?php 
include $_SERVER['DOCUMENT_ROOT'].'/ChiclanaRecords/database/database.php';

class UserDAO {
    private $conn;

    public function __construct() {
        $db = Database::getInstance(); // comprobamos si existe una instancia
        $this->conn = $db->getConnection(); // si ya la hay, la ponemos en la varaible $conn
    }

    public function getConexion() {
        return $this->conn;
    }

    public function insertUser(User $user) {
        $name = $user->name;
        $surname = $user->surname;
        $email = $user->email;
        $password = $user->password;
        $username = $user->username;
        $rol = $user->rol;

        // hasheamos la contrasena
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // la ID es AUTO_INCREMENT
        $sql = "INSERT INTO " . Database::$table_prefix . "usuarios (name, surname, email, password, username, rol) VALUES ('$name', '$surname', '$email', '$hashed_password', '$username', '$rol')";

        $this->conn->query($sql);
    }

    public function getUsers() : array {
        // creamos un array vacio
        $users = array();

        // hacemos la query para obetener todos los usuarios
        $sql = "SELECT * FROM " . Database::$table_prefix . "usuarios";
        $restul = $this->conn->query($sql);

        // si hay mas de 1 linea, existem al menos un usuario
        if ($restul->num_rows > 0) {
            // iteramos el array, donde guardamos cada lina en cada iteracion
            while ($row = $restul->fetch_assoc()) {
                $user = new User($row['id'], $row['name'], $row['surname'], $row['email'], $row['password'], $row['username'], $row['rol']);
                // $users[] = $user; --> $users.add($user)
                $users[] = $user;
            }
        }

        return $users;
    }

    public function getUserById($id) : User|null {
        // hacemos la query
        $sql = "SELECT * FROM ". Database::$table_prefix . "usuarios WHERE id=$id";
        $result = $this->conn->query($sql);

        // solo deberia d haber un usuario con esa id, si no hay algo mal 
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return new User($row["id"], $row["name"], $row["surname"], $row["email"], $row["password"], $row["username"], $row["rol"]);
        }

        return null;
    }

    public function getUserByUsername($username) {
        // query
        $sql = "SELECT * FROM " . Database::$table_prefix . "usuarios WHERE username='$username'";
        $result = $this->conn->query($sql);

        // comprobacion si hay usuario o no
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            // devolvemos el usuario
            return new User($row["id"], $row["name"], $row["surname"], $row["email"], $row["password"], $row["username"], $row["rol"]);
        }
    }

    public function updateUser(User $user) {
        $id = $user->id;
        $name = $user->name;
        $surname = $user->surname;
        $email = $user->email;
        $password = $user->password;
        $username = $user->username;
        $rol = $user->rol;

        $sql = "UPDATE " . Database::$table_prefix . "usuarios SET name='$name', surname='$surname', email='$email', password='$password', username='$username', rol='$rol' WHERE id=$id";

        $this->conn->query($sql);
    }

    public function updateUserNoPass(User $user) {
        $id = $user->id;
        $name = $user->name;
        $surname = $user->surname;
        $email = $user->email;
        $username = $user->username;
        $rol = $user->rol;

        $sql = "UPDATE " . Database::$table_prefix . "usuarios SET name='$name', surname='$surname', email='$email', username='$username', rol='$rol' WHERE id=$id";

        $this->conn->query($sql);
    }

    public function updateUserPassword ($email, $password) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "UPDATE " . Database::$table_prefix . "usuarios SET password='$hashed_password' WHERE email='$email'";

        ($this->conn->query($sql));
    }

    public function deleteUser($id) {
        $sql = "DELETE FROM ". Database::$table_prefix . "usuarios WHERE id=$id";
        $this->conn->query($sql);
    }
}