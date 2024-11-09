<?php
    /**
     * Modelo para setear las variables que se van a utilizar en la vista
     */

    include_once __DIR__.'/../../db_conn.php';
    include_once __DIR__.'/../class/Videobook.php';
    //conexión
    $conn = connect_db();
    if($conn){
        //iniciamos la class pricipal del proyecto
        $videobook = new Videobook($conn);
        $elementos = $videobook->getVideobooks();
    }
?>