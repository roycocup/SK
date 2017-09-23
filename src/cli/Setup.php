<?php

namespace SK\Cli;

class Setup extends Command
{
    public $rawData;
    public $fetcher;
    public $configmanager;
    public $cache;

    public static $cacheFilename = 'cacheData.txt';

    public function __construct()
    {
        parent::__construct();
    }

    public function getRawData()
    {
        $url = $this->configmanager->get('dataUrl');

        $cachedData = $this->cache->getCached(self::$cacheFilename);

        if($cachedData)
            $this->rawData = $cachedData;
        else{
            $this->rawData = $this->fetcher->getData($url);
            $this->cache->cache(self::$cacheFilename, $this->rawData);
        }

        return $this->rawData;
    }



}