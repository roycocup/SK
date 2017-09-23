<?php
require_once 'vendor/autoload.php';


$app            = System\App::instance();
$app->request   = System\Request::instance();
$app->route     = System\Route::instance($app->request);
$route          = $app->route;


$route->any('/', 'SK\Controller\HomeController@home');

$route->end();





