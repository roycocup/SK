<?php
namespace Tests\service;


use PHPUnit\Framework\TestCase;
use SK\interfaces\Injectable;
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


    public function test_should_return_correct_testing_class_from_config()
    {
        $result = $this->injector->getDependenciesForObject('TestClass');
        self::assertTrue(is_array($result));
        self::assertEquals(['SK\Service\Fetcher'], $result);
        self::assertNotEquals(['Fetchers'], $result);

        $result = $this->injector->getDependenciesForObject('TestClasses');
        self::assertTrue(is_array($result));
        self::assertNotEquals(['Anything'], $result);
        self::assertEmpty($result);
    }


    public function test_if_dependencies_empty_return_false()
    {
        $mock = $this->getMockBuilder(Injectable::class)
            ->getMock();

        $mock->expects(self::never())->method('setDI');

        $result = $this->injector->inject($mock);

        self::assertFalse($result);
    }

//    public function test_should_call_setDI_in_host_object()
//    {
//        $mock = $this->getMockBuilder(HomeController::class)
//            ->setMethods(['setDI'])
//            ->getMock();
//
//        $this->assertTrue($mock instanceof Injectable);
//
//        $mock->expects(self::once())
//            ->method('setDI')
//            ->with('SK\Service\Fetcher', new Fetcher());
//
//        $this->injector->inject($mock);
//    }









}
