<?php

namespace SK\controller;

ini_set("display_errors", 1);
ini_set("track_errors", 1);
ini_set("html_errors", 1);
error_reporting(E_ALL);

use SK\interfaces\Injectable;
use SK\Service\Injector;
use Twig_Loader_Filesystem;
use Twig_Environment;

class Controller implements Injectable
{
    public $injector;
    public $twig;

    public function __construct()
    {

        $loader = new Twig_Loader_Filesystem(__DIR__ . '/../view');
        $this->twig = new Twig_Environment($loader, array(
            'cache' => __DIR__ . '/../../cache/twig',
        ));

        $this->injector = new Injector();
        $this->injector->inject($this);
    }

    public function setDI($value)
    {
        $explodedValue = explode('\\', get_class($value));
        $varName = strtolower(end($explodedValue));
        $this->$varName = $value;
    }
}