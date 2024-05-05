<?php
include $_SERVER['DOCUMENT_ROOT'].'/pagina_login/database/database.php';

class RecordDAO {
    private $conn;

    public function __construct() {
        $db = Database::getInstance();
        $this->conn = $db->getConnection();
    }

    public function getConexion() {
        return $this->conn;
    }
}