<?php
namespace Tests\service;


use PHPUnit\Framework\TestCase;
use SK\Service\Fetcher;
use SK\Service\Injector;
use SK\Controller\HomeController;

class InjectorTest extends TestCase
{
    public $injector;

    public function setUp()
    {
        parent::setUp();
        $this->injector = new Injector();
    }

    public function test_can_read_yaml_configs_into_array()
    {
        self::assertTrue(is_array($this->injector->configs));
    }

    public function test_should_call_setDI_in_host_method()
    {
        $mock = $this->getMockBuilder(HomeController::class)
            ->setMethods(['setDI'])
            ->getMock()
            ->expects($this->once())
            ->method('setDI')
            //->with('fetcher', new Fetcher())
            ->willReturn(0)
        ;

        $this->injector->inject($mock);

//        self::assertNotNull($mock->fetcher);
    }


}
