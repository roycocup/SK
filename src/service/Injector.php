<?php

namespace SK\Service;

use SK\interfaces\Injectable;
use Symfony\Component\Yaml\Yaml;

class Injector
{
    public $configFilename = __DIR__.'/../../configs/configs.yaml';
    public $configs = [];

    public function __construct()
    {

    }

    public function inject(Injectable $obj)
    {
//        $className = get_class($obj);
    }

}