<?php

/*
 * phpunit-solid-assertion
 */

namespace Trismegiste\SolidAssert\Assert;

use Trismegiste\SolidAssert\Visitor;

/**
 * StaticFactory asserts if there is no static factory since it breaks OCP
 */
class StaticFactory extends AssertParserTemplate
{

    protected function createVisitor()
    {
        return new Visitor\StaticFactory();
    }

    public function toString(): string
    {
        return 'class does not break OCP by using static factory nor singleton';
    }

}
