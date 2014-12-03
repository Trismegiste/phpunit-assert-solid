<?php

/*
 * phpunit-solid-assertion
 */

namespace tests\Trismegiste\SolidAssert\Assert;

use Trismegiste\SolidAssert\Assert\InterfaceHintedParameter;

/**
 * InterfaceHintedParameterTest tests InterfaceHintedParameter
 */
class InterfaceHintedParameterTest extends ConstraintTestCase
{

    protected function createConstraint()
    {
        return new InterfaceHintedParameter();
    }

    public function getBadCase()
    {
        return [['BadProject\Case1']];
    }

    public function getGoodCase()
    {
        return [
            ['BadProject\Good1'],
            ['BadProject\Good1i']
        ];
    }

}