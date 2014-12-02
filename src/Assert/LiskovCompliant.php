<?php

/*
 * phpunit-solid-assertion
 */

namespace Trismegiste\SolidAssert\Assert;

use Trismegiste\SolidAssert\Visitor\LiskovViolation;

/**
 * LiskovCompliant asserts if bad uses of reflection prevent LSP to be verified
 */
class LiskovCompliant extends AssertParserTemplate
{

    public function toString()
    {
        return 'class is not breaking LSP';
    }

    protected function createVisitor()
    {
        return new LiskovViolation();
    }

}