<section>
    <div class="container" id="main-container">
        <?php if ($view == 'search') : ?>
            <script src="assets/js/imdb.js"></script>
            <div class="card-box">
                <div class="card-box__image">
                    <img src="<?= $elemento->img_url ?>" class="img-cover" alt="element cover">
                </div>
                <div class="card-box__content">
                    <h1 class="card-box__title"><?= $elemento->title ?></h1>
                    <p class="card-box__date">📅 <?= $elemento->year ?></p>
                    <div class="card-box__bar"></div>
                    <p class="card-box__text"><?= $elemento->desc ?></p>
                    <div class="card-box__tags">
                        <span class="tag">🎙️ <?= ucfirst($elemento->type) ?></span>
                        <span class="tag">⏱️ <?= $elemento->duration ?></span>
                        <span class="tag">▶️ Play Episode</span>
                    </div>
                </div>
            </div>
        <?php else : ?>
            <?php foreach ($elementos as $elemento) : ?>
                <input type="hidden" id="id-imdb" value="<?= $elemento->id ?>">
                <div class="cellphone-container" id="card-box-<?= $elemento->id ?>">
                    <div class="movie-img">
                        <img src="<?= $elemento->img_url ?>" class="img-cover" alt="element cover" style="border-top-left-radius:5px; border-top-right-radius:5px">
                    </div>
                    <div class="movie-details">
                        <h2><?= $elemento->title ?></h2>
                        <p class="desc"><?= $elemento->desc ?></p><br>
                        <p class="type" id="type-<?= $elemento->id ?>"><i class="bi bi-tag-fill"></i> <?= $elemento->type == 'película' ? 'Película' : ($elemento->type == 'serie' ? 'Serie' : 'N/A') ?></p>
                        <p class="year" id="year-<?= $elemento->id ?>"><i class="bi bi-calendar2-week-fill"></i> <?= $elemento->year ?></p>
                        <p class="duration" id="duration-<?= $elemento->id ?>"><i class="bi bi-alarm-fill"></i> <?= $elemento->duration ?></p>
                        <br>
                        <form action="?uuid=<?= $elemento->uuid ?>" method="POST">
                            <input type="hidden" name="id_imdb" value="<?= $elemento->id ?>">
                            <input type="hidden" name="image" value="<?= $elemento->img_url ?>">
                            <input type="hidden" name="title" value="<?= $elemento->title ?>">
                            <input type="hidden" name="desc" value="<?= $elemento->desc ?>">
                            <input type="hidden" name="year" value="<?= $elemento->year ?>">
                            <input type="hidden" name="duration" value="<?= $elemento->duration ?>">
                            <button class="btn-action" id="btn-info">Ver más</button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</section>