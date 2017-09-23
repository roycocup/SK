<?php

namespace Tests\Cli\CommandTest;


use PHPUnit\Framework\TestCase;
use SK\Cli\Setup;
use SK\Service\Cache;

class SetupTest extends TestCase
{
    public $cacheFile;
    public $cacheFolder;

    public function setUp()
    {
        parent::setUp();
        $this->cacheFolder = __DIR__ . '/../../cache/';
    }

    public function test_setup_class_extends_command()
    {
        self::assertInstanceOf('SK\Cli\Command', new Setup());
    }

    public function test_has_fetcher()
    {
        $setup = new Setup();
        self::assertNotEmpty($setup->fetcher);
    }

    public function test_online_data_filled_property()
    {
        $setup = new Setup();
        $setup->getRawData();
        self::assertNotEmpty($setup->rawData);
    }

    public function delTree($dir) {
        $files = array_diff(scandir($dir), array('.','..'));
        foreach ($files as $file) {
            (is_dir("$dir/$file")) ? $this->delTree("$dir/$file") : unlink("$dir/$file");
        }
        return rmdir($dir);
    }

    public function test_first_call_will_save_a_cache_file_with_raw_data()
    {
        $this->deltree($this->cacheFolder);
        $setup = new Setup();
        $setup->getRawData();
        self::assertNotEmpty($setup->rawData);
        self::assertTrue(file_exists($this->cacheFolder.Setup::$cacheFilename));
    }

    public function test_second_call_is_coming_from_cache()
    {
        // delete cache.
        // pull data once

        $this->deltree(Cache::$cacheFolder);
        $setup = new Setup();
        $setup->getRawData();
        self::assertTrue(file_exists(Cache::$cacheFolder.Setup::$cacheFilename));

        // replace the cache with controlled data
        // check equality
        $this->deltree(Cache::$cacheFolder);
        $cache = new Cache();
        $data = ['this is', 'under control'];
        $cache->cache(Setup::$cacheFilename, json_encode($data));
        self::assertEquals(json_encode($data), $setup->getRawData());

    }

    public function test_persists_data_to_DB()
    {
        DB::get();
        self::assertTrue();
    }
}
