<?php
/**
 * Created by PhpStorm.
 * User: rodrigodias
 * Date: 23/09/2017
 * Time: 14:37
 */

namespace Tests\service;


use PHPUnit\Framework\TestCase;
use SK\Service\Cache;

class CacheTest extends TestCase
{
    public $cache;

    public function setUp()
    {
        parent::setUp();
        $this->cache = new Cache();
    }

    public function delTree($dir) {
        $files = array_diff(scandir($dir), array('.','..'));
        foreach ($files as $file) {
            (is_dir("$dir/$file")) ? $this->delTree("$dir/$file") : unlink("$dir/$file");
        }
        return rmdir($dir);
    }

    // can get cache exists boolean
    public function test_creates_if_cache_folder_not_exist()
    {
        $cacheFolder = __DIR__."/../../../cache/";
        if(is_dir($cacheFolder))
            $this->deltree($cacheFolder);

        $this->cache->createFolderIfNotExists();
        self::assertTrue(is_dir($cacheFolder));
    }



    public function test_returns_boolean_on_cache_existance()
    {
        $filename = "bogus.txt";
        self::assertFalse($this->cache->getCached($filename));
        $filename = "bogus3333333.txt";
        self::assertFalse($this->cache->getCached($filename));
    }

    // can save cache file
    public function test_can_save_file_as_cache()
    {
        $filename = 'bogus.txt';
        $cacheFolder = __DIR__."/../../../cache/";
        $data = ['somedata' => 'and some more' ];
        $this->cache->cache($filename, json_encode($data));


        self::assertTrue(file_exists($cacheFolder.$filename));
        self::assertEquals(json_encode($data), $this->cache->getCached($filename));
    }


    // can retrieve cache data


}
