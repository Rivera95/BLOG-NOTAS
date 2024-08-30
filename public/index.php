<?php 

require __DIR__ . '/../vendor/autoload.php';

use Controllers\UserController;
use MVC\Router;

$router = new Router();

$router->get('/',[UserController::class,'login']);

$router->checkRoutes();