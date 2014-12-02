<?php

/*
 * phpunit-solid-assertion
 */

namespace Trismegiste\SolidAssert\Assert;

use Trismegiste\SolidAssert\Visitor\DemeterViolation;

/**
 * DemeterLaw asserts Demeter's Law compliance
 */
class DemeterLaw extends AssertParserTemplate
{

    protected function createVisitor()
    {
        return new DemeterViolation(2);
    }

    public function toString()
    {
        return 'class is following Law of Demeter';
    }

}