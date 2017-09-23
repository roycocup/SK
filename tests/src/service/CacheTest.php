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
    public $cacheFolder;
    public $bogusFile;

    public function setUp()
    {
        parent::setUp();
        $this->cache = new Cache();
        $this->cacheFolder = __DIR__."/../../../cache/";
        $this->bogusFile = 'bogus.txt';
    }

    public function tearDown()
    {
        parent::tearDown();
        if (is_file($this->cacheFolder.$this->bogusFile))
            unlink($this->cacheFolder.$this->bogusFile);
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

        if(is_dir($this->cacheFolder))
            $this->deltree($this->cacheFolder);

        $this->cache->createFolderIfNotExists();
        self::assertTrue(is_dir($this->cacheFolder));
    }



    public function test_returns_boolean_on_cache_existance()
    {
        self::assertFalse($this->cache->getCached($this->bogusFile));
        $filename = "bogus3333333.txt";
        self::assertFalse($this->cache->getCached($filename));
    }

    // can save cache file
    public function test_can_save_file_as_cache()
    {
        $data = ['somedata' => 'and some more' ];
        $this->cache->cache($this->bogusFile, json_encode($data));

        self::assertTrue(file_exists($this->cacheFolder.$this->bogusFile));
        self::assertEquals(json_encode($data), $this->cache->getCached($this->bogusFile));
    }


    // can retrieve cache data


}
