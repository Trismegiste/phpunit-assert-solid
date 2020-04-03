<?php

/*
 * phpunit-solid-assertion
 */

namespace Trismegiste\SolidAssert\Assert;

use Trismegiste\SolidAssert\Visitor\LiskovViolation;
use Trismegiste\SolidAssert\Visitor\MethodContentTracking;

/**
 * LiskovCompliant asserts if bad uses of reflection prevent LSP to be verified
 */
class LiskovCompliant extends AssertParserTemplate
{

    public function toString(): string
    {
        return 'class is not breaking LSP';
    }

    protected function createVisitor(): MethodContentTracking
    {
        return new LiskovViolation();
    }

}
