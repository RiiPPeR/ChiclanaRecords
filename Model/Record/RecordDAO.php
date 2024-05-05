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

        $sql = "INSERT INTO " . Database::$table_prefix . "records (name, author, releaseDate, label, description, tags, rating, userId) VALUES ('$name', '$author', '$releaseDate', '$label', '$description', '$image', '$tags', '$rating', '$userId')";
    }
}