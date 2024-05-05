<?php
class Database {
    private static $instance = null; // la base de datos tiene la instancia nula si no se ha instanciado
    private $conn;

    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "chiclanarecords";

    public static $table_prefix = "cr_";

    public function __construct() {
        $this->conn = new mysqli($this->servername, $this->username, $this->password);

        // verificamos la conexion
        if ($this->conn->connect_error) {
            die("Conexion fallida". $this->conn->connect_error);
        }

        //seleccionamos la base de datos
        $this->conn->select_db($this->dbname);
    }

    public static function getInstance() {
        // si no tenemos instancia creamos una
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->conn;
    }
}