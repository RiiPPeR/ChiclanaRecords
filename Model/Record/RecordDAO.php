<?php
include $_SERVER['DOCUMENT_ROOT'].'/ChiclanaRecords/database/database.php';

class RecordDAO {
    private $conn;

    public function __construct() {
        $db = Database::getInstance();
        $this->conn = $db->getConnection();
    }

    public function getConexion() {
        return $this->conn;
    }

    public function insertRecord(Record $record) {
        $name = $record->name;
        $author = $record->author;
        $releaseDate = $record->releaseDate;
        $label = $record->label;
        $description = $record->description;
        $image = $record->image;
        $tags = $record->tags;
        $rating = $record->rating;
        $userId = $record->userId;

        $sql = "INSERT INTO " . Database::$table_prefix . "records (name, author, releaseDate, label, description, image, tags, rating, userId) VALUES ('$name', '$author', '$releaseDate', '$label', '$description', '$image', '$tags', '$rating', '$userId')";

        $this->conn->query($sql);
    }

    public function getRecords() {
        $records = array();

        $sql = "SELECT * FROM " . Database::$table_prefix . "records";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $record = new Record($row['id'], $row['name'], $row['author'], $row['releaseDate'], $row['label'], $row['description'], $row['image'], $row['tags'], $row['rating'], $row['userId']);

                $records[] = $record;
            }
        }

        return $records;
    }

    public function getRecordsById($id) {
        $records = array();

        $sql = "SELECT * FROM " . Database::$table_prefix . "records WHERE userId='$id'";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $record = new Record($row['id'], $row['name'], $row['author'], $row['releaseDate'], $row['label'], $row['description'], $row['image'], $row['tags'], $row['rating'], $row['userId']);

                $records[] = $record;
            }
        }

        return $records;
    }

    public function getRecordById($id) {
        $sql = "SELECT * FROM " . Database::$table_prefix . "records WHERE id='$id'";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $record = new Record($row['id'], $row['name'], $row['author'], $row['releaseDate'], $row['label'], $row['description'], $row['image'], $row['tags'], $row['rating'], $row['userId']);

                return $record;
            }
        }

        return null;
    }

    private function getImagePath($id) {
        $sql = "SELECT image FROM " . Database::$table_prefix . "records WHERE id='$id'";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $imagePath = $row["image"];

                return $imagePath;
            }
        }
        
        return null;
    }

    public function updateRecord(Record $record) {
        $id = $record->id;
        $name = $record->name;
        $author = $record->author;
        $releaseDate = $record->releaseDate;
        $label = $record->label;
        $description = $record->description;
        $image = $record->image;
        $tags = $record->tags;
        $rating = $record->rating;
        $userId = $record->userId;

        $sql = "UPDATE " . Database::$table_prefix . "records SET name='$name', author='$author', releaseDate='$releaseDate', label='$label', description='$description', image='$image', tags='$tags', rating='$rating', userId='$userId' WHERE id='$id'";

        $this->conn->query($sql);
    }

    public function deleteRecord($id) {
        if (!unlink($this->getImagePath($id))) { 
            echo ($this->getImagePath($id) . " no se ha podido borrar la imagen del disco.");
            exit(); 
        }
        $sql = "DELETE FROM ". Database::$table_prefix . "records WHERE id=$id";
        $this->conn->query($sql);
    }
}