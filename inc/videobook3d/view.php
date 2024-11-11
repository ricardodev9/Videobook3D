<?php

/**
 * Manejar diferentes vistas de la plataforma
 */

 include_once __DIR__.'/../../db_conn.php';
 include_once __DIR__.'/../class/Videobook.php';

$videobook = new Videobook($conn);
 
if (isset($_GET['uuid']) && $_GET['uuid'] != '') {
    $view = 'search';
    $elemento = $videobook->getVideobookByUuid($_GET['uuid']);
}else{
    $view = 'homepage';
    $elementos = $videobook->getVideobooks();
}
?>