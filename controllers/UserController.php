<?php

namespace Controllers;

use Model\User;
use MVC\Router;

class UserController 
{
    public static function login(Router $router) {
        $alert = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $auth = new User($_POST);
            $alert = $auth->validateNewAccount();

            if (empty($alert)) {
                $user = User::where('email', $auth->email);

                if ($user) {
                    session_start();

                    $_SESSION['id'] = $user->id;
                    $_SESSION['email'] = $user->email;
                    $_SESSION['login'] = true;

                    if ($user->admin === 1) {
                        $_SESSION['admin'] = $user->admin ?? null;
                        header('Location: /');
                    } else {
                        header('Location: /');
                    }
                } else {
                    User::setAlerta('error','Usuario no encontrado');
                }
            }
        }

        $alert = User::setAlerta();

        $router->render('auth/login', [
            'alertas' => $alert
        ]);
    }
}