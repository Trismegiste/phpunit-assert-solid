<?php

/*
 * phpunit-solid-assertion
 */

namespace tests\Trismegiste\SolidAssert\Visitor;

use Trismegiste\SolidAssert\Visitor\StaticFactory;

/**
 * StaticFactoryTest tests the StaticFactory visitor
 */
class StaticFactoryTest extends VisitorTestCase
{

    protected function createVisitor()
    {
        return new StaticFactory();
    }

}