<?php

namespace App\Models;

class User 
{
    private $db;
    private $email;
    private $password;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function setEmail($email)
    {
        $this->email = mysqli_real_escape_string($this->db, $email);
    }

    public function setPassword($password)
    {
        $this->password = mysqli_real_escape_string($this->db, $password);
    }

    public function validate()
    {
        $errors = [];
    }

}