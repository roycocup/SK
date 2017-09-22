<?php
namespace Tests\src\controller;


use PHPUnit\Framework\TestCase;
use SK\Controller\HomeController;
use SK\Service\Fetcher;

class HomeControllerTest extends TestCase
{
    public function testControllerCanBeBuilt()
    {
        $homeController = new HomeController();
        self::assertTrue(is_object($homeController));
        //self::assertEquals(new Fetcher(), $homeController->fetcher);
    }


}
