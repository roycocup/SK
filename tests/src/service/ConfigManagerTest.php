<?php
namespace Tests\service;

use PHPUnit\Framework\TestCase;
use SK\service\ConfigManager;

class ConfigManagerTest extends TestCase
{
    public $cm;

    public function setUp()
    {
        parent::setUp();
        $this->cm = new ConfigManager();
    }

    public function test_can_read_yaml_configs_into_array()
    {
        self::assertTrue(is_array($this->cm->configs));
    }


    public function test_should_return_empty_array_if_class_does_not_exist()
    {
        $result = $this->cm->getDependencies('TestObject');
        self::assertTrue(is_array($result));
        self::assertEmpty($result);
    }

    public function test_should_return_filled_array_if_existing_class_in_dependencies()
    {
        $result = $this->cm->getDependencies('TestClass');
        self::assertEquals(['SK\Service\Fetcher'], $result);
    }

    public function test_will_return_filled_array_if_classname_has_namespace()
    {
        $result = $this->cm->getDependencies('Tests\SK\Something\TestClass');
        self::assertEquals(['SK\Service\Fetcher'], $result);
    }

    public function test_can_get_property_from_config_file()
    {
        self::assertNotNull($this->cm->get('dataUrl'));
    }
}
