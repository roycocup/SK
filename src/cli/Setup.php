<?php

namespace SK\Cli;

class Setup extends Command
{
    public $rawData;
    public $fetcher;
    public $configmanager;
    public $cache;

    public function __construct()
    {
        parent::__construct();
    }

    public function getOnlineData()
    {
        $url = $this->configmanager->get('dataUrl');
        $this->rawData = $this->fetcher->getData($url);
    }

}