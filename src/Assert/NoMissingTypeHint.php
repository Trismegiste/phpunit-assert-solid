<?php

/*
 * phpunit-solid-assertion
 */

namespace Trismegiste\SolidAssert\Assert;

use Trismegiste\SolidAssert\Visitor\MissingTypeHint;

/**
 * NoMissingTypeHint detects if parameters passed on to methods are actually objects without 
 * type-hinting which is a well-known (and sadly common) bad practice (design by contract
 * violation). Can't detect php tricks like reflection and call_user_func*().
 */
class NoMissingTypeHint extends AssertParserTemplate
{

    protected function createVisitor()
    {
        return new MissingTypeHint();
    }

    public function toString()
    {
        return 'class has no missing type-hint on method parameters';
    }

}