<?php

namespace SK\Service;

use SK\interfaces\Injectable;

class Injector
{

    public $configManager;

    public function __construct()
    {
        $this->configManager = new ConfigManager();
    }

    public function inject(Injectable $obj)
    {
        $className = get_class($obj);
        $dependencies = $this->getDependenciesForObject($className);

        if (empty($dependencies))
            return false;

        foreach ($dependencies as $dependency){
            $dep = new $dependency();
            $obj->setDI($dep);
        }

    }

    public function getDependenciesForObject($className)
    {
        return $this->configManager->getDependencies($className);
    }


}