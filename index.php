<?php
require_once 'videobook3d/init.php';

// Rutas simples (se pueden mejorar con un sistema de enrutamiento)
$uri = $_SERVER['REQUEST_URI'];
$db = Database::getInstance()->getConnection();

if ($uri === '/' || $uri === '/videobook3d/index.php') {
    // Inicializar la conexión a la base de datos

    // Instanciar el controlador
    $controller = new HomeController($db);

    // Llamar a la acción del controlador
    $controller->index();
} else {
    http_response_code(404);
    echo "Página no encontrada.";
}
?>