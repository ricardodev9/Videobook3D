<?php
require_once 'conf.php';    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VideoBook3D</title>
    <link rel="stylesheet" href="assets/css/styles.css">
        <!-- tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- js del home -->
    <!-- <script src="assets/js/home.js"></script> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
</head>
<body>
    
    <div id="homeContent">
   
	<header class="headerContent">
		<nav class="navContent">
			<ul class="flex items-center">
				<li>
                <!-- BUSCADOR -->                    

                    <div class="flex items-center">  
                        <form action="" method="get">
                        <input type="text" id="q" name="q" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 ps-7 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Película,serie o libro" />
                   
                        <button type="submit" id="buscador_film" class="inline-flex items-center py-1.5 px-2 ms-2 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            <svg class="w-4 h-4 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                            </svg>Buscar
                        </button>
                        </form>
                    </div>



                </li>

                
			</ul>
		</nav>
	</header>

	<section>
        <?php
        
        // Conexión al servidor MySQL sin especificar una base de datos
        $conn = new mysqli($DB_HOST, $DB_USER, $DB_PASS, '', $DB_PORT);

        // Verificar conexión
        if ($conn->connect_error) {
            die("Connection to MySQL server failed: " . $conn->connect_error);
        }

        // Verificar si la base de datos existe
        $result = $conn->query("SHOW DATABASES LIKE '$DB_NAME'");
        if ($result->num_rows == 0) {
            die("Por favor, crea la base de datos '$DB_NAME' ejecutabdo db_init.php");
        }

        // Seleccionar la base de datos
        $conn->select_db($DB_NAME);
        ?>
        <div class="container">
            <?php
        if(isset($_GET['id_imdb']) && $_GET['id_imdb'] != ''){
            /**
             * Create html for api 
             */
            if(isset($_POST['titulo']) && isset($_POST['desc']) && isset($_POST['anho']) && isset($_POST['duracion'])){
            $id_imdb = $_GET['id_imdb'];
            $img_url = $_POST['imagen'];
            $titulo = $_POST['titulo'];
            $desc = $_POST['desc'];
            $anho = $_POST['anho'];
            $duracion = $_POST['duracion'];
            ?>
            <input type="hidden" id="id_imdb" value="<?=$_GET['id_imdb']?>">
            <script src="assets/js/imdb.js"></script>

            <div class=" lg:py-12 lg:flex lg:justify-center text-lg">
                <div class=" lg:w-full lg:flex lg:rounded-lg">
                    <div class="lg:w-1/2 flex items-center justify-center">
                        <img src="<?=$img_url?>" alt="Descripción de la imagen" class="h-64 w-50  lg:h-full object-cover">
                    </div>

                    <div class=" px-4 lg:w-1/2">
                        <h2 class="text-3xl text-gray-800 font-bold"><?=$titulo?></h2>
            
                        <p class="mt-4 text-gray-600"><span class="text-black">Sinopsis: </span> <span id="generos"><img src="assets/img/loading.gif" alt="" class="loading_gif"></span>
                        <br><?=$desc?></p>
                
                        <p class="mt-4 text-gray-600"><span class="text-black">Año: </span><?=$anho?></p>

                        <p class="mt-4 text-gray-600" id="p_duracion"><span class="text-black">Duración: </span><?=$duracion?></p>

                 
                                <!-- Aquí va el rating: Esto se creará después de hacer el ajax -->
                        <div class="rating_stars" id="div_rating_stars">
                            <p id="p_rating" class="mt-4 text-gray-600 text-black" >Rating: <img src="assets/img/loading.gif" alt="" class="loading_gif"></p>    
                        
                        </div>

                        
                        <!-- FIN rating -->

                        <!-- Aquí va los productores y compañías: Esto se creará después de hacer el ajax -->
                        <div class="mt-4 text-gray-600" id="div_producers">
                            <p id="p_producer" class="mt-4 text-gray-600 text-black">Producers: <img src="assets/img/loading.gif" alt="" class="loading_gif"></p>
                        </div>
                        <!-- FIN producers -->
                                    
                        <div class="mt-8">
                            <a href="#" class="bg-gray-900 text-gray-100 px-5 py-3 font-semibold rounded">Start Now</a>
                        </div>
                      
                    </div>
                </div>
             
            </div>
           
            <div class="extra_info">
            <hr class="w-200 h-1 my-10 bg-black-500 dark:bg-black-700">
                <div class="company">
                    <h2 class="text-3xl text-gray-800 font-bold">Productoras</h2>
                    <div id="div_company" >
                    <img src="assets/img/loading.gif" alt="" class="loading_gif">


                    </div>
                   
                </div>
                <br>
                

                <div class="casting">
                    <h2 class="text-3xl text-gray-800 font-bold">Casting</h2>
                    <div id="div_casting" class=" dark:text-gray-400">
                    <img src="assets/img/loading.gif" alt="" class="loading_gif">


                    </div>
                   
                </div>
            </div>

            <?php
            }else{
                echo "boton para volver atrás";
                
            }   
        }else if(isset($_GET['q']) && $_GET['q'] != ''){
            $q = $_GET['q'];
            
            ?>
            <input type="hidden" name="q" id="q" value="<?=$q?>">
            <script src="assets/js/imdb_by_name.js"></script>
            <p id="p_loading">Obteniendo datos...</p>
<ul class="max-w-md divide-y divide-gray-200 dark:divide-gray-700">
   <li class="pb-3 sm:pb-4"><br>
      <div class="flex items-center space-x-4 rtl:space-x-reverse">
         <div class="flex-1 min-w-0">
            <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
               Neil Sims
            </p>
            <p class="text-sm text-gray-500 truncate dark:text-gray-400">
               email@flowbite.com
            </p>
         </div>
         <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
            $320
         </div>
      </div>
   </li>
</ul>


<?php
        }else{

            $elementos = get_elements_sql($conn);
            foreach($elementos as $elemento){
                ?>
                <input type="hidden" id="id_imdb" value="<?=$elemento->getId_imdb()?>">
                    <div class="cellphone-container" id="cardbox_<?=$elemento->getId_imdb()?>">
                        <div class="movie-img">
                            <img src="<?=$elemento->getImg_url()?>" class="img_portada" alt="portada elemento" style="border-top-left-radius:5px; border-top-right-radius : 5px">
                        </div>
                        <div class="movie-details">
                        <h2><?=$elemento->getTitulo()?></h2>
                        
                        <p class="desc"><?=$elemento->getDescripcionFormatted($elemento->getDescripcion())?></p><br>
                        <!-- <p class="director" id="director_<?//=$elemento->getId_imdb()?>"></p>
                        <p class="casting" id="casting_<?//=$elemento->getId_imdb()?>"></p> -->
                        <p class="tipo" id="tipo_<?=$elemento->getId_imdb()?>"><i class="fa-solid fa-tag" ></i>&nbsp&nbsp <?=$elemento->getTipo()?></p>
                        <p class="anho" id="anho_<?=$elemento->getId_imdb()?>"><i class="fa-solid fa-calendar-days"></i>&nbsp&nbsp<?=$elemento->getAnho()?></p>
                        <p class="duracion" id="duracion_<?=$elemento->getId_imdb()?>"><i class="fa-solid fa-clock"></i>&nbsp&nbsp<?=$elemento->getDuracion()?></p>
                        <br>
                        <form action="?id_imdb=<?=$elemento->getId_imdb()?>" method = "POST">   
                            <input type="hidden" name="id_imdb" value="<?=$elemento->getId_imdb()?>"/>
                            <input type="hidden" name="imagen" value="<?=$elemento->getImg_url()?>" />
                            <input type="hidden" name="titulo" value="<?=$elemento->getTitulo()?>"/>
                            <input type="hidden" name="desc" value="<?=$elemento->getDescripcion()?>"/>
                            <input type="hidden" name="anho" value="<?=$elemento->getAnho()?>"/>
                            <input type="hidden" name="duracion" value="<?=$elemento->getDuracion()?>"/>
                            <button class="btn_action" id="btn_info" >Ver más</button>
                        </form>
                    </div>
                    <!-- <div class="action-btn">
                            <a href="#" class="watch-btn">Watch Now</a>
                        </div> -->
                </div>
                <?php
            }
            ?>
            <?php } ?>
        </div>

	</section>



	<footer>
		<p></p>
	</footer>

    </div>
</body>
</html>