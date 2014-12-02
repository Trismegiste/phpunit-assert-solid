<?php

/*
 * phpunit-solid-assertion
 */

namespace tests\Trismegiste\SolidAssert\Assert;

use Trismegiste\SolidAssert\Assert\DemeterLaw;

/**
 * DemeterLawTest tests DemeterLaw assertion
 */
class DemeterLawTest extends ConstraintTestCase
{

    protected function createConstraint()
    {
        return new DemeterLaw();
    }

    public function getBadCase()
    {
        return [['BadProject\Case7']];
    }

    public function getGoodCase()
    {
        return [['BadProject\Good7']];
    }

}