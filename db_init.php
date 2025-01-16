<?php

/**
 * Archivo para inicializar las tablas de la base de datos
 */
require_once 'conf.php';
require 'vendor/autoload.php';

use Ramsey\Uuid\Uuid;

// Coneccion al workbench
$conn = new mysqli($DB_HOST, $DB_USER, $DB_PASS, '', $DB_PORT);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if ($conn) {
  $dbname = "videobook3d";
  $database = $conn->query("CREATE DATABASE IF NOT EXISTS " . $dbname);

  // Verificar si la DB se ha creado
  if ($database === true) {
    echo "DB CREATED <br>";
  } else {
    echo "Error in db create <br>";
  }
  if (!$conn->select_db($dbname)) {
    die("Error al seleccionar la base de datos: " . $db->error);
  }

  // Creación de tablas
  $sql = "CREATE TABLE IF NOT EXISTS {$videobook_table} (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    uuid VARCHAR(255) NOT NULL UNIQUE,
    title VARCHAR(30) NOT NULL,
    `desc` VARCHAR(500) NOT NULL,
    `year` VARCHAR(30) NOT NULL,
    `type` VARCHAR(50),
    duration VARCHAR(100) NOT NULL,
    img_url VARCHAR(100) NOT NULL,
    date_created DATETIME,
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
  )";

  if ($conn->query($sql) === true) {
    echo "Tabla para los videobooks creada<br>";
    $elementos = array(
      'elemento1' => array(
        'title' => 'The Notebook',
        'desc' => 'Historia de amor entre Allie Hamilton y Noah Calhoun y recordada en una residencia de ancianos, décadas después de que sucediera. Basada en el libro de Nicholas Sparks.',
        'year' => '2004',
        'type' => 'película',
        'duration' => '2h 1m',
        'img_url' => 'assets/img/thenotebook_portada.jpg',

      ),
      'elemento2' => array(
        'title' => 'Fast & Furious X',
        'desc' => 'Fast X es una película de acción estadounidense dirigida por Louis Leterrier y escrita por Justin Lin y Dan Mazeau. Es la secuela de F9, la décima entrega principal y la undécima en total de la franquicia Fast & Furious.',
        'year' => '2023',
        'type' => 'película',
        'duration' => '2h 21m',
        'img_url' => 'assets/img/fastx_portada.jpg',

      ),
      'elemento3' => array(
        'title' => 'Interstellar',
        'desc' => 'Un grupo de científicos y exploradores, liderados por Cooper, se embarcan en un viaje espacial para encontrar un lugar con las condiciones necesarias para sustituir a la Tierra y comenzar allí una nueva vida. La Tierra está llegando a su fin y este grupo necesita encontrar un planeta más allá de nuestra galaxia que garantice el futuro de la raza humana.',
        'year' => '2014',
        'type' => 'película',
        'duration' => '2h 49m',
        'img_url' => 'assets/img/interestellar_portada.jpg',

      ),
      'elemento4' => array(
        'title' => 'Death Note',
        'desc' => 'Un libro malévolo (Death Note) cae en manos de Yagami Light, un chico de 17 años. Un día encuentra este cuaderno negro en el patio de su colegio. Ese libro tiene instrucciones claras y contiene magia oscura: si alguien escribe un nombre en sus páginas, esa persona muere en cuestión de segundos.',
        'year' => '2006',
        'type' => 'serie',
        'duration' => '2 temporadas (19 y 18 capitulos)',
        'img_url' => 'assets/img/deathnote_portada.jpg',

      ),
      'elemento5' => array(
        'title' => 'American Sniper',
        'desc' => 'Chris Kyle, un marine del Grupo de Operaciones Especiales del Ejército de Estados Unidos, tiene la misión de proteger a sus compañeros, acabando con la vida de cualquiera que pueda ponerlos en peligro. La película está basada en las memorias del marine Chris Kyle, que batió el récord de muertes como francotirador del ejército estadounidense durante la guerra de Irak.',
        'year' => '2014',
        'type' => 'película',
        'duration' => '2h 12m',
        'img_url' => 'assets/img/americasniper_portada.jpg',
      )
    );

    // Insert de los datos creados
    foreach ($elementos as $indice => $elemento) {
      $uuid = Uuid::uuid4()->toString();
      $titulo = $elemento['title'];
      $anho = $elemento['year'];
      $tipo = $elemento['type'];
      $descripcion = $elemento['desc'];
      $img_url = $elemento['img_url'];
      $duration = $elemento['duration'];
      $insert = "INSERT INTO {$videobook_table} (uuid,title,`desc`,`year`,`type`,duration,img_url,date_created,reg_date) VALUES (?, ?, ?, ?, ?, ?, ?,CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)";

      // Preparación de la consulta
      $statement = $conn->prepare($insert);
      if ($statement) {
        // Enlazar parámetros y ejecutar la consulta
        $statement->bind_param("sssssss", $uuid, $titulo, $descripcion, $anho, $tipo, $duration, $img_url);
        if ($statement->execute()) {
          echo "Insert of " . $indice . " done <br>";
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
    echo "<a href='" . $baseUrl . "/index.php'>Inicio</a><br>";

    // Crear tabla para actores
    $sql2 = "CREATE TABLE IF NOT EXISTS {$actor_table} (
      id int(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
      uuid VARCHAR(255) NOT NULL UNIQUE,
      `name` VARCHAR(100) NOT NULL,
      birth_date DATE,
      country VARCHAR(50),
      bio TEXT,
      img_url VARCHAR(255),
      reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";

    if ($conn->query($sql2)) {
      echo "Tabla para actores creada<br>";

      // Datos de los actores
      $actores = [
        // Actores para "The Notebook"
        [
          'nombre' => 'Ryan Gosling',
          'birth_date' => '1980-11-12',
          'country' => 'Canada',
          'bio' => 'Ryan Gosling interpreta a Noah Calhoun en "The Notebook", un papel icónico en su carrera.',
          'img_url' => 'assets/img/ryan_gosling.jpg'
        ],
        [
          'nombre' => 'Rachel McAdams',
          'birth_date' => '1978-11-17',
          'country' => 'Canada',
          'bio' => 'Rachel McAdams interpreta a Allie Hamilton en "The Notebook".',
          'img_url' => 'assets/img/rachel_mcadams.jpg'
        ],
        [
          'nombre' => 'James Garner',
          'birth_date' => '1928-04-07',
          'country' => 'EEUU',
          'bio' => 'James Garner interpreta a Duke, el personaje anciano de Noah Calhoun.',
          'img_url' => 'assets/img/james_garner.jpg'
        ],

        // Actores para "Fast & Furious X"
        [
          'nombre' => 'Vin Diesel',
          'birth_date' => '1967-07-18',
          'country' => 'EEUU',
          'bio' => 'Vin Diesel interpreta a Dominic Toretto en "Fast & Furious X".',
          'img_url' => 'assets/img/vin_diesel.jpg'
        ],
        [
          'nombre' => 'Michelle Rodriguez',
          'birth_date' => '1978-07-12',
          'country' => 'EEUU',
          'bio' => 'Michelle Rodriguez interpreta a Letty Ortiz en "Fast & Furious X".',
          'img_url' => 'assets/img/michelle_rodriguez.jpg'
        ],
        [
          'nombre' => 'Jason Momoa',
          'birth_date' => '1979-08-01',
          'country' => 'EEUU',
          'bio' => 'Jason Momoa interpreta a Dante Reyes en "Fast & Furious X".',
          'img_url' => 'assets/img/jason_momoa.jpg'
        ],

        // Actores para "Interstellar"
        [
          'nombre' => 'Matthew McConaughey',
          'birth_date' => '1969-11-04',
          'country' => 'EEUU',
          'bio' => 'Matthew McConaughey interpreta a Cooper en "Interstellar".',
          'img_url' => 'assets/img/matthew_mcconaughey.jpg'
        ],
        [
          'nombre' => 'Anne Hathaway',
          'birth_date' => '1982-11-12',
          'country' => 'EEUU',
          'bio' => 'Anne Hathaway interpreta a la Dra. Amelia Brand en "Interstellar".',
          'img_url' => 'assets/img/anne_hathaway.jpg'
        ],
        [
          'nombre' => 'Jessica Chastain',
          'birth_date' => '1977-03-24',
          'country' => 'EEUU',
          'bio' => 'Jessica Chastain interpreta a Murph adulta en "Interstellar".',
          'img_url' => 'assets/img/jessica_chastain.jpg'
        ],

        // Actores para "Death Note" (versión japonesa del anime)
        [
          'nombre' => 'Tatsuya Fujiwara',
          'birth_date' => '1982-05-15',
          'country' => 'Japan',
          'bio' => 'Tatsuya Fujiwara interpreta a Light Yagami en la adaptación de "Death Note".',
          'img_url' => 'assets/img/tatsuya_fujiwara.jpg'
        ],
        [
          'nombre' => 'Kenichi Matsuyama',
          'birth_date' => '1985-03-05',
          'country' => 'Japan',
          'bio' => 'Kenichi Matsuyama interpreta a L en "Death Note".',
          'img_url' => 'assets/img/kenichi_matsuyama.jpg'
        ],
        [
          'nombre' => 'Erika Toda',
          'birth_date' => '1988-08-17',
          'country' => 'Japan',
          'bio' => 'Erika Toda interpreta a Misa Amane en "Death Note".',
          'img_url' => 'assets/img/erika_toda.jpg'
        ],

        // Actores para "American Sniper"
        [
          'nombre' => 'Bradley Cooper',
          'birth_date' => '1975-01-05',
          'country' => 'EEUU',
          'bio' => 'Bradley Cooper interpreta a Chris Kyle en "American Sniper".',
          'img_url' => 'assets/img/bradley_cooper.jpg'
        ],
        [
          'nombre' => 'Sienna Miller',
          'birth_date' => '1981-12-28',
          'country' => 'UK',
          'bio' => 'Sienna Miller interpreta a Taya Renae Kyle en "American Sniper".',
          'img_url' => 'assets/img/sienna_miller.jpg'
        ],
        [
          'nombre' => 'Kyle Gallner',
          'birth_date' => '1986-10-22',
          'country' => 'EEUU',
          'bio' => 'Kyle Gallner interpreta a Goat-Winston en "American Sniper".',
          'img_url' => 'assets/img/kyle_gallner.jpg'
        ]
      ];

      // Insertar la información
      foreach ($actores as $actor) {
        $uuid = Uuid::uuid4()->toString();
        $insert_actor = "INSERT INTO {$actor_table} (uuid,`name`,birth_date,country,bio,img_url,date_created,reg_date) VALUES (?, ?, ?, ?, ?, ?,CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)";
        
      }
    }

  } else {
    echo "Error creating table elemento " . $conn->error;
  }

  $conn->close();
}
