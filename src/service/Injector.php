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

}