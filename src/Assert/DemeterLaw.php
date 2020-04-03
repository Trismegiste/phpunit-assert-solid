<?php

/*
 * phpunit-solid-assertion
 */

namespace Trismegiste\SolidAssert\Assert;

use Trismegiste\SolidAssert\Visitor\DemeterViolation;
use Trismegiste\SolidAssert\Visitor\MethodContentTracking;

/**
 * DemeterLaw asserts Demeter's Law compliance
 */
class DemeterLaw extends AssertParserTemplate
{

    protected function createVisitor(): MethodContentTracking
    {
        return new DemeterViolation(2);
    }

    public function toString(): string
    {
        return 'class is following Law of Demeter';
    }

}
