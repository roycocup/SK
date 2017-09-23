<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use PHPUnit\Framework\TestCase;

class SetupContext implements Context
{

    /**
     * @Given I have a :arg1 file at :arg2
     */
    public function iHaveAFileAt($arg1, $arg2)
    {
        TestCase::assertTrue(is_file($arg2."/".$arg1));
    }

    /**
     * @When I run :arg1
     */
    public function iRun($arg1)
    {
        exec('php setup.php');
    }

    /**
     * @Then I should get:
     */
    public function iShouldGet(PyStringNode $string)
    {
        TestCase::assertEquals('All done.', $string->getRaw());
    }
}