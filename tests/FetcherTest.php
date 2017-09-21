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




//    public function testDataIsJson()
//    {
//
//    }

}
