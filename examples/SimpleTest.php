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

    use \Trismegiste\SolidAssert\LiskovSubstitutionPrinciple;

    public function testConcreteTypeHint()
    {
        $this->assertInterfaceHintedParameter('BadProject\Case1');
    }

}