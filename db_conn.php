<?php
/**
 * Funciones para la conexión a BBDD y algunas restricciones globales
 */
include_once 'conf.php';

function connect_db() {
    global $DB_HOST, $DB_USER, $DB_PASS, $DB_NAME, $DB_PORT;
    $conn = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME, $DB_PORT);
    return $conn;
}
$conn = connect_db();

// if (isset($_SESSION['user_email']) && basename($_SERVER['PHP_SELF']) === 'login.php') {
//     header("Location: http://localhost/pruebas_tecnicas/origami_soluciones/index.php"); 
// }
?>