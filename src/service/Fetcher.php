<?php

namespace SK\Service;

class Fetcher
{

    public function getData($url)
    {
        if ($this->validateUrl($url)){
            return file_get_contents($url);
        }

        return [];

    }


    public function isSiteValid($url)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_exec($ch);
        $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);


        return $code == 200 ? true : false;

    }


    public function validateUrl($url)
    {
        preg_match('/(http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/', $url, $match);
        return count($match) < 1? false : true;
    }

}