<?php

ini_set("display_errors", 1);
ini_set("track_errors", 1);
ini_set("html_errors", 1);
error_reporting(E_ALL);


use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;


define('DS', DIRECTORY_SEPARATOR, true);
define('BASE_PATH', __DIR__ . DS, true);
//define('CONFIGFOLDER', BASE_PATH . "configs" . DS);

require BASE_PATH.'vendor/autoload.php';


// Doctrine
$paths = array(__DIR__."/src/entity");
$isDevMode = true;
$config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);
$conn = array(
    'driver'   => 'pdo_mysql',
    'user'     => 'root',
    'password' => 'root',
    'dbname'   => 'samknows',
);
$entityManager = EntityManager::create($conn, $config);

// Router
if(!empty($_REQUEST)){

    $app            = System\App::instance();
    $app->request   = System\Request::instance();
    $app->route     = System\Route::instance($app->request);
    $route          = $app->route;


    $route->any('/test', function() {
        echo 'Hello World';
    });

    $route->any('/', 'SK\Controller\HomeController@home');

    $route->end();

}



