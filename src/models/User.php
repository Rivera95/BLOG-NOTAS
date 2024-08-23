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

        if (empty($this->email)) {
            $errors[] = 'El correo electronico es oblihatorio';
        } elseif (!filter_var($this->email,FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'El correo electronico no esvalido';
        }

        if (empty($this->password)) {
            $errors[] = 'La contraseña es obligatoria';
        } elseif (strlen($this->password) < 6 ) {
            $errors[] = 'La contrasena debe tener al menos 6 caracteres';
        }

        return $errors;
    }

    public function save()
    {
        if (!empty($this->validate())) {
            return false;
        }

        $hashedPassword = password_hash($this->password, PASSWORD_BCRYPT);
        $query = $this->db->prepare("INSERT INTO users (email, password) VALUES (?, ?)");

        if (!$query) {
            throw new \Exception("Error al preparar la consulta" . $this->db->error);
        }

        $query->bind_param("ss",$this->email, $hashedPassword);

        if (!$query->execute()) {
            throw new \Exception("Errro al ejecutar la consulta". $this->db->error);
        }
    }

    public function authenticate()
    {
        $query = $this->db->prepare("SELECT FROM users WHERE email = ? LIMIT 1");
        $query->bind_param("s",$this->email);
        $query->execute();
        $result = $query->get_result();

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();
            if (password_verify($this->password, $user["password"])) {
                return $user;
            }
        }
        return false;
    }

}