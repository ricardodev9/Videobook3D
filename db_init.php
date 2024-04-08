<?php
/**
 * archivo para inicializar las tablas de la base de datos
*/
require_once 'conf.php';
//$con = new Database($DB_HOST, $DB_NAME, $DB_USER, $DB_PASS);

$conn = new mysqli($DB_HOST, $DB_USER ,$DB_PASS , $DB_NAME);//$servername, $username, $password, $dbname
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}else{
    // sql to create table
$sql = "CREATE TABLE IF NOT EXISTS elemento (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(30) NOT NULL,
    anho VARCHAR(30) NOT NULL,
    tipo VARCHAR(50),
    fecha_created DATETIME,
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";

    if($conn->query($sql) === true ){
      echo "table created<br>";
      $now = date("Y-m-d H:i:s");
      $elementos = array(
        'elemento1' => array(
            'titulo' => 'The Notebook',
            'anho' => '2004',
            'tipo' => 'película',
            'fecha_created' => $now,
        ),
        'elemento2' => array(
            'titulo' => 'Fast and Furious 10',
            'anho' => '2023',
            'tipo' => 'película',
            'fecha_created' => $now
        ),
        'elemento3' => array(
          'titulo' => 'Interstellar',
          'anho' => '2014',
          'tipo' => 'película',
          'fecha_created' => $now
        ),
          'elemento4' => array(
            'titulo' => 'Death Note',
            'anho' => '2006',
            'tipo' => 'serie',
            'fecha_created' => $now
          ),
          'elemento5' => array(
            'titulo' => 'American Sniper',
            'anho' => '2014',
            'tipo' => 'película',
            'fecha_created' => $now
        )
        
    );
    foreach($elementos as $indice => $elemento){
        $titulo = $elemento['titulo'];
        $anho = $elemento['anho'];
        $tipo = $elemento['tipo'];
        $fecha_created = $elemento['fecha_created'];
        $insert = "INSERT INTO elemento (titulo,anho,tipo,fecha_created,reg_date) VALUES (?, ?, ?, ?, CURRENT_TIMESTAMP)";

        // Preparación de la consulta
        $statement = $conn->prepare($insert);
        if ($statement) {
            // Enlazar parámetros y ejecutar la consulta
            $statement->bind_param("ssss", $titulo, $anho, $tipo, $fecha_created);
            if ($statement->execute()) {
                echo "Insert of ".$indice." done <br>";
            } else {
                // Manejo de errores
                echo "Error al ejecutar la consulta: " . $statement->error;
            }
            // Cerrar la declaración
            $statement->close();
        } else {
            // Manejo de errores
            echo "Error en la preparación de la consulta: " . $conn->error;
        }

    }
     

    }else{
        echo "Error al crear tabla " . $conn->error;
    }

    $conn->close();
}




?>