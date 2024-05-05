<?php

class Record {
    public $id;
    public $name;
    public $author;
    public $releaseDate;
    public $label;
    public $description;
    public $image;
    public $tags;
    public $rating;
    public $userId;

    public function __construct( $id, $name, $author, $releaseDate, $label, $description, $image, $tags, $rating, $userId) {
        $this->id = $id;
        $this->name = $name;
        $this->author = $author;
        $this->releaseDate = $releaseDate;
        $this->label = $label;
        $this->description = $description;
        $this->image = $image;
        $this->tags = $tags;
        $this->rating = $rating;
        $this->userId = $userId;
    }
}