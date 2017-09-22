<?php

ini_set("display_errors", 1);
ini_set("track_errors", 1);
ini_set("html_errors", 1);
error_reporting(E_ALL);


define('DS', DIRECTORY_SEPARATOR, true);
define('BASE_PATH', __DIR__ . DS, true);
//define('CONFIGFOLDER', BASE_PATH . "configs" . DS);

require BASE_PATH.'vendor/autoload.php';


$app            = System\App::instance();
$app->request   = System\Request::instance();
$app->route     = System\Route::instance($app->request);
$route          = $app->route;


$route->any('/test', function() {
    echo 'Hello World';
});

$route->any('/', 'SK\Controller\HomeController@home');

$route->end();