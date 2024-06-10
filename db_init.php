<?php
/**
 * archivo para inicializar las tablas de la base de datos
*/
require_once 'conf.php';
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
    id_imdb int(10) NOT NULL, 
    UNIQUE (id_imdb),
    titulo VARCHAR(30) NOT NULL,
    descripcion VARCHAR (300) NOT NULL,
    anho VARCHAR(30) NOT NULL,
    tipo VARCHAR(50),
    duracion VARCHAR(100) NOT NULL,
    img_url VARCHAR(100) NOT NULL,
    fecha_created DATETIME,
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";

    if($conn->query($sql) === true ){   
      echo "table created<br>";
      //$now = date("Y-m-d H:i:s");
      $elementos = array(
        'elemento1' => array(
            'id_imdb' => "0332280",
            'titulo' => 'The Notebook',
            'descripcion' => 'Love story between Allie Hamilton and Noah Calhoun and remembered in a nursing home, decades after it happened. Based on the book by Nicholas Sparks.',
            'anho' => '2004',
            'tipo' => 'movie',
            'duracion' => '2h 1m',
            'img_url' => 'assets/img/thenotebook_portada.jpg',
            
        ),
        'elemento2' => array(
            'id_imdb' => "5433140",
            'titulo' => 'Fast & Furious X',
            'descripcion' => 'Fast X is an American action film directed by Louis Leterrier and written by Justin Lin and Dan Mazeau. It is the sequel to F9, the tenth main installment and the eleventh installment overall of the Fast & Furious franchise.',
            'anho' => '2023',
            'tipo' => 'movie',
            'duracion' => '2h 21m',
            'img_url' => 'assets/img/fastx_portada.jpg',
            
        ),
        'elemento3' => array(
          'id_imdb' => "0816692",
          'titulo' => 'Interstellar',
          'descripcion' => 'A group of scientists and explorers, led by Cooper, embark on a space journey to find a place with the necessary conditions to replace Earth and start a new life there. The Earth is coming to an end and this group needs to find a planet beyond our galaxy that guarantees the future of the human race.',
          'anho' => '2014',
          'tipo' => 'movie',
          'duracion' => '2h 49m',
          'img_url' => 'assets/img/interestellar_portada.jpg',
          
        ),
          'elemento4' => array(
            'id_imdb' => "0877057",
            'titulo' => 'Death Note',
            'descripcion' => 'A malevolent book (Death Note) falls into the hands of Yagami Light, a 17-year-old boy. He finds this black notebook one day in the playground of his school. That book has clear instructions and contains dark magic: if someone writes a name in its pages, that person dies within seconds.',
            'anho' => '2006',
            'tipo' => 'serie',
            'duracion' => '2 temporadas (19 y 18 capitulos)',
            'img_url' => 'assets/img/deathnote_portada.jpg',
            
          ),
          'elemento5' => array(
            'id_imdb' => "2179136",
            'titulo' => 'American Sniper',
            'descripcion' => 'Chris Kyle, a Marine in the United States Army Special Operations Group, has the mission of protecting his comrades, ending the lives of anyone who could put them in danger. The film is based on the memoir by Marine Chris Kyle who broke the record for kills as a US Army sniper during the Iraq War.',
            'anho' => '2014',
            'tipo' => 'movie',
            'duracion' => '2h 12m',
            'img_url' => 'assets/img/americasniper_portada.jpg',
        )
        
    );
    foreach($elementos as $indice => $elemento){
        $id_imdb = $elemento['id_imdb'];
        $titulo = $elemento['titulo'];
        $anho = $elemento['anho'];
        $tipo = $elemento['tipo'];
        //$fecha_created = $elemento['fecha_created'];
        $descripcion = $elemento['descripcion'];
        $img_url = $elemento['img_url'];
        $duration = $elemento['duracion'];
        $insert = "INSERT INTO elemento (id_imdb,titulo,descripcion,anho,tipo,duracion,img_url,fecha_created,reg_date) VALUES (?, ?, ?, ?, ?, ?, ?,CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)";

        // Preparación de la consulta
        $statement = $conn->prepare($insert);
        if ($statement) {
            // Enlazar parámetros y ejecutar la consulta
            $statement->bind_param("sssssss", $id_imdb ,$titulo,$descripcion, $anho, $tipo, $duration ,$img_url);
            if ($statement->execute()) {
                echo "Insert of ".$indice." done <br>";
            } else {
                // Manejo de errores
                echo "Error trying to exec insert: " . $statement->error;
            }
            // Cerrar la declaración
            $statement->close();
        } else {
            // Manejo de errores
            echo "Error preparing query: " . $conn->error;
        }

    }
    //we r going to create more info 
    // $sql2 = "CREATE TABLE IF NOT EXISTS TABLE personajes (
    //     id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    //     id_imdb int(10) NOT NULL, 
    //     nombre VARCHAR(100) NOT NULL,
        
    // )";

    }else{
        echo "Error creating table elemento " . $conn->error;
    }

    $conn->close();
    
}




?>