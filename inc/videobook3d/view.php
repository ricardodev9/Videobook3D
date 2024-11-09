<?php

/**
 * Manejar diferentes vistas de la plataforma
 */
if (isset($_GET['uuid']) && $_GET['uuid'] != '') {
    $view = 'search';
}else{
    $view = 'homepage';
}
?>