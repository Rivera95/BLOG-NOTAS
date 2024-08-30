<?php

namespace Model;

class User extends ActiveRecord 
{
    protected static $table = 'users';
    protected static $columnBd = ['id', 'email', 'password', 'created_at'];

    public $id;
    public $email;
    public $password;
    public $created_at;

    public function __construct($args = []) {
        $this->id = $args['id'] ?? null;
        $this->email = $args['email'] ?? null;
        $this->password = $args['password'] ?? null;
        $this->created_at = $args['created_at'] ?? null;
    }

    public function validateNewAccount() {
        if (!$this->email) {
            self::$alertas['error'][] = 'El correo es obligatorio';
        }

        if (!$this->password) {
            self::$alertas['error'][] = 'La contraseña es obligatoria';
        }

        if (strlen($this->password) < 6) {
            self::$alertas['error'][] = 'La contraseña debe tener mas de 6 caracteres';
        }
        return self::$alertas;
    }   
}