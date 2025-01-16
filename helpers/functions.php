<?php

function render_view($view, $data = []) {
    extract($data); // Convierte claves del array en variables
    ob_start(); // Inicia el buffer de salida
    include VIEWS_FOLDER . "/{$view}.php";
    $content = ob_get_clean(); // Obtiene el contenido y limpia el buffer
    include VIEWS_FOLDER . '/main.php'; // Incluye el layout principal
}

function redirect($url) {
    header("Location: $url");
    exit;
}

function get_base_url() {
    return (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]/videobook3d";
}

?>