<?php

/*
 * phpunit-solid-assertion
 */

namespace Trismegiste\SolidAssert\Assert;

use Trismegiste\SolidAssert\Visitor;

/**
 * HollywoodPrinciple is an assertion on the famous "don't call us we call you"
 * 
 * The DIP is a much stronger principle since it applies also to abstraction 
 * & inheritance but it is much difficult to assert.
 */
class HollywoodPrinciple extends AssertParserTemplate
{

    public function toString(): string
    {
        return "class is following Hollywood principle";
    }

    protected function createVisitor(): Visitor\MethodContentTracking
    {
        return new Visitor\HollywoodPrinciple();
    }

}
