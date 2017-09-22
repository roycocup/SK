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

    public function test_placeholder()
    {
        self::assertTrue(true);
    }


//    public function test_should_return_correct_testing_class_from_config()
//    {
//        $this->injector->getDependenciesForObject('InjectorTestClass');
//    }


//    public function test_should_call_setDI_in_host_object()
//    {
//        $mock = $this->getMockBuilder(HomeController::class)
//            ->setMethods(['setDI'])
//            ->getMock();
//
//        $mock->expects(self::once())
//            ->method('setDI')
//            ->with('fetcher', new Fetcher());
//
//        $this->injector->inject($mock);
//    }





}
