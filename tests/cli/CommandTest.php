<?php

namespace Tests\Cli\CommandTest;


use PHPUnit\Framework\TestCase;
use SK\Cli\Setup;

class CommandTest extends TestCase
{
    public function test_setup_class_extends_command()
    {
        $mock = $this->createMock('Doctrine\ORM\EntityManager');
        self::assertInstanceOf('SK\Cli\Command', new Setup($mock));
    }

    public function test_has_fetcher()
    {
        $mock = $this->createMock('Doctrine\ORM\EntityManager');
        $setup = new Setup($mock);
        self::assertNotEmpty($setup->fetcher);
    }

    public function test_online_data_filled_property()
    {
        $mock = $this->createMock('Doctrine\ORM\EntityManager');
        $setup = new Setup($mock);
        $setup->getRawData();
        self::assertNotEmpty($setup->rawData);
    }
}
