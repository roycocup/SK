<?php
require_once 'vendor/autoload.php';

define('DS', DIRECTORY_SEPARATOR, true);
define('BASE_PATH', __DIR__ . DS, true);


$app            = System\App::instance();
$app->request   = System\Request::instance();
$app->route     = System\Route::instance($app->request);
$route          = $app->route;


$route->any('/', 'SK\Controller\HomeController@home');

$route->end();





