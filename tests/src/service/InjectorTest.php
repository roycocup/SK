<?php
namespace Tests\service;


use PHPUnit\Framework\TestCase;
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


}
