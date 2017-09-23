<?php

namespace SK\Service;


class Cache
{
    public static $cacheFolder = __DIR__."/../../cache/";

    public function createFolderIfNotExists()
    {
        if (!is_dir(self::$cacheFolder)){
            try{
                mkdir(self::$cacheFolder, 0777, true);
            }catch (\Exception $e) {
                echo $e->getMessage();
                return false;
            }

        }
    }

    public function getCached($filename)
    {
        if(!file_exists(self::$cacheFolder.$filename))
            return false;

        return file_get_contents(self::$cacheFolder.$filename);
    }

    public function cache($filename, $data)
    {
        $this->createFolderIfNotExists();
        file_put_contents(self::$cacheFolder.$filename, $data);
    }

}