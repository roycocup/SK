<?php

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

    public function setDI($value)
    {
        $explodedValue = explode('\\', get_class($value));
        $varName = strtolower(end($explodedValue));
        $this->$varName = $value;
    }
}