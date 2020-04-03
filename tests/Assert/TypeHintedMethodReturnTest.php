<?php

/*
 * phpunit-solid-assertion
 */

namespace tests\Trismegiste\SolidAssert\Assert;

use Trismegiste\SolidAssert\Assert\TypeHintedMethodReturn;

/**
 * Description of TypeHintedMethodReturnTest
 */
class TypeHintedMethodReturnTest extends ConstraintTestCase
{

    protected function createConstraint()
    {
        return new TypeHintedMethodReturn();
    }

    public function getBadCase()
    {
        return [['BadProject\\NoReturnCase']];
    }

    public function getGoodCase()
    {
        return [['BadProject\\GoodWithReturn']];
    }

}
