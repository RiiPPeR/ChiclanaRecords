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

    public function getRecordsByUsername($id) {
        $records = array();

        $sql = "SELECT * FROM " . Database::$table_prefix . "records LEFT JOIN " . Database::$table_prefix . "usuarios ON userId='$id'";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $record = new Record($row['id'], $row['name'], $row['author'], $row['releaseDate'], $row['label'], $row['description'], $row['image'], $row['tags'], $row['rating'], $row['userId']);

                $records[] = $record;
            }
        }

        return $records;
    }
}