<?php

if (!class_exists("Database")) {
    class Database {
        private static $instance = null; // la base de datos tiene la instancia nula si no se ha instanciado
        private $conn;
    
        private $servername = "localhost";
        private $username = "root";
        private $password = "";
        private $dbname = "chiclanarecords";
        private $migracionesDirectorio;
    
        public static $table_prefix = "cr_";
    
        public function __construct() {
            $this->conn = new mysqli($this->servername, $this->username, $this->password);
    
            // verificamos la conexion
            if ($this->conn->connect_error) {
                die("Conexion fallida". $this->conn->connect_error);
            }
    
            //seleccionamos la base de datos
            $this->conn->select_db($this->dbname);
    
            // aplicar las migraciones
            $this->aplicarMigraciones();
        }
    
        public function aplicarMigraciones() {
            // directorio de migraciones 
            $this->migracionesDirectorio = __DIR__ . "/migraciones";
    
            // crear la tabla de migraciones si no existe 
            $sql = "CREATE TABLE IF NOT EXISTS . " . self::$table_prefix . "migraciones (
                id INT(6) UNSIGNED AUTO_INCREMENT AUTO_INCREMENT PRIMARY KEY,
                nombres VARCHAR(200) NOT NULL
            )";
            $this->conn->query($sql);
            // Consultar la tabla de control de versiones para obtener los scripts aplicados
            $query = "SELECT nombres FROM " . self::$table_prefix ."migraciones";
            $result = $this->conn->query($query);
            // scripts aplicados
            $scriptsAplicados = [];
            while ($row = $result->fetch_assoc()) {
                $scriptsAplicados[] = $row['nombres'];
            }
            // obtener la lista de scripts de migración disponibles
            $scriptsDisponibles = array_diff(scandir($this->migracionesDirectorio), ['.', '..']); // ./ChiclanaRecords/database/migraciones
    
            $mensaje = "";
            // aplicar los scripts de migración que aún no se han ejecutado
            foreach ($scriptsDisponibles as $script) {
                if (!in_array($script, $scriptsAplicados)) {
                    // guradamos el contendio de cada script en la variable $sql
                    $sql = file_get_contents("$this->migracionesDirectorio/$script");
                    // cambiamos el prefijo por la variable prefijo
                    $sql = str_replace('<prefijo>', self::$table_prefix, $sql);
                    // hacemos una query múltiple
                    //echo $sql;
                    try {
                        $this->conn->multi_query($sql);
                        //echo $this->conn->error;
                        while($this->conn->next_result()); // <--- arregla el bug
                        // registrar el script en la tabla de control de versiones como aplicado
                        $query = "INSERT INTO " . self::$table_prefix . "migraciones (nombres) values ('$script')";
                        // hacemos la query
                        $this->conn->query($query);
    
                        $mensaje = $mensaje . "Se aplicó la migración: $script <br>";
                    } catch (mysqli_sql_exception $e) {
                        echo $e->getMessage();
                        exit();
                    }
                }
            }
            $_SESSION['mensaje'] = $mensaje;
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
}