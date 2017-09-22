<?php

namespace SK\Service;

use Symfony\Component\Yaml\Yaml;

class Injector
{
    public $configFilename = __DIR__.'/../../configs/configs.yaml';
    public $configs = [];

    public function __construct()
    {
        $this->configs = Yaml::parse(file_get_contents($this->configFilename));
    }

    public function inject($obj)
    {
        $className = get_class($obj);
        //$this->configs['dependencies']
        $obj->setDI('fetcher', new Fetcher());
    }

}