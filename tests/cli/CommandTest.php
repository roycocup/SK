<?php

namespace Tests\Cli\CommandTest;


use PHPUnit\Framework\TestCase;
use SK\Cli\Setup;

class CommandTest extends TestCase
{
    public function test_setup_class_extends_command()
    {
        self::assertInstanceOf('SK\Cli\Command', new Setup());
    }

    public function test_has_fetcher()
    {
        $setup = new Setup();
        self::assertNotEmpty($setup->fetcher);
    }

    public function test_online_data_filled_property()
    {
        $setup = new Setup();
        $setup->getOnlineData();
        self::assertNotEmpty($setup->rawData);
    }
}
