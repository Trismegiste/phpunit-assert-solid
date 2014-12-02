<?php

/*
 * phpunit-solid-assertion
 */

namespace tests\Trismegiste\SolidAssert\Assert;

use Trismegiste\SolidAssert\Assert\StaticFactory;

/**
 * StaticFactoryTest tests StaticFactory assertion
 */
class StaticFactoryTest extends ConstraintTestCase
{

    protected function createConstraint()
    {
        return new StaticFactory();
    }

    public function getBadCase()
    {
        return [['BadProject\Case6']];
    }

    public function getGoodCase()
    {
        return [['BadProject\Case4']];
    }

}