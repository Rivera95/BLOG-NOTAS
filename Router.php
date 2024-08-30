<?php

namespace MVC;

class Router
{
    public array $getRoutes = [];
    public array $postRoutes = [];

    public function get($url, $fn) {
        $this->getRoutes[$url] = $fn;
    }

    public function post($url, $fn) {
        $this->postRoutes[$url] = $fn;
    }

    public function checkRoutes() {
        $currentUrl = $_SERVER['PATH_INFO'] ?? '/';
        $method = $_SERVER['REQUEST_METHOD'];

        if ($method === 'GET') {
            $fn = $this->getRoutes[$currentUrl] ?? null; 
        } else {
            $fn = $this->postRoutes[$currentUrl] ?? null;
        }

        if ($fn) {
            call_user_func($fn, $this);
        } else {
            echo 'Página No Encontrada o Ruta no válida';
        }
    }

    public function render($view, $data = []) {
        foreach ($data as $key => $value) {
            $$key = $value;
        }
        ob_start();

        include_once __DIR__ . '/views/$view.php';
        $content = ob_get_clean();
        include_once __DIR__ . '/views/layout.php';
    }
}