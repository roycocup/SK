<?php

namespace SK\Service;

class Fetcher
{

    public function getData($url)
    {
        if ($this->validateUrl($url))
            return file_get_contents($url);
    }


    public function validateUrl($url)
    {
        preg_match('/(http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/', $url, $match);
        return count($match) < 1? false : true;
    }

}