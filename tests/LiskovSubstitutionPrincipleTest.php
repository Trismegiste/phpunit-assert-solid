<?php

/*
 * phpunit-solid-assertion
 */

namespace tests\Trismegiste\Assert\Solid;

/**
 * LiskovSubstitutionPrincipleTest tests LiskovSubstitutionPrinciple
 */
class LiskovSubstitutionPrincipleTest extends \PHPUnit_Framework_TestCase
{

    use \Trismegiste\Assert\Solid\LiskovSubstitutionPrinciple;

    public function testAssertInterfaceTypeHinted()
    {
        $this->assertInterfaceTypeHinted('BadProject\Case1');
    }

}