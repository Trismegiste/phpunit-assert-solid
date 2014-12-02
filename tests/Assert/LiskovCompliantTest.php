<?php

/*
 * phpunit-solid-assertion
 */

namespace tests\Trismegiste\SolidAssert\Assert;

use Trismegiste\SolidAssert\Assert\LiskovCompliant;

/**
 * LiskovCompliantTest tests LiskovCompliant assert
 */
class LiskovCompliantTest extends ConstraintTestCase
{

    protected function createConstraint()
    {
        return new LiskovCompliant();
    }

    public function getBadCase()
    {
        return [['BadProject\Case5']];
    }

    public function getGoodCase()
    {
        return [['BadProject\Good5']];
    }

}