<?php
/**
 * Created by PhpStorm.
 * User: rodrigo
 * Date: 22/09/2017
 * Time: 00:30
 */

namespace SK\controller;

use SK\interfaces\Injectable;
use SK\Service\Injector;

class Controller implements Injectable
{
    public $injector;

    public function __construct()
    {
        $this->injector = new Injector();
        $this->injector->inject($this);
    }

    public function setDI($attrName, $attrValue)
    {
        $this->$attrName = $attrValue;
    }
}