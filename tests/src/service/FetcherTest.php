<?php

namespace Tests\service;

use SK\Service\Fetcher;
use PHPUnit\Framework\TestCase;

class FetcherTest extends TestCase
{
    public $fetcher;

    public function setUp()
    {
        parent::setUp();
        $this->fetcher = new Fetcher();
    }

    public function test_can_get_data()
    {
        $data = $this->fetcher->getData("http://google.com");
        self::assertNotEmpty($data);
    }

    public function test_data_is_from_live_source()
    {
        $data = $this->fetcher->getData("http://rodderscode.co.uk");
        self::assertEquals(file_get_contents("http://rodderscode.co.uk"), $data);
    }

    public function invalid_url_provider()
    {
        return [
            ["lkmsldk", false],
            ["http:/lkj.com", false],
            ["lkjk.com", false],
            ["", false],
            ["nil", false],
            ["lkjk.com?", false],
        ];
    }

    /**
     * @dataProvider invalid_url_provider
     */
    public function test_invalid_url_returns_false($url, $expected)
    {
        $data = $this->fetcher->validateUrl($url);
        self::assertEquals($expected, $data);
    }

    public function valid_url_provider()
    {
        return [
            ["http://lkjk.com", true],
            ["http://rod.lkjk.com", true],
            ["http://rod.lkjk.com/red", true],
            ["http://rod.lkjk.com/red&i=87", true],
            ["http://rod.lkjk.com/red?i=87&o=98", true],
            ["http://rod.lkjk.com/red?i=87&q=some%20words", true],
        ];
    }

    /**
     * @dataProvider valid_url_provider
     */
    public function test_valid_url_returns_true($url, $expected)
    {
        $data = $this->fetcher->validateUrl($url);
        self::assertEquals($expected, $data);
    }


    /**
     * @dataProvider invalid_url_provider
     */
    public function test_invalid_url_returns_empty_array($url, $expected)
    {
        $data = $this->fetcher->getData($url);
        self::assertEquals([], $data);
    }


    public function test_curl_is_enabled_and_working()
    {
        $worked = false;
        try {
            $ch = curl_init(".");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_exec($ch);
            curl_close($ch);
            $worked = true;
        } catch (\Exception $e) {
            self::assertTrue($worked, "Curl does not seem to be working.");
        }

        self::assertTrue($worked);

    }

    public function test_stream_get_contents_works()
    {
        $worked = false;
        try{
            $fh = fopen("http://rodderscode.co.uk", "r");
            stream_get_contents($fh);
            fclose($fh);
            $worked = true;
        } catch (\Exception $e){
            self::assertTrue($worked, "Fopen does not seem to be working.");
        }
        self::assertTrue($worked);
    }


    public function sites_provider()
    {
        return [
            ["http://rodderscode.co.uk", true],
            ["https://github.com", true],
            ["https://youtube.com", false], // throws 302
            ["http://dfgdfg.fer", false],
            ["http://tech-test.sandbox.samknows.com/php-2.0/testdata.json", true],
        ];
    }


}
