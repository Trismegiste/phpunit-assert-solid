<?php

/*
 * phpunit-solid-assertion
 */

require_once dirname(__DIR__) . '/vendor/autoload.php';

/**
 * SimpleExample is an example
 */
class SimpleTest extends PHPUnit_Framework_TestCase
{

    use \Trismegiste\SolidAssert\GoodPractice;

    public function testConcreteTypeHint()
    {
        $this->assertInterfaceHintedParameter('BadProject\Case1');
    }

    public function testContractForMethod()
    {
        $this->assertNoMethodWithoutContract('BadProject\Case2');
    }

    public function testSmallApi()
    {
        $this->assertSmallApi('BadProject\Case3');
    }

    public function testHollywoodPrinciple()
    {
        $this->assertHollywoodPrinciple('BadProject\Case4');
    }

    public function testLiskovCompliance()
    {
        $this->assertLiskovCompliant('BadProject\Case5');
    }

    public function testStaticFactorySux()
    {
        $this->assertNotStaticFactory('BadProject\Case6');
    }

}