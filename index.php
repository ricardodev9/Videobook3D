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
    <link rel="stylesheet" href="assets/css/cardbox.css">
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
                $baseUrl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]/videobook3d";

                die("La conexión con el servidor MySQL falló: " . $conn->connect_error . "<br>Visita el archivo de ejecución de bbdd <a href='" . $baseUrl . "/db_init.php'>aquí</a>");
            }
            ?>
            <div class="container" id="div_padre">
                <?php
                if ($view == 'search') {
                ?>
                    <script src="assets/js/imdb.js"></script>
                    <div class="cardbox">
                    <div class="cardbox__image">
                        <img src="<?= $elemento->img_url ?>" class="img_portada" alt="portada elemento" style="border-top-left-radius:5px; border-top-right-radius : 5px">

                        </div>
                        <div class="cardbox__content">
                            <h1 class="cardbox__title">Podcast Title</h1>
                            <p class="cardbox__date">📅 Mon, May 25th 2020</p>
                            <div class="cardbox__bar"></div>
                            <p class="cardbox__text">
                                Lorem ipsum dolor sit amet consectetur adipiscing elit. Eligendi, fugiat asperiores inventore beatae accusamus
                                odit minima enim, commodi quia, doloribus eius! Ducimus nemo accusantium maiores velit corrupti tempora
                                reiciendis molestias repellat vero. Eveniet ipsam adipisci illo iusto quibusdam, sunt neque nulla unde ipsum
                                dolores nobis enim quidem excepturi, illum quos!
                            </p>
                            <div class="cardbox__tags">
                                <span class="tag">🎙️ Podcast</span>
                                <span class="tag">⏱️ <?=$elemento->duracion?></span>
                                <span class="tag">▶️ Play Episode</span>
                            </div>
                        </div>
                    </div>
                    <?php
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
                                <p class="tipo" id="tipo_<?= $elemento->id ?>"><i class="bi bi-tag-fill"></i> <?= $elemento->tipo == 'película' ? 'Película' : (($elemento->tipo == 'serie') ? 'Serie' : 'N/A') ?></p>
                                <p class="anho" id="anho_<?= $elemento->id ?>"><i class="bi bi-calendar2-week-fill"> </i><?= $elemento->anho ?></p>
                                <p class="duracion" id="duracion_<?= $elemento->id ?>"><i class="bi bi-alarm-fill"> </i><?= $elemento->duracion ?></p>
                                <br>
                                <form action="?uuid=<?= $elemento->uuid ?>" method="POST">
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
    include('resources/footer.php')
    ?>
</body>
</html>