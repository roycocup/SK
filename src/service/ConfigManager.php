<?php
namespace SK\service;

use PHPUnit\Framework\Exception;
use Symfony\Component\Yaml\Yaml;

class ConfigManager
{
    public $configFilename = __DIR__.'/../../configs/configs.yaml';
    public $configs;

    public function __construct()
    {
        $this->configs = Yaml::parse(file_get_contents($this->configFilename));
    }

    public function getDependencies(String $className): array
    {
        $xplodedClassname = explode('\\', $className);
        $className = $xplodedClassname[count($xplodedClassname)-1];

        if (!empty($this->configs['dependencies'])){
            foreach ($this->configs['dependencies'] as $key=>$dependencies){
                if($key == $className){
                    return $dependencies;
                }
            }
        }

        return [];
    }

    public function get($propertyName)
    {
        if(!empty($this->configs[$propertyName]))
            return $this->configs[$propertyName];
        else
            return false;
    }

}