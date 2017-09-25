#!/usr/bin/php
<?php
ini_set("display_errors", 1);
ini_set("track_errors", 1);
ini_set("html_errors", 1);
error_reporting(E_ALL);


define('DS', DIRECTORY_SEPARATOR, true);
define('BASE_PATH', __DIR__ . DS, true);
//define('CONFIGFOLDER', BASE_PATH . "configs" . DS);

require BASE_PATH.'vendor/autoload.php';

// Doctrine
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
$cm = new \SK\service\ConfigManager();
$paths = array(__DIR__."/src/entity");
$isDevMode = true;
$config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);
$conn = array(
    'driver'   => 'pdo_mysql',
    'user'     => $cm->get('dbusername'),
    'password' => $cm->get('dbpassword'),
    'dbname'   => $cm->get('dbname'),
);

$entityManager = EntityManager::create($conn, $config);


if($argv[1] == 'run')
{
    $setup = new SK\Cli\Setup($entityManager);

    $setup->run();

    echo "All done.";
}
