<?php
namespace Tests\service;


use PHPUnit\Framework\TestCase;
use SK\Service\Fetcher;
use SK\Service\Injector;

class InjectorTest extends TestCase
{
    public $injector;

    public function setUp()
    {
        parent::setUp();
        $this->injector = new Injector();
    }

    public function testCanReadYamlConfigsIntoArray()
    {
        self::assertTrue(is_array($this->injector->configs));
    }

    public function testIsInjecting()
    {
        $mock = $this->createMock('SK\Controller\HomeController')
            ->expects(self::once())
            ->method('setDI')
            ->with('fetcher', new Fetcher());

        $this->injector->inject($mock);

//        self::assertNotNull($mock->fetcher);
    }


}
