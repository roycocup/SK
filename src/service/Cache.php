<?php

namespace SK\Service;


class Cache
{
    public $cacheFolder = __DIR__."/../../cache/";

    public function createFolderIfNotExists()
    {
        if (!is_dir($this->cacheFolder)){
            try{
                mkdir($this->cacheFolder, 0777, true);
            }catch (\Exception $e)
            {
                echo $e->getMessage();
                return false;
            }

        }
    }

    public function getCached($filename)
    {
        $this->createFolderIfNotExists();

        if(!file_exists($this->cacheFolder.$filename))
            return false;

        return file_get_contents($this->cacheFolder.$filename);
    }

    public function cache($filename, $data)
    {
        file_put_contents($this->cacheFolder.$filename, $data);
    }

}