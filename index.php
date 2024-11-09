<?php
require 'videobook3d.php';
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
    <script src="assets/js/imdb_by_name.js"></script>
    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

</head>

<body>
    <?php
    //onclick="buscarElementoByNombre()"
    include 'resources/navbar.php';
    ?>
    <div id="homeContent">
        <section>
            <?php
            // Verificar conexión
            if ($conn->connect_error) {
                die("Connection to MySQL server failed: " . $conn->connect_error);
            }
            ?>
            <div class="container" id="div_padre">
                <?php
                if ($view == 'search') {
                    if (isset($_POST['titulo']) && isset($_POST['desc']) && isset($_POST['anho']) && isset($_POST['duracion'])) {
                        $id_imdb = $_GET['id_imdb'];
                        $img_url = $_POST['imagen'];
                        $titulo = $_POST['titulo'];
                        $desc = $_POST['desc'];
                        $anho = $_POST['anho'];
                        $duracion = $_POST['duracion'];
                ?>
                        <input type="hidden" id="id_imdb" value="<?= $_GET['id_imdb'] ?>">
                        <script src="assets/js/imdb.js"></script>
                        <div class=" lg:py-12 lg:flex lg:justify-center text-lg">
                            <div class=" lg:w-full lg:flex lg:rounded-lg">
                                <div class="lg:w-1/2 flex items-center justify-center">
                                    <img src="<?= $img_url ?>" alt="Descripción de la imagen" class="h-64 w-50  lg:h-full ">
                                </div>
                                <div class=" px-4 lg:w-1/2">
                                    <h2 class="text-3xl text-gray-800 font-bold"><?= $titulo ?></h2>
                                    <p class="movie-description  mt-4 text-gray-600"><span class="text-black">Sinopsis: </span> <span id="generos"><img src="assets/img/loading.gif" alt="" class="loading_gif"></span>
                                        <br><?= $desc ?>
                                    </p>
                                    <p class="mt-4 text-gray-600"><span class="text-black">Año: </span><?= $anho ?></p>
                                    <p class="mt-4 text-gray-600" id="p_duracion"><span class="text-black">Duración: </span><?= $duracion ?></p>

                                    <!-- Aquí va el rating: Esto se creará después de hacer el ajax -->
                                    <div class="rating_stars" id="div_rating_stars">
                                        <p id="p_rating" class="mt-4 text-gray-600 text-black">Rating: <img src="assets/img/loading.gif" alt="" class="loading_gif"></p>

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
                                <div id="div_company">
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
                    } else {
                        echo "boton para volver atrás";
                    }
                } else {
                    foreach ($elementos as $elemento) {
                    ?>
                        <input type="hidden" id="id_imdb" value="<?= $elemento->id ?>">
                        <!-- cellphone-container -->
                        <div class="cellphone-container" id="cardbox_<?= $elemento->id ?>">

                            <!-- movie-img -->
                            <div class="movie-img">
                                <img src="<?= $elemento->img_url ?>" class="img_portada" alt="portada elemento" style="border-top-left-radius:5px; border-top-right-radius : 5px">
                            </div>
                            <!-- FIN movie-img -->

                            <!-- movie-details -->
                            <div class="movie-details">
                                <h2><?= $elemento->titulo ?></h2>
                                <p class="desc"><?= $elemento->descripcion ?></p><br>
                                <p class="tipo" id="tipo_<?= $elemento->id ?>"><i class="fa-solid fa-tag"></i> <?= $elemento->tipo == 'movie' ? 'Película' : (($elemento->tipo == 'serie') ? 'Serie' : 'N/A') ?></p>
                                <p class="anho" id="anho_<?= $elemento->id ?>"><i class="fa-solid fa-calendar-days"></i><?= $elemento->anho ?></p>
                                <p class="duracion" id="duracion_<?= $elemento->id ?>"><i class="fa-solid fa-clock"></i><?= $elemento->duracion ?></p>
                                <br>
                                <form action="?id_imdb=<?= $elemento->id ?>" method="POST">
                                    <input type="hidden" name="id_imdb" value="<?= $elemento->id ?>" />
                                    <input type="hidden" name="imagen" value="<?= $elemento->img_url ?>" />
                                    <input type="hidden" name="titulo" value="<?= $elemento->titulo ?>" />
                                    <input type="hidden" name="desc" value="<?= $elemento->descripcion ?>" />
                                    <input type="hidden" name="anho" value="<?= $elemento->anho ?>" />
                                    <input type="hidden" name="duracion" value="<?= $elemento->duracion ?>" />
                                    <button class="btn_action" id="btn_info">Ver más</button>
                                </form>
                            </div>
                            <!-- FIN movie-details -->

                        </div><!-- FIN cellphone-container -->
                    <?php
                    }
                    ?>
                <?php } ?>
            </div><!-- fin container class -->
        </section>
    </div>
    <?php
    include('footer.php')
    ?>
</body>

</html>