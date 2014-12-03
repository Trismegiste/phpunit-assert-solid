<?php

/*
 * phpunit-solid-assertion
 */

namespace tests\Trismegiste\SolidAssert\Assert;

use Trismegiste\SolidAssert\Assert\NoMissingTypeHint;

/**
 * NoMissingTypeHintTest tests NoMissingTypeHint assert
 */
class NoMissingTypeHintTest extends ConstraintTestCase
{

    protected function createConstraint()
    {
        return new NoMissingTypeHint();
    }

    public function getBadCase()
    {
        return [['BadProject\Case8']];
    }

    public function getGoodCase()
    {
        return [['BadProject\Good8']];
    }

}