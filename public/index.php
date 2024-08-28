<?php

require __DIR__ . '/../vendor/autoload.php';

use App\Controllers\UserController;
use Symfony\Component\HttpFoundation\Request;


$db = new mysqli('localhost', 'root','daruma','blog_notas');

if ($db->connect_error) {
    die('Error en la conexión a la base de datos: ' . $db->connect_error);
}

if ($_SERVER['REQUEST_URI'] === '/register' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new UserController($db);
    $response = $controller->register(Request::createFromGlobals());
    $response->send();
}

if ($_SERVER['REQUEST_URI'] === '/login' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new UserController($db);
    $response = $controller->login(Request::createFromGlobals());
    $response->send();
}

// Otras rutas...
