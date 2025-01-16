<?php
// Definir la ruta base del proyecto
include_once 'videobook3d.php';
define('BASE_PATH', realpath(__DIR__ . '/..'));
// Definir las constantes para cada carpeta clave del proyecto
define('LAYOUTS_FOLDER', BASE_PATH . '/videobook3d/views/layouts');
define('VIEWS_FOLDER', BASE_PATH . '/videobook3d/views');
define('CONTROLLERS_FOLDER', BASE_PATH . '/videobook3d/controllers');
define('MODELS_FOLDER', BASE_PATH . '/videobook3d/models');
define('ASSETS_FOLDER', BASE_PATH . '/videobook3d/assets');
define('HELPERS_FOLDER', BASE_PATH . '/helpers');
define('INIT_FILE', BASE_PATH . '/videobook3d/init.php');
$actor_table = "actor";
$videobook_table  = "videobook";
define('ACTOR_TABLE', $actor_table);
define('VIDEOBOOK_TABLE', $videobook_table);
// Helpers
require_once HELPERS_FOLDER . '/functions.php';

// Autoload de clases
spl_autoload_register(function ($class) {
    //$file = CONTROLLERS_FOLDER . "/{$class}.php";
    $file = __DIR__ . "/controllers/{$class}.php";
    //if (file_exists($file)) {
        require_once $file;
    //}
});
