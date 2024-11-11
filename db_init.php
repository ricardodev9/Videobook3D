<?php
/**
 * archivo para inicializar las tablas de la base de datos
*/
require_once 'conf.php';
require 'vendor/autoload.php';

use Ramsey\Uuid\Uuid;
// coneccion al workbench
$conn = new mysqli($DB_HOST, $DB_USER, $DB_PASS, '', $DB_PORT);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($conn) {
$dbname="videobook3d";
$database = $conn->query("CREATE DATABASE IF NOT EXISTS ".$dbname);
if($database === true){
  echo "DB CREATED <br>";
}else{
  echo "Error in db create <br>";
}
if(!$conn->select_db($dbname)){
  die("Error al seleccionar la base de datos: " . $db->error);
}
$sql = "CREATE TABLE IF NOT EXISTS elemento (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    uuid VARCHAR(255) NOT NULL UNIQUE,
    uuid_session VARCHAR(255) NULL UNIQUE,
    titulo VARCHAR(30) NOT NULL,
    descripcion VARCHAR(500) NOT NULL,
    anho VARCHAR(30) NOT NULL,
    tipo VARCHAR(50),
    duracion VARCHAR(100) NOT NULL,
    img_url VARCHAR(100) NOT NULL,
    fecha_created DATETIME,
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";

    if($conn->query($sql) === true ){   
      echo "table created<br>";
      $elementos = array(
        'elemento1' => array(
            'titulo' => 'The Notebook',
            'descripcion' => 'Historia de amor entre Allie Hamilton y Noah Calhoun y recordada en una residencia de ancianos, décadas después de que sucediera. Basada en el libro de Nicholas Sparks.',
            'anho' => '2004',
            'tipo' => 'película',
            'duracion' => '2h 1m',
            'img_url' => 'assets/img/thenotebook_portada.jpg',
            
        ),
        'elemento2' => array(
            'titulo' => 'Fast & Furious X',
            'descripcion' => 'Fast X es una película de acción estadounidense dirigida por Louis Leterrier y escrita por Justin Lin y Dan Mazeau. Es la secuela de F9, la décima entrega principal y la undécima en total de la franquicia Fast & Furious.',
            'anho' => '2023',
            'tipo' => 'película',
            'duracion' => '2h 21m',
            'img_url' => 'assets/img/fastx_portada.jpg',
            
        ),
        'elemento3' => array(
          'titulo' => 'Interstellar',
          'descripcion' => 'Un grupo de científicos y exploradores, liderados por Cooper, se embarcan en un viaje espacial para encontrar un lugar con las condiciones necesarias para sustituir a la Tierra y comenzar allí una nueva vida. La Tierra está llegando a su fin y este grupo necesita encontrar un planeta más allá de nuestra galaxia que garantice el futuro de la raza humana.',
          'anho' => '2014',
          'tipo' => 'película',
          'duracion' => '2h 49m',
          'img_url' => 'assets/img/interestellar_portada.jpg',
          
        ),
          'elemento4' => array(
            'titulo' => 'Death Note',
            'descripcion' => 'Un libro malévolo (Death Note) cae en manos de Yagami Light, un chico de 17 años. Un día encuentra este cuaderno negro en el patio de su colegio. Ese libro tiene instrucciones claras y contiene magia oscura: si alguien escribe un nombre en sus páginas, esa persona muere en cuestión de segundos.',
            'anho' => '2006',
            'tipo' => 'serie',
            'duracion' => '2 temporadas (19 y 18 capitulos)',
            'img_url' => 'assets/img/deathnote_portada.jpg',
            
          ),
          'elemento5' => array(
            'titulo' => 'American Sniper',
            'descripcion' => 'Chris Kyle, un marine del Grupo de Operaciones Especiales del Ejército de Estados Unidos, tiene la misión de proteger a sus compañeros, acabando con la vida de cualquiera que pueda ponerlos en peligro. La película está basada en las memorias del marine Chris Kyle, que batió el récord de muertes como francotirador del ejército estadounidense durante la guerra de Irak.',
            'anho' => '2014',
            'tipo' => 'película',
            'duracion' => '2h 12m',
            'img_url' => 'assets/img/americasniper_portada.jpg',
        )
    );

    foreach($elementos as $indice => $elemento){
        $uuid = Uuid::uuid4()->toString();
        $titulo = $elemento['titulo'];
        $anho = $elemento['anho'];
        $tipo = $elemento['tipo'];
        //$fecha_created = $elemento['fecha_created'];
        $descripcion = $elemento['descripcion'];
        $img_url = $elemento['img_url'];
        $duration = $elemento['duracion'];
        $insert = "INSERT INTO elemento (uuid,titulo,descripcion,anho,tipo,duracion,img_url,fecha_created,reg_date) VALUES (?, ?, ?, ?, ?, ?, ?,CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)";

        // Preparación de la consulta
        $statement = $conn->prepare($insert);
        if ($statement) {
            // Enlazar parámetros y ejecutar la consulta
            $statement->bind_param("sssssss", $uuid, $titulo, $descripcion, $anho, $tipo, $duration, $img_url);
            if ($statement->execute()) {
                echo "Insert of ".$indice." done <br>";
            } else {
                // Manejo de errores
                echo "Error trying to exec insert: " . $statement->error . "<br>";
            }
            // Cerrar la declaración
            $statement->close();
        } else {
            // Manejo de errores
            echo "Error preparing query: " . $conn->error . "<br>";
        }

    }
    $baseUrl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]/videobook3d";
    echo "<a href='".$baseUrl."/index.php'>Inicio</a>";
    }else{
        echo "Error creating table elemento " . $conn->error;
    }

    $conn->close();
    
}




?>