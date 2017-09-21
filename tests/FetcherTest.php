<?php

namespace Tests;

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

    public function testCanGetData()
    {
        $data = $this->fetcher->getData("http://google.com");
        self::assertNotEmpty($data);
    }

    public function testDataIsLive()
    {
        $data = $this->fetcher->getData("http://rodderscode.co.uk");
        self::assertEquals(file_get_contents("http://rodderscode.co.uk"), $data);
    }

    public function invalidUrlProvider()
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
     * @dataProvider invalidUrlProvider
     */
    public function testInvalidUrlReturnsFalse($url, $expected)
    {
        $data = $this->fetcher->validateUrl($url);
        self::assertEquals($expected, $data);
    }

    public function validUrlProvider()
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
     * @dataProvider validUrlProvider
     */
    public function testValidUrlReturnsTrue($url, $expected)
    {
        $data = $this->fetcher->validateUrl($url);
        self::assertEquals($expected, $data);
    }


    /**
     * @dataProvider invalidUrlProvider
     */
    public function testInvalidUrlReturnsEmptyArray($url, $expected)
    {
        $data = $this->fetcher->getData($url);
        self::assertEquals([], $data);
    }


    public function testCurlIsEnabledAndWorking()
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

    public function testStreamGetContentsWorks()
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


    public function sitesProvider()
    {
        return [
            ["http://rodderscode.co.uk", true],
            ["https://github.com", true],
            ["https://youtube.com", false], // throws 302
            ["http://dfgdfg.fer", false],
            ["http://tech-test.sandbox.samknows.com/php-2.0/testdata.json", true],
        ];
    }

    /**
     * @dataProvider sitesProvider
     */
    public function testLiveSites($url, $expected)
    {
        $data = $this->fetcher->isSiteValid($url);
        self::assertEquals($expected, $data);
    }

}
