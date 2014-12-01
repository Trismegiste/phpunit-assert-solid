<?php

/*
 * phpunit-solid-assertion
 */

namespace tests\Trismegiste\SolidAssert\Assert;

use Trismegiste\SolidAssert\Assert\NoMethodWithoutContract;

/**
 * NoMethodWithoutContractTest tests NoMethodWithoutContract
 */
class NoMethodWithoutContractTest extends ConstraintTestCase
{

    protected function createConstraint()
    {
        return new NoMethodWithoutContract();
    }

    public function getBadCase()
    {
        return [['BadProject\Case2']];
    }

    public function getGoodCase()
    {
        return [['BadProject\Good2']];
    }

}