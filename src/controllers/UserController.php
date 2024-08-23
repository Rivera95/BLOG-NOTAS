<?php 

namespace App\Controllers;

use App\Models\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController 
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function register(Request $request)
    {
        $email = $request->get('email');
        $password = $request->get('password');

        $user = new User($this->db);
        $user->setEmail($email);
        $user->setPassword($password);

        $errors = $user->validate();
        if (!empty($errors)) {
            return new Response(implode(",", $errors), Response::HTTP_BAD_REQUEST);
        }

        if ($user->save()) {
            return new Response('Usuario resgistrado exitosamente.', Response::HTTP_CREATED);
        } else {
            return new Response('Error al registrar el usuario.', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function login(Request $request)
    {
        $email = $request->get('email');
        $password = $request->get('password');

        $user = new User($this->db);
        $user->setEmail($email);
        $user->setPassword($password);

        $authenticateUser = $user->authenticate();

        if ($authenticateUser) {
            return new Response('Inicio de sesión exitoso.', Response::HTTP_OK);
        } else {
            return new Response('Credenciales inválidas.', Response::HTTP_UNAUTHORIZED);
        }
    }
}