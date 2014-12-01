<?php

/*
 * phpunit-solid-assertion
 */

namespace tests\Trismegiste\SolidAssert\Assert;

use Trismegiste\SolidAssert\Assert\SmallApi;

/**
 * SmallApiTest tests SmallApi
 */
class SmallApiTest extends ConstraintTestCase
{

    protected function createConstraint()
    {
        return new SmallApi(2);
    }

    public function getBadCase()
    {
        return [['BadProject\Case3']];
    }

    public function getGoodCase()
    {
        return [['BadProject\Good3']];
    }

}