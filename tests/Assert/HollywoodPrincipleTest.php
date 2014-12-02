<?php

/*
 * phpunit-solid-assertion
 */

namespace tests\Trismegiste\SolidAssert\Assert;

use Trismegiste\SolidAssert\Assert\HollywoodPrinciple;

/**
 * HollywoodPrincipleTest tests HollywoodPrinciple assert
 */
class HollywoodPrincipleTest extends ConstraintTestCase
{

    protected function createConstraint()
    {
        return new HollywoodPrinciple();
    }

    public function getBadCase()
    {
        return [['BadProject\Case4']];
    }

    public function getGoodCase()
    {
        return [['BadProject\Good4']];
    }

}