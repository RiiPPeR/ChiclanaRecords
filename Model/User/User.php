<?php

class User {
    public $id;
    public $name;
    public $surname;
    public $email;
    public $password;
    public $username;
    public $rol;

    public function __construct($id, $name, $surname, $email, $password, $username, $rol) {
        $this->id = $id;
        $this->name = $name;
        $this->surname = $surname;
        $this->email = $email;
        $this->password = $password;
        $this->username = $username;
        $this->rol = $rol;
    }
}